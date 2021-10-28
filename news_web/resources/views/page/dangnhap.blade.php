<!DOCTYPE html>
<html>

@extends('layout.index')
@section('content')
<style>
	.headFont {
		font-weight: bold;
		text-align: center;
		font-size: 16px;
		color: white !important;
		background-color: darkslategrey !important;
	}

	.buttonFont {
		color: white;
		background-color:darkslategrey;
		font-weight: bold;
	}
</style>
<!-- Page Content -->
<div class="container">


	<div class="row carousel-holder">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading headFont">Đăng nhập</div>
				<div class="panel-body">
					@if(count($errors)>0)
					<div class="alert alert-danger">
						@foreach($errors->all() as $err)
						{{$err}}<br>
						@endforeach
					</div>
					@endif

					@if(session('thongbao'))
					<div class="alert alert-danger">
						{{session('thongbao')}}
					</div>
					@endif
					<form action="dangnhap" method="POST">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div>
							<label>Email</label>
							<input type="email" class="form-control" placeholder="Email" name="email">
						</div>
						<br>
						<div>
							<label>Mật khẩu</label>
							<input type="password" class="form-control" name="password">
						</div>
						<br>
						<div align="center">
							<button type="submit" class="btn btn-default buttonFont">Đăng nhập
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-4"></div>
	</div>
	<!-- end slide -->
</div>
<!-- end Page Content -->
@endsection

</html>