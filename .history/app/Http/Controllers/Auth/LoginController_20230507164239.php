<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * The user has been authenticated.
     *
     */
    protected function authenticated(Request $request, $user)
    {
        // Generate Guest Session Id
        $user->generate_new_session_id();
    }


    /**
     * Log the user out of the application.
     *
     */
    public function logout(Request $request)
    {
        $user = Auth::user();

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }
        
        $user->clear_guest_session();

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
    

    /**
     * User login with github
     *
     */
    public function github()
    {
        // send user's request to github
        return Socialite::driver('github')->redirect();
    }


    /**
     * Github login callback
     */
    public function githubRedirect()
    {
        // get oauth request back from github to user
        $githubUser = Socialite::driver('github')->user();

        // check if user registered, else login them
        $user = User::updateOrCreate([
            'email' => $githubUser->email,
        ], [
            'name' => $githubUser->nickname,
            'email' => $githubUser->email,
            'password' => Hash::make(Str::random(24)),
            'github_id' => $githubUser->id,
        ]);

        Auth::login($user);
        
        $logged_user = Auth::user();

        // Generate new session id (Movie API)
        $logged_user->generate_new_session_id();

        return redirect('/');
    }


    /**
     * User login with google
     *
     */
    public function google()
    {
        // send user's request to google
        return Socialite::driver('google')->redirect();        
    }


    /**
     * Google login callback
     */
    public function googleRedirect()
    {
        // get oauth request back from google to user
        $googleUser = Socialite::driver('google')->user();

        // check if user registered, else login them
        $user = User::updateOrCreate([
            'email' => $googleUser->email,
        ], [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'password' => Hash::make(Str::random(24)),
            'google_id' => $googleUser->id,
        ]);
        
        Auth::login($user);

        $logged_user = Auth::user();

        // Generate new session id (Movie API)
        $logged_user->generate_new_session_id();
        
        return redirect('/');
    }


    /**
     * User login with facebook (require SSL)
     *
     */
    public function facebook()
    {
        // send user's request to facebook
        return Socialite::driver('facebook')->redirect();
    }


    /**
     * Facebook login callback
     */
    public function facebookRedirect()
    {
        // get oauth request back from facebook to user
        $facebookUser = Socialite::driver('facebook')->user();

        dd($facebookUser);

        // // check if user registered, else login them
        $user = User::updateOrCreate([
            'email' => $facebookUser->email,
        ], [
            'name' => $facebookUser->nickname,
            'email' => $facebookUser->email,
            'password' => Hash::make(Str::random(24)),
            'facebook_id' => $facebookUser->id,
        ]);

        Auth::login($user);

        $logged_user = Auth::user();

        // Generate new session id (Movie API)
        $logged_user->generate_new_session_id();

        return redirect('/');

    }

}
