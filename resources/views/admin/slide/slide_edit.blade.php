@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slide
                    <small>{{$Slide->Ten}}</small>
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
                <form action="admin/slide/slide_edit/{{$Slide->id}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <div class="form-group">
                        <label>Tên</label>
                        <input class="form-control" name="Ten" value="{{$Slide->Ten}}" placeholder="Nhập tên slide"/>
                    </div>

                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea name="NoiDung" id="NoiDung" cols="30" rows="3"
                                  class="form-control ckeditor">{{$Slide->NoiDung}}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Link</label>
                        <input class="form-control" value="{{$Slide->link}}" name="Link" placeholder="Nhập link"/>
                    </div>

                    <div class="form-group">
                        <label>Hình</label>
                        <img src="upload/hinhanh/slide/{{$Slide->Hinh}}" style="width:100px"><br>
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
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
    @endsection