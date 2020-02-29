<?php

namespace App\Http\Controllers;

use App\LoaiTinModel;
use App\TheLoaiModel;
use App\SlideModel;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    public function GetSlide_List()
    {
        $tbl=SlideModel::all();

        return view('admin.slide.slide_list',['Slide'=>$tbl]);
    }
    public function GetSlide_Add()
    {
        return view('admin.slide.slide_add');
    }
    public function PostSlide_Add(Request $request)
    {
        $this->validate($request,
            [
                'Ten'=>'required',
                'NoiDung'=>'required|min:3|max:250'
            ],
            [ //tham số mảng thứ hai là các thông báo hiển thị
                'Ten.required'=>'Bạn chưa nhập tên loại tin',
                'NoiDung.required'=>'Bạn chưa nhập nội dung'
            ]);

        $Slide=new SlideModel();
        $Slide->Ten=$request->Ten;
        $Slide->NoiDung=$request->NoiDung;
        $Slide->Link=$request->Link;
        //upload/hinhanh/slide/
        if($request->hasFile('HinhAnh'))
        {
            $file=$request->file('HinhAnh');
            $name=$file->getClientOriginalName();
            $HinhAnh=$name;
            $file->move('upload/hinhanh/slide',$HinhAnh);
            $Slide->Hinh=$HinhAnh;
        }
        else
        {
            $Slide->Hinh="";
        }
        $Slide->save();

        return redirect('admin/slide/slide_add')->with('thongbao','Thêm thành công');
    }
    public function GetSlide_Edit($id)
    {
        $Slide=SlideModel::find($id);
        return view('admin.slide.slide_edit',['Slide'=>$Slide]);
    }
    public function PostSlide_Edit(Request $request,$id)
    {
        $this->validate($request,
            [
                'Ten'=>'required',
                'NoiDung'=>'required|min:3|max:250'
            ],
            [ //tham số mảng thứ hai là các thông báo hiển thị
                'Ten.required'=>'Bạn chưa nhập tên loại tin',
                'NoiDung.required'=>'Bạn chưa nhập nội dung'
            ]);
        $Slide=SlideModel::find($id);
        $Slide->Ten=$request->Ten;
        $Slide->NoiDung=$request->NoiDung;
        $Slide->Link=$request->Link;

        if($request->hasFile('HinhAnh'))
        {
            $file=$request->file('HinhAnh');
            $name=$file->getClientOriginalName();
            $HinhAnh=$name;
            $file->move('upload/hinhanh/slide',$HinhAnh);
            $Slide->Hinh=$HinhAnh;
        }
        else
        {
            $Slide->Hinh="";
        }
        $Slide->save();

        return redirect('admin/slide/slide_list')->with('thongbao','Thêm thành công');
    }
    public function GetSlide_Del($id)
    {
        $Sl=SlideModel::find($id);
        $Sl->delete();
        return redirect('admin/slide/slide_list')->with('thongbao',"Xóa thành công");
    }
}
