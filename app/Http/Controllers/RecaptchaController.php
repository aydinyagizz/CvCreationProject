<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RecaptchaController extends Controller
{
    public function validateV3(Request $request)
    {
        dd($request->all());
        $token = $request->token;
        $validate = (object)recaptcha()->validate($token);

        if ($validate->success && $validate->score > config('recaptcha.min_score')) {
            Session::put('recaptchaV3Validate', 'success');
        } else {
            Session::put('recaptchaV3Validate', 'failed');
        }
    }
}
