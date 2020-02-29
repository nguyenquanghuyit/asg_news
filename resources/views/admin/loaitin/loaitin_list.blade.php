@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Loại tin
                    <small>Danh sách</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr align="center">
                    <th>ID</th>
                    <th>Tên loại tin</th>
                    <th>Tên không dấu</th>
                    <th>Thể loại</th>
                    <th>Xóa</th>
                    <th>Sửa</th>
                </tr>
                </thead>
                <tbody>
                @foreach($loaitin as $dong)
                <tr class="odd gradeX" align="center">
                    <td>{{$dong->id}}</td>
                    <td>{{$dong->Ten}}</td>
                    <td>{{$dong->TenKhongDau}}</td>
                    <td>{{$dong->TheLoai->Ten}}</td>
                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/loaitin/loaitin_del/{{$dong->id}}">Xóa</a></td>
                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/loaitin/loaitin_edit/{{$dong->id}}">Sửa</a></td>
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