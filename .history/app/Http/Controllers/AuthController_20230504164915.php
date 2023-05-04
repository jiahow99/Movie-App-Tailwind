<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserReqeust;
use Illuminate\Support\Facades\Request;

class AuthController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function register(StoreUserReqeust $request)
    {
        if($request){
            dd('2323');
        }else{
            dd(31312);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function logout()
    {
        //
    }

}
