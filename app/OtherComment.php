<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OtherComment extends Model
{
    public $table = 'other_comments';

    static public function getOtherComment($user_id, $image_id) {
        
        return DB::select('select * from other_comments where image_id = ? AND user_id = ?', [$image_id, $user_id]);
        
    }
    
    static public function getAllComment($id) {
        
        return DB::select('select * from other_comments where image_id = ?', [$id]);
        
    }
}
