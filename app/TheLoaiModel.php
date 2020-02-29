<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoaiModel extends Model
{
    protected $table="theloai";

    public function LoaiTin()
    {
        return $this->hasMany('App\LoaiTinModel','idTheLoai','id');
    }
    public function TinTuc()
    {
        return $this->hasManyThrough('App\TinTucModel','App\TheLoaiModel','idTheLoai','idLoaiTin','id');
    }
}
