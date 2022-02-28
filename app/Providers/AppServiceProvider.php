<?php

namespace App\Providers;

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
        // sosyal medyaları her tarafta kullandığımız için her seferinde compact ile diğer sayfalara gönderilmesi yerine buraya yazıyoruz. Kod tekrarından kurtuluytoruz.
        $socialMediaData = SocialMedia::where('status', 1)->get();
        $personal = PersonalInformation::find(1);
        // veriyi view'ler ile paylaşıyoruz.
        View::share('socialMediaData', $socialMediaData);
        View::share('personal', $personal);
    }
}
