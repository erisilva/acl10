<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Illuminate\Http\Request; // add this line

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Validate the email for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateEmail(Request $request) : void
    {
        $this->validate($request, 
            [
                'email' => ['required', 'string', 'email', 'max:255', 'exists:users'],
                'captcha' => ['required', 'captcha'],

            ],
            [
                'captcha.required' => __('Enter the characters shown in the figure above'),
                'captcha.captcha' => __('Captcha typed incorrectly'),
            ]);
    }

}
