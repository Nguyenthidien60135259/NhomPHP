<?php

namespace App\Http\Controllers;
use App\Models\TheLoai;
use App\Models\LoaiTin;
use App\Models\TinTuc;
use Illuminate\Http\Request;

class LoaiTinController extends Controller
{
    //
    public function getDanhSach(){
        $loaitin = LoaiTin::all();
        return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }

    public function getThem(){
        $theloai = TheLoai::all();
        return view('admin.loaitin.them',['theloai'=>$theloai]);
    }

    public function postThem(Request $req){
        $this->validate($req,[
            'Ten'=>'required|unique:LoaiTin,Ten|min:1|max:100',
            'TheLoai'=>'required'
        ],
        [
            'Ten.required'=>'Bạn chưa nhập tên loại tin',
            'Ten.unique'=>'Tên loại tin đã tồn tại',
            'Ten.min'=>'Tên loại tin phải có độ dài từ 1 đến 100 kí tự',
            'Ten.max'=>'Tên loại tin phải có độ dài từ 1 đến 100 kí tự',
            'TheLoai.required'=>'Bạn chưa chọn thể loại'
        ]);
        $loaitin = new LoaiTin;
        $loaitin->Ten = $req->Ten;
        $loaitin->TenKhongDau = changeTitle($req->Ten);
        $loaitin->idTheLoai = $req->TheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/them')->with('thongbao','Thêm thành công');
    }

    public function getSua($id){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::find($id);
        return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }

    public function postSua(Request $req, $id){
         $loaitin = LoaiTin::find($id);
        $this->validate($req,[
            'Ten'=>'required|unique:LoaiTin,Ten|min:1|max:100',
            'TheLoai'=>'required'
        ],
        [
            'Ten.required'=>'Bạn chưa nhập tên loại tin',
            'Ten.unique'=>'Tên loại tin đã tồn tại',
            'Ten.min'=>'Tên loại tin phải có độ dài từ 1 đến 100 kí tự',
            'Ten.max'=>'Tên loại tin phải có độ dài từ 1 đến 100 kí tự',
            'TheLoai.required'=>'Bạn chưa chọn thể loại'
        ]);
       
        $loaitin->Ten = $req->Ten;
        $loaitin->TenKhongDau = changeTitle($req->Ten);
        $loaitin->idTheLoai = $req->TheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/sua/'.$loaitin->id)->with('thongbao',"Sửa thành công");
    }

    public function getXoa($id){
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();

        return redirect('admin/loaitin/danhsach')->with('thongbao','Xóa thành công');
    }
}
