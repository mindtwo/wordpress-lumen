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
        // TODO: set storage path
        // $this->app->useStoragePath(config('what_ever_you_want'));

        $this->app->singleton(MailData::class, function ($app) {
            return new MailData(
                new WpOptions()
            );
        });
    }
}
