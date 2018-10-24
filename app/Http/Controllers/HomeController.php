<?php

namespace App\Http\Controllers;

use App\UseCases\Users\ApiTokenServices;
use Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $token = (new ApiTokenServices(Auth::user()))->getToken();
        return view('home',['token'=>$token]);
    }
}
