<?php

namespace App\Http\Controllers;

use App\User;
use App\Image;

use Illuminate\Http\Request;

class ListController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photo_list = Image::orderBy('updated_at', 'desc')->get();
        $user_info  = \Auth::user();
        
        return view('/list', compact('photo_list', 'user_info'));
    }
}
