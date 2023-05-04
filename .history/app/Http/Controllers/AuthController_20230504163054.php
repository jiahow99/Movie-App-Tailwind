<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserReqeust;

class AuthController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function login(StoreUserReqeust $request)
    {
        $request->validated($request->all());
    }


    /**
     * Show the form for creating a new resource.
     */
    public function logout()
    {
        //
    }

}
