<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

	/**
	 * Authenticate the user at Login
	 */
	public function make(): JsonResponse
	{
		$authUser = Auth::attempt([
			'email' => request('email'),
			'password' => request('password')
		]);

		if ($authUser) {
			$user = Auth::user();
			$user->setRememberToken(Str::random(60));
			$user->save();
			$user->makeVisible('remember_token');

			return response()->json(
				['status' => 'success', 'data' => $user],
				200
			);
		} else {
			return response()->json([
				'error' => 'Email and password combination is incorrect.'],
				401
			);
		}
	}
}
