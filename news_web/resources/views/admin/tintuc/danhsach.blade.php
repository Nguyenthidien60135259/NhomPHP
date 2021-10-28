
  
@extends('admin.layout.index')
@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin tức
                    <small>Danh sách</small>
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
                        <th style="text-align: center;">Tiêu đề</th>
                        <th style="text-align: center;">Tóm tắt</th>
                        <th style="text-align: center;">Thể loại</th>
                        <th style="text-align: center;">Nổi bật</th>
                        <th style="text-align: center;">Lượt xem</th>
                        <th style="text-align: center;">Loại tin</th>
                        <th style="text-align: center;">Xóa</th>
                        <th style="text-align: center;">Sửa</th>
                         <th style="text-align: center;">Bình luận</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tintuc as $item)
                    <tr class="odd gradeX" align="center">
                        <td>{{$item->id}}</td>
                        <td>
                            {{$item->TieuDe}}<br>
                            <img width="100px" height="100px" src="upload/tintuc/{{$item->Hinh}}" alt="{{$item->TieuDe}}">
                        </td>
                        
                        <td>{!! $item->TomTat !!}</td>
                        <td>{{$item->loaitin->theloai->Ten}}</td>
                        <td> 
                            @if ($item->NoiBat == 0)
                            {{'Không'}}
                            @else   
                            {{'Có'}}
                            @endif
                        </td>

                        <td>{{$item->SoLuotXem}}</td>
                        <td>{{$item->loaitin->Ten}}</td>
                        <td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="admin/tintuc/xoa/{{$item->id}}"> Xóa</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/sua/{{$item->id}}">Sửa</a></td>
                        <td class="center"><img width="20px" height="20px" src="upload/tintuc/bl.jpg"> <a href="admin/tintuc/binhluan/{{$item->id}}">Xem</a></td>
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




