<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TinTucModel extends Model
{
    protected $table="tintuc";
    public function LoaiTin()
    {
        return $this->belongsTo('App\LoaiTinModel','idLoaiTin','id');
    }
    public function Comment()
    {
        return $this->hasMany('App\CommentModel','idTinTuc','id');
    }
}
