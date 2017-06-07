<?php

namespace App\Http\Controllers;

use App\Http\Facades\PGSchema;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        PGSchema::switchTo('cham11ng');

        return view('home');
    }
}
