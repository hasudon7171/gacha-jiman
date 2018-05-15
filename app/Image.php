<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Image extends Model
{
    public $table = 'images';
    
    static public function getMyPhoto($id) {
        
        return DB::select('select * from images where user_id = ?', [$id]);
        
    }
    
    static public function getPhoto($id) {
        
        $image_info = DB::select('select * from images where id = ?', [$id]);
        return reset($image_info);
    }
}
