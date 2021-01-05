<?php

namespace CraftCodery\ClickSend\Traits;

use CraftCodery\ClickSend\ClickSend;

trait CanSendMailers
{
    /**
     * Get the sender's return address for ClickSend mailers.
     *
     * @return array
     */
    abstract public function mailerReturnAddress();

    /**
     * Send a letter.
     *
     * @param CanReceiveMailers $recipient
     * @param string $content
     *
     * @return array
     */
    public function sendLetterTo($recipient, string $content)
    {
        return app(ClickSend::class)->sendLetter($this, $recipient, $content);
    }

    /**
     * Send a postcard.
     *
     * @param CanReceiveMailers $recipient
     * @param string $front_pdf_url
     * @param string $content
     *
     * @return void
     */
    public function sendPostcardTo($recipient, string $front_pdf_url, string $content)
    {
        app(ClickSend::class)->sendPostcard($this, $recipient, $front_pdf_url, $content);
    }
}
