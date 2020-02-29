<?php

namespace App\Http\Controllers;

use App\LoaiTinModel;
use App\TheLoaiModel;
use App\TinTucModel;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\CommentModel;

class TinTucController extends Controller
{
    public function GetTinTuc_List()
    {
        $tbl=TinTucModel::all();

        return view('admin.tintuc.tintuc_list',['tintuc'=>$tbl]);
    }
    public function GetTinTuc_Add()
    {
        $loaiTin=LoaiTinModel::all();
        $theLoai=TheLoaiModel::all();
        return view('admin.tintuc.tintuc_add',['loaiTin'=>$loaiTin,'theLoai'=>$theLoai]);
    }
    public function PostTinTuc_Add(Request $request)
    {
        $this->validate($request,
            [
                'LoaiTin'=>'required',
                'TieuDe'=>'required|min:3|max:250|unique:TinTuc,TieuDe',
                'TomTat'=>'required',
                'NoiDung'=>'required'
                // tham số mảng thứ nhất là các lỗi
            ],
            [ //tham số mảng thứ hai là các thông báo hiển thị
                'LoaiTin.required'=>'Bạn chưa nhập tên loại tin',
                'TieuDe.min'=>'Tên tiêu đề phải từ 3 đến 250 ký tự',
                'TieuDe.max'=>'Tên tiêu đề phải từ 3 đến 250 ký tự',
                'TomTat.required'=>'Bạn chưa nhập tóm tắt',
                'NoiDung.required'=>'Bạn chưa nhập nội dung'
            ]);

        $TinTuc=new TinTucModel();
        $TinTuc->TieuDe=$request->TieuDe;
        $TinTuc->TieuDeKhongDau=changeTitle($request->TieuDe);
        $TinTuc->idLoaiTin=$request->LoaiTin;
        $TinTuc->TomTat=$request->TomTat;
        $TinTuc->NoiDung=$request->NoiDung;
        $TinTuc->SoLuotXem=0;
        if($request->hasFile('HinhAnh'))
        {
            $file=$request->file('HinhAnh');
            $name=$file->getClientOriginalName();
            $HinhAnh=$name;
            $file->move('upload/hinhanh/tintuc/'.$HinhAnh);
            $TinTuc->Hinh=$HinhAnh;
        }
        else
        {
            $TinTuc->Hinh="";
        }
        $TinTuc->save();

        return redirect('admin/tintuc/tintuc_add')->with('thongbao','Thêm thành công');
    }
    public function GetTinTuc_Edit($id)
    {
        $theLoai=TheLoaiModel::all();
        $loaiTin=LoaiTinModel::all();
        $tinTuc=TinTucModel::find($id);
        return view('admin.tintuc.tintuc_edit',['tinTuc'=>$tinTuc,'loaiTin'=>$loaiTin,'theLoai'=>$theLoai]);
    }
    public function PostTinTuc_Edit(Request $request,$id)
    {
        $this->validate($request,
            [
                'LoaiTin'=>'required',
                'TieuDe'=>'required|min:3|max:250|unique:TinTuc,TieuDe',
                'TomTat'=>'required',
                'NoiDung'=>'required'
                // tham số mảng thứ nhất là các lỗi
            ],
            [ //tham số mảng thứ hai là các thông báo hiển thị
                'LoaiTin.required'=>'Bạn chưa nhập tên loại tin',
                'TieuDe.min'=>'Tên tiêu đề phải từ 3 đến 250 ký tự',
                'TieuDe.max'=>'Tên tiêu đề phải từ 3 đến 250 ký tự',
                'TomTat.required'=>'Bạn chưa nhập tóm tắt',
                'NoiDung.required'=>'Bạn chưa nhập nội dung'
            ]);
        $TinTuc=TinTucModel::find($id);
        $TinTuc->TieuDe=$request->TieuDe;
        $TinTuc->TieuDeKhongDau=changeTitle($request->TieuDe);
        $TinTuc->idLoaiTin=$request->LoaiTin;
        $TinTuc->TomTat=$request->TomTat;
        $TinTuc->NoiDung=$request->NoiDung;
        $TinTuc->SoLuotXem=0;
        if($request->hasFile('HinhAnh'))
        {
            $file=$request->file('HinhAnh');
            $name=$file->getClientOriginalName();
            $HinhAnh=$name;
            $file->move('upload/hinhanh/tintuc/'.$HinhAnh);
            $TinTuc->Hinh=$HinhAnh;
        }
        else
        {
            $TinTuc->Hinh="";
        }
        $TinTuc->save();

        return redirect('admin/tintuc/tintuc_edit/'.$id)->with('thongbao',"Sửa thành công");
    }
    public function GetTinTuc_Del($id)
    {
        $TinTuc=TinTucModel::find($id);
        $TinTuc->delete();
        return redirect('admin/tintuc/tintuc_list')->with('thongbao',"Xóa thành công");
    }
}
