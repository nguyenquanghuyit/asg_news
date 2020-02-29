<?php

namespace App\Http\Controllers;

use App\LoaiTinModel;
use Illuminate\Http\Request;
use App\TheLoaiModel;

class LoaiTinController extends Controller
{
    public function GetLoaiTin_List()
    {
        $tbl=LoaiTinModel::all();

        return view('admin.loaitin.loaitin_list',['loaitin'=>$tbl]);
    }
    public function GetLoaiTin_Add()
    {
        $tbl=TheLoaiModel::all();
        return view('admin.loaitin.loaitin_add',['theloai'=>$tbl]);
    }
    public function postLoaiTin_Add(Request $request)
    {

        $this->validate($request,
            [
                'txtTen'=>'required|min:3|max:100','cboTheLoai'=>'required'
                // tham số mảng thứ nhất là các lỗi
            ],
            [ //tham số mảng thứ hai là các thông báo hiển thị
                'txtTen.required'=>'Bạn chưa nhập tên loại tin',
                'txtTen.min'=>'Tên thể loại phải từ 3 đến 100 ký tự',
                'txtTen.min'=>'Tên thể loại phải từ 3 đến 100 ký tự',
                'cboTheLoai.required'=>'Bạn chưa chọn thể loại'
            ]);

        $LoaiTin=new LoaiTinModel();
        $LoaiTin->Ten=$request->txtTen;
        $LoaiTin->TenKhongDau=changeTitle($request->txtTen);
        $LoaiTin->idTheLoai=$request->cboTheLoai;
        $LoaiTin->save();

        return redirect('admin/loaitin/loaitin_add')->with('thongbao','Thêm thành công');
    }
    public function GetLoaiTin_Edit($id)
    {
        $theLoai=TheLoaiModel::all();
        $LoaiTin=LoaiTinModel::find($id);
        return view('admin.loaitin.loaitin_edit',['loaitin'=>$LoaiTin,'theloai'=>$theLoai]);
    }
    public function PostLoaiTin_Edit(Request $request,$id)
    {

        $LoaiTin=LoaiTinModel::find($id);
//        $this->validate($request,
//            [
//                'txtTenLoaiTin'=>'required|unique:LoaiTin,Ten|min:3|max:250'
//            ],
//            [
//                'txtTenLoaiTin.required'=>'Bạn chưa nhập thể loại',
//                'txtTenLoaiTin.unique'=>'Tên thể loại đã tồn tại',
//                'txtTenLoaiTin.min'=>'Tên thể loại có độ dài từ 3 đến 250',
//                'txtTenLoaiTin.max'=>'Tên thể loại có độ dài từ 3 đến 250'
//            ]);

        $LoaiTin->Ten=$request->txtTen;
        $LoaiTin->TenKhongDau=changeTitle($request->txtTen);
        $LoaiTin->save();
        return redirect('admin/loaitin/loaitin_edit/'.$id)->with('thongbao',"Sửa thành công");
    }
    public function GetLoaiTin_Del($id)
    {
        $LoaiTin=LoaiTinModel::find($id);
        $LoaiTin->delete();
        return redirect('admin/loaitin/loaitin_list')->with('thongbao',"Xóa thành công");
    }
}
