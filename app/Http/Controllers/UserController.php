<?php

namespace App\Http\Controllers;

use App\User;
use App\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUser_List()
    {
        $tbl = UserModel::all();
        return view('admin.user.user_list', ['User' => $tbl]);
    }

    public function getUser_Add()
    {
        return view('admin.user.user_add');
    }

    public function postUser_Add(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:3|max:50',
                'password2' => 'required|same:password'
            ],
            [ //tham số mảng thứ hai là các thông báo hiển thị
                'name.required' => 'Bạn chưa nhập tên user',
                'email.required' => 'Bạn chưa nhập email',
                'password.required' => 'Bạn chưa nhập password',
                'password2.required' => 'Bạn chưa nhập mật khẩu xác nhận',
                'password2.same' => 'Mật khẩu không khớp',
            ]);
        $User = new UserModel();
        $User->name = $request->name;
        $User->email = $request->email;
        $User->password = bcrypt($request->password);
        $User->quyen = $request->quyen;
        $User->save();

        return redirect('admin/user/user_add')->with('thongbao', 'Thêm thành công');
    }

    public function getUser_Edit($id)
    {
        $user = UserModel::find($id);
        return view('admin.user.user_edit', ['user' => $user]);
    }

    public function postUser_Edit(Request $request, $id)
    {
        $this->validate($request,
            [
                'name' => 'required'
            ],
            [ //tham số mảng thứ hai là các thông báo hiển thị
                'name.required' => 'Bạn chưa nhập tên user'
            ]);
        $User = UserModel::find($id);
        $User->name = $request->name;
        $User->quyen = $request->quyen;
        if ($request->changePass == "on") {
            $this->validate($request,
                [
                    'password' => 'required|min:3|max:50',
                    'password2' => 'required|same:password'
                ],
                [ //tham số mảng thứ hai là các thông báo hiển thị
                    'password.required' => 'Bạn chưa nhập password',
                    'password2.required' => 'Bạn chưa nhập mật khẩu xác nhận',
                    'password2.same' => 'Mật khẩu không khớp',
                ]);
            $User->password = bcrypt($request->password);
        }


        $User->save();
        return redirect('admin/user/user_edit/' . $id)->with('thongbao', 'Sửa thành công');
    }

    //-----
    public function getUser_Del($id)
    {
        $Sl = UserModel::find($id);
        $Sl->delete();
        return redirect('admin/user/user_list')->with('thongbao', "Xóa thành công");
    }

    public function getDangNhapAdmin()
    {
        return view('login');
    }

    public function postDangNhapAdmin(Request $request)
    {
        $this->validate($request,
            [
                "email" => "required",
                "password" => "required"
            ],
            [
                "email.required" => "Bạn chưa nhập email",
                "password.required" => "Bạn chưa nhập password"
            ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return redirect('admin/slide/slide_list');
        }
        else
        {
            return redirect('admin/dangnhap')->with('thongbao','Đăng nhập không thành công');
        }
    }
    public function getDangXuatAdmin(){
        Auth::logout();
        return redirect('admin/dangnhap');
    }
}
