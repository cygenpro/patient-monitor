<?php

namespace App\Http\Controllers;

use App\Events\ResendVerificationCodeRequested;
use App\Http\Requests\VerifyPhoneRequest;
use App\Services\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PhoneVerificationController extends Controller
{
    /**
     * PhoneVerificationController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('phone.throw_if_verified');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('verify-phone-number');
    }

    /**
     * @param VerifyPhoneRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function verify(VerifyPhoneRequest $request)
    {
        $code = $request->get('code');

        $verificationCode = VerificationCode::getVerificationCode( $code );

        if( !$verificationCode )
        {
            return back()->withErrors('Invalid code.');
        }

        $isExpired = VerificationCode::isExpired($verificationCode);

        if( $isExpired )
        {
            return back()->withErrors( 'Sorry, the code you have entered is expired.');
        }

        if( VerificationCode::verify($code) )
        {
            return redirect(route('home'));
        }

        return back()->withErrors( 'Something went wrong.');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resend(Request $request)
    {
        $user = $request->user();

        event(new ResendVerificationCodeRequested($user));

        return response()->json([
            'message' => "New verification code has been sent to {$user->phone} phone number."
        ], 201);
    }
}
