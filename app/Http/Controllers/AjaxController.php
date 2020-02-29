<?php

namespace App\Http\Controllers;

use App\LoaiTinModel;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getLoaiTin($idTheLoai)
    {
        $loaiTin=LoaiTinModel::where('idTheLoai',$idTheLoai)->get();

        foreach($loaiTin as $lt)
        {
            echo "<option value='".$lt->id."'>".$lt->Ten."</option>";
        }
    }
}
