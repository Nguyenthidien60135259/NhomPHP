@extends('admin.layout.index')
 @section('content')
    <!-- Page Content -->
 <div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sửa
                    <small>tài khoản {{$user->name}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            {{-- Handle Show Message Success --}}
           @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{$error}} <br>
                    @endforeach
                </div>
                @endif

                {{-- Hiện thông báo thành công --}}
                @if(session('thongbao'))
                    <div class="alert alert-success">{{session('thongbao')}}</div>
                @endif

            {{-- Form Input Create new user --}}
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="admin/user/sua/{{$user->id}}" method="POST">
                    {{-- Token --}}
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    
                    {{-- User name --}}
                    <div class="form-group">
                        <label>Họ tên</label>
                        <input class="form-control" name="name" placeholder="Nhập tên người dùng" value="{{$user->name}}"/>
                        @if ($errors->has('name'))
                            <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <label>Địa chỉ email</label>
                        <input class="form-control" name="email" placeholder="Nhập địa chỉ email" value="{{$user->email}}" readonly="" />
                        @if ($errors->has('email'))
                            <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    {{-- Password and Re-password --}}
                    <div class="form-group">
                        <input type="checkbox" id="changePassword" name="changePassword">
                        <label>Đổi mật khẩu</label>
                        <input class="form-control password" type="password" name="password" placeholder="Nhập password" 
                            disabled="" 
                        />
                        @if ($errors->has('password'))
                            <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Nhập lại mật khẩu</label>
                        <input class="form-control password" type="password" name="re-password" placeholder="Nhập lại password" disabled=""/>
                        @if ($errors->has('re-password'))
                            <div class="alert alert-danger">{{ $errors->first('re-password') }}</div>
                        @endif
                    </div>

                    {{-- User role --}}
                    <div class="form-group">
                        <label>Quyền người dùng</label><br>
                        <label class="radio-inline">
                            <input name="quyen" value="0" 
                                @if($user->quyen == 0)
                                {{"checked"}}
                                @endif
                             type="radio"> Người dùng
                        </label>
                        <label class="radio-inline">
                            <input name="quyen" value="1" 
                            @if($user->quyen == 1)
                                {{"checked"}}
                                @endif
                             type="radio"> Admin
                        </label>
                    </div>

                    {{-- Submit --}}
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
            $("#changePassword").change(function(){
                if($(this).is(":checked")){
                    $(".password").removeAttr('disabled');
                }
                else{
                    $(".password").attr('disabled','');
                }
            });
        });

    </script>
@endsection