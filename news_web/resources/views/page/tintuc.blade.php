 @extends('layout.index')
 @section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <h1>{{$tintuc->TieuDe}}</h1>
                <p><span class="glyphicon glyphicon-time"></span> Posted on: {{$tintuc->created_at}}</p>
                <hr>
                <p class="lead">
                	
                	{!! $tintuc->NoiDung !!}
                </p>

                <hr>
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
                            <textarea class="form-control" name="NoiDung" rows="3" placeholder="Nhập bình luận vào đây..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </form>
                </div>

                <hr>
                @endif

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

           
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">
                    	@foreach($tinlienquan as $tintuc)
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="tintuc/{{$tintuc->id}}/{{$tintuc->TieuDeKhongDau}}.html">
                                    <img class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="#"><b>{{$tintuc->TieuDe}}</b></a>
                            </div>
                            
                            <div class="break"></div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">
                    	@foreach($tinnoibat as $tt)    
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">
                                    <img class="img-responsive" src="upload/tintuc/{{$tt->Hinh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html"><b>{{$tt->TieuDe}}</b></a>
                            </div>
                            
                            <div class="break"></div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
            </div>

        </div>
    </div>
 @endsection
