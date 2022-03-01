<?php

namespace App\Http\Middleware;

use App\Models\PersonalInformation;
use App\Models\SocialMedia;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class FrontDataShareMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // sosyal medyaları her tarafta kullandığımız için her seferinde compact ile diğer sayfalara gönderilmesi yerine buraya yazıyoruz. Kod tekrarından kurtuluytoruz.
        $socialMediaData = SocialMedia::where('status', 1)->orderBy('social_order', 'ASC')->get();
        $personal = PersonalInformation::find(1);
        // veriyi view'ler ile paylaşıyoruz.
        View::share('socialMediaData', $socialMediaData);
        View::share('personal', $personal);

        return $next($request);
    }
}
