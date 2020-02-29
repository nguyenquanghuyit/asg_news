<?php

namespace App\Http\Controllers;

use App\TinTucModel;
use App\CommentModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function GetComment_Del($id, $idTinTuc)
    {
        $comment = CommentModel::find($id);
        $comment->delete();
        return redirect('admin/tintuc/tintuc_edit/' . $idTinTuc)->with('thongbao', "Xóa thành công");
    }

    public function postComment($id, Request $request)
    {
        $idTinTuc = $id;
        $idTinTuc=TinTucModel::find($id);
        $comment = new CommentModel();
        $comment->idTinTuc = $idTinTuc;
        $comment->idUser = Auth::user()->id;
        $comment->NoiDung=$request->NoiDung;
        $comment->save();
        return redirect('tinTuc/$id/'.$idTinTuc->TieuDeKhongDau.".html")->width('thongBao','Viết bình luận ok');
    }
}
