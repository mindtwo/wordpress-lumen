<?php

namespace App\Providers;

use App\Models\WpOptions;
use App\Modules\Mailer\MailData;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MailData::class, function ($app) {
            return new MailData(
                new WpOptions()
            );
        });
    }
}
