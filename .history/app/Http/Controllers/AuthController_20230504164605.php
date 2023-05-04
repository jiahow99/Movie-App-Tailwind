<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserReqeust;
use Illuminate\Support\Facades\Request;

class AuthController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function register(Request $request)
    {
        // $request->validated($request->all());
        dd($request->all());
    }


    /**
     * Show the form for creating a new resource.
     */
    public function logout()
    {
        //
    }

}
