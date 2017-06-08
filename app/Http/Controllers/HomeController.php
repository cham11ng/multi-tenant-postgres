<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param $tenant
     * @return \Illuminate\Http\Response
     */
    public function index($tenant)
    {
        return view('home', compact('tenant'));
    }
}
