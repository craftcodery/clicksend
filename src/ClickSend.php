<?php

namespace CraftCodery\ClickSend;

use Barryvdh\DomPDF\Facade as PDF;
use CraftCodery\ClickSend\Models\ClickSendReturnAddress;
use CraftCodery\ClickSend\Traits\CanReceiveMailers;
use CraftCodery\ClickSend\Traits\CanSendMailers;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class ClickSend
{
    protected string $base_url;
    protected PendingRequest $client;

    public function __construct()
    {
        $this->base_url = 'https://' . (app()->isProduction() ? 'rest.clicksend.com' : 'private-anon-5719b2dfad-clicksend.apiary-mock.com') . '/v3/';
        $this->client = Http::withBasicAuth(config('clicksend.username'), config('services.clicksend.key'))->timeout(15);
    }

    /**
     * Send a letter.
     *
     * @param CanSendMailers $sender
     * @param CanReceiveMailers $recipient
     * @param string $content
     *
     * @return array
     */
    public function sendLetter($sender, $recipient, string $content): array
    {
        $content = $this->formatForPdf($content);
        $pdf = $this->generatePdf($content);
        $pdf_url = $this->uploadFile($pdf->output());

        $this->client->post($this->base_url . 'post/letters/send', [
            'file_url'      => $pdf_url,
            'template_used' => 0,
            'colour'        => 0,
            'duplex'        => 1,
            'priority_post' => 0,
            'recipients'    => $this->formatDataForMailer($sender, $recipient),
        ]);

        $page_count = $pdf->getDomPdf()->getCanvas()->get_page_count();

        return ['pages' => $page_count];
    }

    /**
     * Send a postcard.
     *
     * @param CanSendMailers $sender
     * @param CanReceiveMailers $recipient
     * @param string $front_pdf_url
     * @param string $content
     *
     * @return void
     */
    public function sendPostcard($sender, $recipient, string $front_pdf_url, string $content): void
    {
        $content = $this->formatForPdf($content);
        $rear_pdf_options = [
            'view'        => 'clicksend::postcard_rear',
            'size'        => 'a5',
            'orientation' => 'landscape',
        ];
        $rear_pdf = $this->generatePdf($content, $rear_pdf_options);
        $rear_pdf_url = $this->uploadFile($rear_pdf->output());

        $this->client->post($this->base_url . 'post/postcards/send', [
            'file_urls'  => [$front_pdf_url, $rear_pdf_url],
            'recipients' => $this->formatDataForMailer($sender, $recipient),
        ]);
    }

    /**
     * Format the content for conversion to PDF.
     *
     * @param string $content
     *
     * @return string
     */
    protected function formatForPdf(string $content)
    {
        do {
            $content = preg_replace('/(<[^>]+?style="[^"]+?)\Kpx;/is', 'pt;', $content, -1, $replace_count);
        } while ($replace_count);

        return $content;
    }

    /**
     * Generate a PDF compatible with ClickSend.
     *
     * @param string $content
     * @param array $options
     *
     * @return PDF
     */
    protected function generatePdf(string $content, array $options = [])
    {
        $pdf = PDF::loadView($options['view'] ?? 'clicksend::letter', compact('content'));

        if (isset($options['size']) || isset($options['orientation'])) {
            $pdf->setPaper(
                $options['size'] ?? config('dompdf.defines.default_paper_size'),
                $options['orientation'] ?? config('dompdf.orientation')
            );
        }

        $pdf->getDomPDF()->getOptions()->setDpi(300);

        return $pdf;
    }

    /**
     * Upload a temporary file to ClickSend. Returns the URL to the uploaded file.
     *
     * @param $file
     *
     * @return string
     */
    protected function uploadFile($file)
    {
        $response = $this->client->attach('file', $file, 'file.pdf')->post('uploads?convert=post');

        return $response->json()['data']['_url'];
    }

    /**
     * Format the data for the mailer sender & recipient.
     *
     * @param CanSendMailers $sender
     * @param CanReceiveMailers $recipient
     *
     * @return array
     */
    protected function formatDataForMailer($sender, $recipient)
    {
        $data = $recipient->mailerRecipientAddress();
        $data['return_address_id'] = $this->getReturnAddressId($sender);
        $data['custom_string'] = uniqid('', true);
        $data['schedule'] = 0;

        return [$data];
    }

    /**
     * Get the ClickSend return address ID for a User,
     * also creating a return address in ClickSend if necessary.
     *
     * @param CanSendMailers $sender
     *
     * @return int
     */
    protected function getReturnAddressId($sender)
    {
        $return_address_data = $sender->mailerReturnAddress();
        $return_address_id = ClickSendReturnAddress::where('hash', md5(json_encode($return_address_data)))->value('clicksend_id');

        if (!$return_address_id) {
            return $this->createReturnAddress($sender, $return_address_data);
        }

        return $return_address_id;
    }

    /**
     * Create a return address in ClickSend.
     *
     * @param string[] $return_address_data
     *
     * @return int
     */
    protected function createReturnAddress(array $return_address_data)
    {
        $response = $this->client->post('post/return-addresses', $return_address_data);
        $response = $response->json()['data'];

        $return_address = ClickSendReturnAddress::create([
            'clicksend_id' => $response['return_address_id'],
            'hash'         => md5(json_encode($return_address_data)),
        ]);

        return $return_address->clicksend_id;
    }
}
