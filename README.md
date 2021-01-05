# Simple ClickSend mailers for Laravel

This package makes it easy to send letters and postcards via ClickSend for your Laravel app.

## Installation

You can install the package via composer:

```bash
composer require craftcodery/clicksend
```

#### Preparing the database

You must publish and run migrations:

```bash
php artisan vendor:publish --provider="CraftCodery\ClickSend\ClickSendServiceProvider" --tag="migrations"
php artisan migrate
```

#### Publishing the config file

You can publish the config file with:
```bash
php artisan vendor:publish --provider="CraftCodery\ClickSend\ClickSendServiceProvider" --tag="config"
```

Publishing the config allows you to customize the environment variables used for setting your ClickSend username and API key.

## Configuring for usage

Start by setting environment variables for your ClickSend username and API Key. By default the package looks for `CLICKSEND_USERNAME` and `CLICKSEND_KEY`.

Any models that you want to be able to receive mailers need to use `CraftCodery\ClickSend\Traits\CanReceiveMailers`. This trait only requires one method, `mailerRecipientAddress`, which returns an array of formatted address information. An example of the required array structure is below.

```php
/**
 * Get the recipient's address for ClickSend mailers.
 *
 * @return array
 */
public function mailerRecipientAddress()
{
    return [
        'address_name'        => $this->name,
        'address_line_1'      => $this->address,
        'address_line_2'      => $this->address_2,
        'address_city'        => $this->city,
        'address_state'       => $this->state,
        'address_postal_code' => $this->postal_code,
        'address_country'     => $this->country,
    ];
}
```

Similarly, any models that you want to be able to send mailers need to use `CraftCodery\ClickSend\Traits\CanSendMailers`. This trait only requires the method `mailerReturnAddress`, which returns an array of formatted return address information. An example of the required array structure is below.

```php
/**
 * Get the sender's return address for ClickSend mailers.
 *
 * @return array
 */
public function mailerReturnAddress()
{
    return [
        'address_name'        => $this->name,
        'address_line_1'      => $this->address,
        'address_line_2'      => $this->address_2,
        'address_city'        => $this->city,
        'address_state'       => $this->state,
        'address_postal_code' => $this->postal_code,
        'address_country'     => $this->country,
    ];
}
```

## Sending items

The `sendLetterTo` and `sentPostcardTo` methods are available to any models using the `CanSendMailers` trait.

Each method requires a recipient model (that uses the `CanReceiveMailers` trait) as the first parameter. Letters require the content as the second parameter, while postcards require a PDF URL for the second parameter, and the content for the third parameter.

The PDF used as the second parameter in the postcard method will be sent on the front of the postcard. The content will be sent on the rear.

```php
$user->sendLetterTo($recipient, 'This is the content of the letter.');
$user->sendPostcardTo($recipient, 'https://example.com/postcard-image.pdf', 'This is the content on the rear of the postcard.');
```

## Testing

``` bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
