<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MySelfComment extends Model
{
    public $table = 'myself_comments';
    
    static public function getMyComment($id) {
        
        $comment_info =  DB::select('select * from myself_comments where image_id = ?', [$id]);
        return reset($comment_info);
    }

}
