@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slide
                    <small>Danh sách</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
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
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr align="center">
                    <th>ID</th>
                    <th>Tên slide</th>
                    <th>Nội dung</th>
                    <th>Hình</th>
                    <th>Link</th>
                    <th>Delete</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                @foreach($Slide as $sd)
                <tr class="odd gradeX" align="center">
                    <td>{{$sd->id}}</td>
                    <td>{{$sd->Ten}}</td>
                    <td>{{$sd->NoiDung}}</td>
                    <td><img style="width:300px" src="upload/hinhanh/slide/{{$sd->Hinh}}"></td>
                    <td>{{$sd->Link}}</td>
                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/slide/slide_del/{{$sd->id}}">Xóa</a></td>
                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/slide/slide_edit/{{$sd->id}}">Sửa</a></td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection