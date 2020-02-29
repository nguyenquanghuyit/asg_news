<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\TheLoaiModel;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/getTheLoaiList',function (){
   $tbl=TheLoaiModel::all();
   foreach($tbl as $theLoai)
   {
       echo $theLoai->Ten."<br>";
   }

});
//Bài 4. Tạo giao diện admin
Route::get('theloai_list',function (){
    return view('admin.theloai.theloai_list');
});

Route::get("admin/dangnhap","UserController@getDangNhapAdmin");
Route::post("admin/dangnhap","UserController@postDangNhapAdmin");
Route::get('admin/logout','UserController@getDangXuatAdmin');

//Bài 5: Tạo Route cho admin
//http://localhost:8080/asg_news/public/admin/theloai/theloai_list
Route::group(['prefix'=>'admin','middleware'=>'adminlogin'],function (){
    Route::group(['prefix'=>'theloai'],function (){
        Route::get('theloai_list','TheLoaiController@TheLoai_List');

        Route::get('theloai_edit/{id}','TheLoaiController@TheLoai_Edit');
        Route::post('theloai_edit/{id}','TheLoaiController@PostTheLoai_Edit');

        Route::get('theloai_add','TheLoaiController@TheLoai_Add');
        Route::post('theloai_add','TheLoaiController@PostTheLoai_Add');

        Route::get('theloai_del/{id}','TheLoaiController@GetTheLoai_Del');

    });
    //http://localhost:8080/asg_news/public/admin/loaitin/loaitin_list
    Route::group(['prefix'=>'loaitin'],function (){
        Route::get('loaitin_list','LoaiTinController@GetLoaiTin_List');

        Route::get('loaitin_edit/{id}','LoaiTinController@GetLoaiTin_Edit');
        Route::post('loaitin_edit/{id}','LoaiTinController@PostLoaiTin_Edit');

        Route::get('loaitin_add','LoaiTinController@GetLoaiTin_Add');
        Route::post('loaitin_add','LoaiTinController@postLoaiTin_Add');

        Route::get('loaitin_del/{id}','LoaiTinController@GetLoaiTin_Del');

    });

    //http://localhost:8080/asg_news/public/admin/tintuc/tintuc_list
    Route::group(['prefix'=>'tintuc'],function (){
        Route::get('tintuc_list','TinTucController@GetTinTuc_List');

        Route::get('tintuc_edit/{id}','TinTucController@GetTinTuc_Edit');
        Route::post('tintuc_edit/{id}','TinTucController@PostTinTuc_Edit');

        Route::get('tintuc_add','TinTucController@GetTinTuc_Add');
        Route::post('tintuc_add','TinTucController@PostTinTuc_Add');

        Route::get('tintuc_del/{id}','TinTucController@GetTinTuc_Del');

    });
    //http://localhost:8080/asg_news/public/admin/slide/slide_list
    Route::group(['prefix'=>'slide'],function (){
        Route::get('slide_list','SlideController@GetSlide_List');

        Route::get('slide_edit/{id}','SlideController@GetSlide_Edit');
        Route::post('slide_edit/{id}','SlideController@PostSlide_Edit');

        Route::get('slide_add','SlideController@GetSlide_Add');
        Route::post('slide_add','SlideController@PostSlide_Add');

        Route::get('slide_del/{id}','SlideController@GetSlide_Del');
    });

    //http://localhost:8080/asg_news/public/admin/user/slide_list
    Route::group(['prefix'=>'user'],function (){
        Route::get('user_list','UserController@getUser_List');

        Route::get('user_edit/{id}','UserController@getUser_Edit');
        Route::post('user_edit/{id}','UserController@postUser_Edit');

        Route::get('user_add','UserController@getUser_Add');
        Route::post('user_add','UserController@postUser_Add');

        Route::get('user_del/{id}','UserController@getUser_Del');
    });

    //ajax/loaitin/'+idTheLoai
    Route::group(['prefix'=>'ajax'],function(){
        Route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTin');
    });

    Route::group(['prefix'=>'comment'],function(){
        Route::get('comment_del/{id}/{idTinTuc}','CommentController@GetComment_Del');
    });
    // trang chủ

});
Route::get('trangchu','PagesController@trangChu');
Route::get('lienhe','PagesController@lienHe');
Route::get('loaitin/{id}/{TenKhongDau}.html','PagesController@loaiTin');
Route::get('tintuc/{id}/{TenKhongDau}.html','PagesController@tinTuc');


route::get('dangxuat','PagesController@getDangXuat');
Route::get('dangnhap','PagesController@getDangNhap');
Route::post('dangnhap','PagesController@postDangNhap');
Route::post('comment/{id}','CommentController@postComment');

Route::get('nguoidung','PagesController@getNguoiDung');
Route::post('nguoidung','PagesController@postNguoiDung');
Route::get('dangky','PagesController@getDangKy');