@extends('layout.index')
@section('my_content')
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$tinTuc->TieuDe}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Quang Huy đưa tin</a>
                </p>

                <!-- Preview Image -->
                <img class="img-responsive" src="upload/hinhanh/tintuc/{{$tinTuc->Hinh}}" alt="">

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on {{$tinTuc->created_at}}</p>
                <hr>

                <!-- Post Content -->
                <p class="lead">{!! $tinTuc->NoiDung !!}</p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                @if(isset($nguoiDung))
                    <div class="well">
                        @if(session('thongBao'))
                            {{session('thongBao')}}
                        @endif
                        <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                        <form method="post" role="form" action="comment/{{$tinTuc->id }}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <textarea class="form-control" rows="3" name="noiDung"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi</button>
                        </form>
                    </div>

                    <hr>
                @endif
            <!-- Posted Comments -->

                <!-- Comment -->
                @foreach($tinTuc->comment as $cm)
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="#" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{$cm->users->name}}
                                <small>{{$cm->updated_at}}</small>
                            </h4>
                            {{$cm->NoiDung}}
                        </div>
                    </div>
                @endforeach


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">
                    @foreach($tinLienQuan as $tt)
                        <!-- item -->
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">
                                        <img class="img-responsive" src="upload/hinhanh/tintuc/{{$tt->Hinh}}" alt="">
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html"><b>{{$tt->TieuDe}}</b></a>
                                </div>
                                <p>{!!$tt->TomTat!!}</p>
                                <div class="break"></div>
                            </div>
                            <!-- end item -->

                        @endforeach
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">
                    @foreach($tinNoiBat as $tt)
                        <!-- item -->
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">
                                        <img class="img-responsive" src="upload/hinhanh/tintuc/{{$tt->Hinh}}" alt="">
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <a href="#"><b>{{$tt->TieuDe}}</b></a>
                                </div>
                                <p>{!! $tt->TomTat !!}</p>
                                <div class="break"></div>
                            </div>
                            <!-- end item -->
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->
    </div>
@endsection