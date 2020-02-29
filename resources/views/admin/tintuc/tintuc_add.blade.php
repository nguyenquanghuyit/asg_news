@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin tức
                        <small>Thêm</small>
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
                    <form action="admin/tintuc/tintuc_add" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Thể loại</label>
                            <select class="form-control" name="theLoai" id="theLoai">
                                @foreach($theLoai as $tl)
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Loại tin</label>
                            <select class="form-control" id="idLoaiTin" name="LoaiTin">
                                @foreach($loaiTin as $lt)
                                    <option value="{{$tl->id}}">{{$lt->Ten}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input class="form-control" name="TieuDe" placeholder="Nhập tiêu đề"/>
                        </div>

                        <div class="form-group">
                            <label>Tóm tắt</label>
                            <textarea name="TomTat" id="TomTat" cols="30" rows="3"
                                      class="form-control ckeditor"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea name="NoiDung" id="NoiDung" cols="30" rows="3"
                                      class="form-control ckeditor"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Hình</label>
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

                        <button type="submit" class="btn btn-default">Category Add</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#theLoai").change(function () {
                var idTheLoai = $(this).val();
                $.get('admin/ajax/loaitin/' + idTheLoai, function (ketqua) {
                    $('#idLoaiTin').html(ketqua);
                });
            });
        })
    </script>
@endsection