<?php

namespace CraftCodery\ClickSend;

use Illuminate\Support\ServiceProvider;

class ClickSendServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerPublishables();

        $this->app->bind(ClickSend::class, function () {
            $config = config('clicksend');

            return new ClickSend($config);
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/clicksend.php', 'clicksend');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'clicksend');
    }

    protected function registerPublishables(): self
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/clicksend.php' => config_path('clicksend.php'),
            ], 'config');

            if (!class_exists('CreateClicksendReturnAddressesTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_clicksend_return_addresses_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_clicksend_return_addresses_table.php'),
                ], 'migrations');
            }
        }

        return $this;
    }
}
