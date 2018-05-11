<?php

namespace App\Http\Controllers;

use App\User;
use App\Image;
use Illuminate\Http\Request;

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
        
        $this->validate($request, [
            'file' => [
                'required',
                'image',
            ]
        ]);
        
        if($request->file('file')->isValid([])) {
            $filename = $request->file->store('/public/images');
            $message  = $request->get('message');
            $cost  = $request->get('cost');
            
            $image = new Image;
            
            if(auth()->id()) {
                $user_id = auth()->id();
            }
            else {
                $user_id = '000000';
            }
            $image->user_id   = $user_id;
            $image->path      = basename($filename);
            $image->cost      = intval($cost);
            
            $image->save();
            
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
}
