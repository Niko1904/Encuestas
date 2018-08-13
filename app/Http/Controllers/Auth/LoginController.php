<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Auth;

class LoginController extends Controller
{   

    use AuthenticatesUsers;
  
    protected $redirectTo = '/home';

    public function getSocialRedirect($account){
        try{
            return Socialite::with( $account )->redirect();
        }catch ( \InvalidArgumentException $e ){
            return redirect('/login');
        }
    }

    public function getSocialCallback( $account ){
      
      $socialUser = Socialite::with( $account )->user();
      $user = User::where( 'provider_id', '=', $socialUser->id )
        ->where( 'provider', '=', $account )
        ->first();
      
      if( $user == null ){
        $newUser = new User();
        $newUser->name        = $socialUser->getName();
        $newUser->email       = $socialUser->getEmail() == '' ? '' : $socialUser->getEmail();
        $newUser->avatar      = $socialUser->getAvatar();
        $newUser->password    = '';
        $newUser->provider    = $account;
        $newUser->provider_id = $socialUser->getId();
        $newUser->save();
        $user = $newUser;
      }
      Auth::login( $user );
      return redirect('/');
    }
   
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
