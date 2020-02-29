<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaiTinModel extends Model
{
    protected $table="loaitin";

    public function TinTuc()
    {
        return $this->hasMany('App\TinTucModel','idLoaiTin','id');
    }

    public function TheLoai()
    {
        return $this->belongsTo('App\TheLoaiModel','idTheLoai','id');
    }
}
