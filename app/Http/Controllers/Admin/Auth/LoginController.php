<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller
{
    use AuthenticatesUsers;
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
	{
	   return view('admin.auth.login');
	}

	public function login(Request $request)
	{
	    $this->validateLogin($request);

	    // If the class is using the ThrottlesLogins trait, we can automatically throttle
	    // the login attempts for this application. We'll key this by the username and
	    // the IP address of the client making these requests into this application.
	    if ($this->hasTooManyLoginAttempts($request)) {
	        $this->fireLockoutEvent($request);

	        return $this->sendLockoutResponse($request);
	    }

	    if ($this->attemptLogin($request)) {
	        return $this->sendLoginResponse($request);
	    }

	    // If the login attempt was unsuccessful we will increment the number of attempts
	    // to login and redirect the user back to the login form. Of course, when this
	    // user surpasses their maximum number of attempts they will get locked out.
	    $this->incrementLoginAttempts($request);

	    return $this->sendFailedLoginResponse($request);
	}

	protected function validateLogin(Request $request)
	{
	    $this->validate($request, [
	        $this->username() => 'required|string',
	        'password' => 'required|string',
	    ]);
	}

	/**
	 * Attempt to log the user into the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return bool
	 */
	protected function attemptLogin(Request $request)
	{
	    return $this->guard()->attempt(
	        $this->credentials($request), $request->has('remember')
	    );
	}

	public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }
    
	protected function guard()
    {
        return Auth::guard();
    }

}
