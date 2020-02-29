<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    protected $table="comment";
    public function TinTuc()
    {
        return $this->belongsTo('App\TinTucModel','idTinTuc','id');
    }
    public function Users()
    {
        return $this->belongsTo('App\User','idUser','id');
    }

}
