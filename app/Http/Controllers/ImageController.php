<?php

namespace App\Http\Controllers;

use App\User;
use App\Image;
use App\MySelfComment;
use App\OtherComment;

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
        $user_id    = auth()->id();
        $is_login   = \Auth::check();
        $photo_info = Image::getPhoto($request->get('id'));
        $is_mine    = false;
        
        $my_comment_info      = MyselfComment::getMyComment($request->get('id'));
        $other_comment_info   = OtherComment::getAllComment($request->get('id'));
        
        if($user_id && $photo_info) {
            if(intval($photo_info->user_id) == $user_id) {
                $is_mine = true;
            }
        }
        return view('image', compact('photo_info', 'my_comment_info', 'other_comment_info', 'is_mine', 'is_login'));
    }
    
    // 画像更新
    public function edit(Request $request)
    {
        $user_id    = auth()->id();
        $is_login   = \Auth::check();
        $photo_info = Image::getPhoto($request->get('id'));
        $is_mine    = $request->get('is_mine');
        
        if($is_mine) {
            $my_comment = $request->get('my_comment');
            $this->set_my_comment($user_id, $photo_info->id, $my_comment);
        }
        else {
            $other_comment = $request->get('other_comment');
            $this->set_other_comment($user_id, $photo_info->id, $other_comment);
        }
        
        $my_comment_info      = MyselfComment::getMyComment($request->get('id'));
        $other_comment_info   = OtherComment::getAllComment($request->get('id'));
        
        return view('image', compact('photo_info', 'my_comment_info', 'other_comment_info', 'is_mine', 'is_login'));
    }
    
    // 自身の画像コメント編集
    private function set_my_comment($user_id, $image_id, $my_comment) {
        
        if(MyselfComment::getMyComment($image_id)) {
            // 更新
            MySelfComment::where('image_id', $image_id)->update(['comment' => $my_comment]);
        }
        else {
            // 追加
            $myself_comment = new MySelfComment;
            $myself_comment->user_id   = $user_id;
            $myself_comment->image_id  = $image_id;
            $myself_comment->comment   = $my_comment;

            $myself_comment->save();
        }
    }
    
    // 他人の画像コメント編集
    private function set_other_comment($user_id, $image_id, $comment) {
        
        if(OtherComment::getOtherComment($user_id, $image_id)) {
            // 更新
            OtherComment::where('image_id', $image_id)->update(['comment' => $comment]);
        }
        else {
            // 追加
            $other_comment = new OtherComment;
            $other_comment->user_id   = $user_id;
            $other_comment->image_id  = $image_id;
            $other_comment->comment   = $comment;

            $other_comment->save();

        }
    }
}
