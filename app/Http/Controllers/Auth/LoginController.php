<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    protected function authenticated(Request $request, $user)
    {
        // Get request token from API
        $request = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/authentication/token/new')->json();

        // Cache request token
        if($request['success'])
        {
            $request_token = $request['request_token'];
            Redis::set('request_token', $request_token, 'EX', '3600');
        }

        // Redirect to API authenticate request token
        return redirect('https://www.themoviedb.org/authenticate/'.$request_token.'?redirect_to='.route('request.token.authenticate'));
    }
}
