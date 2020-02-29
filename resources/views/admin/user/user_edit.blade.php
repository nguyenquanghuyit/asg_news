@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>{{$user->name}}</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    <form action="admin/user/user_edit/{{$user->id}}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Họ tên</label>
                            <input class="form-control" value="{{$user->name}}" name="name"
                                   placeholder="Nhập tên tài khoản"/>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" readonly value="{{$user->email}}" name="email"
                                   placeholder="Nhập địa chỉ email"/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="changePass" id="changePass">
                            <label>Đổi mật khẩu</label>
                            <input class="form-control mat-khau" type="password" disabled name="password"
                                   placeholder="Nhập mật khẩu"/>
                        </div>
                        <div class="form-group">
                            <label>Nhập lại mật khẩu</label>
                            <input class="form-control mat-khau" type="password" disabled name="password2"
                                   placeholder="Nhập lại mật khẩu"/>
                        </div>

                        <div class="form-group">
                            <label>Phân quyền</label>
                            <label class="radio-inline">
                                <input name="quyen" value="0" @if($user->quyen==0)
                                {{"checked"}}
                                @endif
                                type="radio">Thường
                            </label>
                            <label class="radio-inline">
                                <input name="quyen" value="1"
                                       @if($user->quyen==0)
                                       {{"checked"}}
                                       @endif
                                       type="radio">Admin
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Sửa</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
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
    $(document).ready(function(){
        $("#changePass").change(function(){
            if($(this).is(":checked")){
                $(".mat-khau").removeAttr("disabled");
            }
            else {
                $(".mat-khau").attr("disabled","disabled");
            }
        });
    })
</script>
@endsection