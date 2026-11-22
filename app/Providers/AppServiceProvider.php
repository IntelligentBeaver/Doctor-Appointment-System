<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use RemoteMerge\Esewa\Contracts\EpayInterface;
use RemoteMerge\Esewa\EsewaFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Resolved per use, so route() can build absolute callback URLs for the current request.
        // Pass ['failure_url' => ...] to make() to override a callback URL for one payment.
        $this->app->bind(EpayInterface::class, function ($app, array $overrides = []) {
            return EsewaFactory::createEpay(array_merge([
                'environment' => config('services.esewa.environment'),
                'product_code' => config('services.esewa.product_code'),
                'secret_key' => config('services.esewa.secret_key'),
                'success_url' => route('payments.success'),
                'failure_url' => route('payments.failure'),
            ], $overrides));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
