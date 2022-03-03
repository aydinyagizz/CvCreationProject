<?php

namespace App\Providers;

use App\Models\Integration;
use App\Models\PersonalInformation;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\View;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $recaptcha = Integration::find(1);
        $recaptchaConfig = json_decode($recaptcha->config);
        if ($recaptcha->status) {
            config([
               'recaptcha.status' => true,
               'recaptcha.version' => $recaptchaConfig->version,
               'recaptcha.api_site_key' => $recaptchaConfig->site_key,
               'recaptcha.api_secret_key' => $recaptchaConfig->secret_key,
               'recaptcha.min_score' => $recaptchaConfig->min_score,
            ]);
        }


    }
}
