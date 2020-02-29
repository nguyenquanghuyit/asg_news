<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoaiModel;
use Illuminate\View\View;
use App\SlideModel;
use App\LoaiTinModel;
use App\TinTucModel;
use Illuminate\Support\Facades\Auth;
use App\UserModel;

class PagesController extends Controller
{
    public function __construct()
    {
        $theLoai = TheLoaiModel::all();
        $slide = SlideModel::all();
        view()->share('theLoai', $theLoai);
        view()->share('slide', $slide);

        if (Auth::check()) {
            view()->share('nguoiDung', Auth::user());
        }
    }

    public function trangChu()
    {
        return view('pages.trangchu')->render();
    }

    public function lienHe()
    {
        return view('pages.lienhe');
    }

    public function loaiTin($id)
    {
        $loaiTin = LoaiTinModel::find($id);
        $tinTuc = TinTucModel::where('idLoaiTin', $id)->paginate(5);
        return view('pages.loaitin', ['loaiTin' => $loaiTin, 'tinTuc' => $tinTuc]);
    }

    public function tinTuc($id)
    {
        $tinTuc = TinTucModel::find($id);
        $tinNoiBat = TinTucModel::where('NoiBat', 1)->take(4)->get();
        $tinLienQuan = TinTucModel::where('idLoaiTin', $tinTuc->idLoaiTin)->take(4)->get();
        return view('pages.tintuc', ['tinTuc' => $tinTuc, 'tinNoiBat' => $tinNoiBat, 'tinLienQuan' => $tinLienQuan]);
    }

    function getDangNhap()
    {
        return view('pages.dangnhap');
    }

    function postDangNhap(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required',
                'password' => 'required|min:3|max:50'
            ],
            [
                'email.required' => 'Bạn chưa nhập email',
                'password.required' => 'Bạn chưa nhập password'
            ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            //return view('pages.trangchu',['nguoiDung'=>Auth::user()]);
            return redirect('trangchu');
        } else {
            return redirect('dangnhap')->with('thongbao', 'Đăng nhập không thành công');
        }
    }

    function getDangXuat()
    {
        Auth::logout();
        return redirect('trangchu');
    }

    public function getNguoiDung()
    {
        $user = Auth::user();
        return view('pages.nguoidung', ['nguoiDung' => $user]);
    }

    public function postNguoiDung()
    {
        return view('pages.nguoidung');
    }

    function getDangKy()
    {
        return view('pages.dangky');
    }
}

?>