@extends('admin.layout.index')
@section('content')
{{-- Style --}}
	<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
	<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Bình luận tin tức
                    <small>{{$tintuc->TieuDe}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
             @if(session('thongbao'))
                            <div class="alert alert-success">
                                 {{session('thongbao')}}
                            </div>
                           
                    @endif
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th style="text-align: center;">ID</th>
                        <th style="text-align: center;">Người dùng</th>
                        <th style="text-align: center;">Nội dung</th>
                        <th style="text-align: center;">Ngày đăng</th>
                        
                        <th style="text-align: center;">Xóa</th>
                       
                         
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tintuc->comment as $cm)
                    <tr class="odd gradeX" align="center">
                        <td>{{$cm->id}}</td>
                        <td>
                            {{$cm->user->name}}
                        </td>
            
                        <td>{{$cm->NoiDung}}</td>
                        <td>{{$cm->created_at}}</td>
                        
                        <td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="admin/comment/xoa/{{$cm->id}}/{{$tintuc->id}}"> Xóa</a></td>
                        
                    </tr>
                    @endforeach
                   
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

