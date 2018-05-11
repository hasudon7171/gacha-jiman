<?php

namespace App\Http\Controllers;

use App\User;
use App\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
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
        return view('image');
    }
    
    // 画像詳細表示
    public function detail(Request $request)
    {
        $photo      = new Image;
        $photo_info = Image::getPhoto($request->get('id'));
        $photo_info = reset($photo_info);
        $user_id    = auth()->id();
        /*
        $comment_list = Comment::getCommentAll($request->get('id'));
        
        if($photo_info) {
            if(intval($photo_info->user_id) == auth()->id()) {
                $is_mine = true;
            }
            else {
                $is_mine = false;
            }
        }
        */
        //return view('user/detail', compact('photo_info', 'is_mine', 'user_id','comment_list'));
        return view('image', compact('photo_info'));
    }
}
