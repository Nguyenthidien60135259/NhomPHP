 @extends('layout.index')
 @section('content')
 <!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$tintuc->TieuDe}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">admin</a>
                </p>

                <!-- Preview Image -->
                <img  class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="">

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on: {{$tintuc->created_at}}</p>
                <hr>

                <!-- Post Content -->
                <p class="lead">
                	
                	{!! $tintuc->NoiDung !!}
                </p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                @if(Auth::check())
                <div class="well">
                	@if(session('thongbao'))
                	<div class="alert alert-success">
                		{{session('thongbao')}}
                		</div>
                	@endif
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    <form action="comment/{{$tintuc->id}}" method="POST" role="form">
                    	<input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <textarea class="form-control" name="NoiDung" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </form>
                </div>

                <hr>
                @endif

                <!-- Posted Comments -->

                <!-- Comment -->
                @foreach($tintuc->comment as $cm)
                <div class="media">
                    <a class="pull-left" href="#">
                        <img width="64px" height="64px" class="media-object" src="upload/tintuc/user.jpg" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$cm->user->name}}
                            <small>{{$cm->created_at}}</small>
                        
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
                    	@foreach($tinlienquan as $tintuc)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="tintuc/{{$tintuc->id}}/{{$tintuc->TieuDeKhongDau}}.html">
                                    <img class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="tintuc/{{$tintuc->id}}/{{$tintuc->TieuDeKhongDau}}.html"><b>{{$tintuc->TieuDe}}</b></a>
                            </div>
                           <!--  <p style="padding-left: 5px; padding-right: 5px">{{$tintuc->TomTat}}</p> -->
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                        @endforeach
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">
                    	@foreach($tinnoibat as $tt)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">
                                    <img class="img-responsive" src="upload/tintuc/{{$tt->Hinh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html"><b>{{$tt->TieuDe}}</b></a>
                            </div>
                            <!-- <p style="padding-left: 5px; padding-right: 5px">{{$tt->TomTat}}</p> -->
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
    <!-- end Page Content -->
 @endsection
