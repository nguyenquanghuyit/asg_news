<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoaiModel;

class TheLoaiController extends Controller
{
    public function TheLoai_List()
    {
        $tbl=TheLoaiModel::all();
        return view('admin.theloai.theloai_list',['TheLoai'=>$tbl]);
    }
    public function TheLoai_Add()
    {
        return view('admin.theloai.theloai_add');
    }
    public function postTheLoai_Add(Request $request)
    {
        $this->validate($request,
            [
                'txtTenTheLoai'=>'required|min:3|max:100'
                // tham số mảng thứ nhất là các lỗi
            ],
            [ //tham số mảng thứ hai là các thông báo hiển thị
                'txtTenTheLoai.required'=>'Bạn chưa nhập tên thể loại',
                'txtTenTheLoai.min'=>'Tên thể loại phải từ 3 đến 100 ký tự',
                'txtTenTheLoai.min'=>'Tên thể loại phải từ 3 đến 100 ký tự'
            ]);
        $theLoai=new TheLoaiModel();
        $theLoai->Ten=$request->txtTenTheLoai;
        $theLoai->TenKhongDau=changeTitle($request->txtTenTheLoai);
        $theLoai->save();

        return redirect('admin/theloai/theloai_add')->with('thongbao','Thêm thành công');
    }
// ------------- edit - get
    public function TheLoai_Edit($id)
    {
        $theLoai=TheLoaiModel::find($id);
        return view('admin.theloai.theloai_edit',['theloai'=>$theLoai]);
    }
// ------------- edit - post
    public function PostTheLoai_Edit(Request $request,$id)
    {
        $theLoai=TheLoaiModel::find($id);
        $this->validate($request,
            [
            'txtTenTheLoai'=>'required|unique:TheLoai,Ten|min:3|max:250'
        ],
            [
            'txtTenTheLoai.required'=>'Bạn chưa nhập thể loại',
            'txtTenTheLoai.unique'=>'Tên thể loại đã tồn tại',
            'txtTenTheLoai.min'=>'Tên thể loại có độ dài từ 3 đến 250',
            'txtTenTheLoai.max'=>'Tên thể loại có độ dài từ 3 đến 250'
        ]);
        $theLoai->Ten=$request->txtTenTheLoai;
        $theLoai->TenKhongDau=changeTitle($request->txtTenTheLoai);
        $theLoai->save();
        return redirect('admin/theloai/theloai_edit/'.$id)->with('thongbao',"Sửa thành công");
    }

    public function GetTheLoai_Del($id)
    {
        $theLoai=TheLoaiModel::find($id);
        $theLoai->delete();
        return redirect('admin/theloai/theloai_list')->with('thongbao',"Xóa thành công");
    }
}
