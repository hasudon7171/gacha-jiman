<?php

namespace App\Http\Controllers;

use App\User;
use App\Image;
use App\MySelfComment;

use Illuminate\Http\Request;

define('MEMBER_UPLOAD_MAX',     5);
define('CAN_UPLOAD',               0);  // アップロード可能
define('CAN_NOT_UPLOAD_NONACTIVE',  1); // アップロード不可：非会員アップロード上限超過
define('CAN_NOT_UPLOAD_ACTIVE',     2); // アップロード不可：会員アップロード上限超過

class UploadController extends Controller
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
        return view('upload');
    }
    
    // 画像アップロード
    public function store(Request $request) {
        
        $request->validate([
        'file' => 'required|image|max:2048',
        'cost' => 'numeric',
        ]);
        
        $is_login  = \Auth::check();
        $user_info = \Auth::user();
        $is_upload = $this->get_is_upload();
                
        if($is_upload == UPLOAD_ERROR_ACTIVE) {
            return redirect('/upload')->with('message', MEMBER_UPLOAD_MAX.'枚以上アップロードできません。プレミアムメンバー登録をしてください。');
        }
        elseif($is_upload == UPLOAD_ERROR_NONACTIVE) {
            return redirect('/upload')->with('message', '本日はアップロードできません。会員登録をしてください。');
        }
        
        if($request->file('file')->isValid([])) {
            $filename   = $request->file->store('/public/images');
            $message    = $request->get('message');
            $cost       = $request->get('cost');
            $my_comment = $request->get('myself_comment');
            
            $image = new Image;
            
            if($is_login) {
                $user_id = $user_info->id;
            }
            else {
                $user_id = 'ip_'.ip2long($_SERVER["REMOTE_ADDR"]);
            }
            
            // 画像アップロード
            $image->user_id   = $user_id;
            $image->name      = basename($filename);
            $image->path      = $filename;
            $image->cost      = intval($cost);
            
            $image->save();
            
            $image_id = \DB::getPdo()->lastInsertId();
            
            if($is_login && $image_id) {
                // 本人コメント
                $myself_comment = new MySelfComment;
                $myself_comment->user_id    = $user_id;
                $myself_comment->image_id   = $image_id;
                $myself_comment->comment    = $my_comment;
                $myself_comment->save();
            }
            return redirect('/upload')->with('message', 'アップロードしました。');
        }
        else {
            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['file' => '画像がアップロードされていないか不正なデータです。']);
        }
        
        return view('/upload');
    }
    
    // アップロード可能かを判定
    private function get_is_upload() {
        
        $user_info = \Auth::user();
        $is_upload = CAN_UPLOAD;
        
        if($user_info) {
            $user_id   = $user_info->id;
        
            if($user_info->status == STATUS_MEMBER) {
                $count = Image::where('$user_id', $user_id)->count();
                if($count > MEMBER_UPLOAD_MAX) {
                    $is_upload = CAN_NOT_UPLOAD_ACTIVE;
                }
            }
        }
        else {
            $user_id = 'ip_'.ip2long($_SERVER["REMOTE_ADDR"]);
            
            $nonactive_upload = \DB::select('select * from images where user_id = ?', [$user_id]);
            if($nonactive_upload) {
                $is_upload = CAN_NOT_UPLOAD_NONACTIVE;
            }
        }
        
        return $is_upload;
    }

}
