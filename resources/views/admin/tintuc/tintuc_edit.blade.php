@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin tức
                        <small>Sửa</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif
                    <form action="admin/tintuc/tintuc_edit/{{$tinTuc->id}}}" method="POST"
                          enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Thể loại</label>
                            <select class="form-control" name="theLoai" id="theLoai">
                                @foreach($theLoai as $tl)
                                    <option
                                            @if($tinTuc->loaitin->theloai->id==$tl->id)
                                            {{"selected"}}
                                            @endif
                                            value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Loại tin</label>
                            <select class="form-control" id="idLoaiTin" name="LoaiTin">
                                @foreach($loaiTin as $lt)
                                    <option
                                            @if($tinTuc->loaitin->id==$lt->id)
                                            {{"selected"}}
                                            @endif
                                            value="{{$tl->id}}">{{$lt->Ten}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input class="form-control" value="{{$tinTuc->TieuDe}}" name="TieuDe" placeholder="Nhập tiêu đề"/>
                        </div>

                        <div class="form-group">
                            <label>Tóm tắt</label>
                            <textarea name="TomTat" id="TomTat" cols="30" rows="3" value="{{$tinTuc->TomTat}}"
                                      class="form-control ckeditor"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea name="NoiDung" id="NoiDung" cols="30" rows="3" value="{{$tinTuc->NoiDung}}"
                                      class="form-control ckeditor"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Hình</label>
                            <img src="upload/hinhanh/tintuc/{{$tinTuc->Hinh}}">

                            <input type="file" name="HinhAnh" id="idHinhAnh" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Nổi bật</label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="0" checked="" type="radio">Không
                            </label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="1" type="radio">Có
                            </label>
                        </div>

                        <button type="submit" class="btn btn-default">Sửa</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                    </form>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Bình luận
                        <small>Danh sách</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                @endif
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Người dùng</th>
                        <th>Nội dung</th>
                        <th>Ngày đăng</th>

                        <th>Xóa</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tinTuc->comment as $cm)
                        <tr class="odd gradeX" align="center">
                            <td>{{$cm->id}}</td>
                            <td>{{$cm->users->name}}</td>
                            <td>{{$cm->NoiDung}}</td>
                            <td>{{$cm->created_at}}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/comment_del/{{$cm->id}}/{{$tinTuc->id}}">Xóa</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{--end row--}}
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection