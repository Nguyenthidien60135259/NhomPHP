<?php

namespace App\Http\Controllers;
use App\Models\TheLoai;
use App\Models\LoaiTin;
use App\Models\TinTuc;
use Illuminate\Http\Request;

class TheLoaiController extends Controller
{
    //
    public function getDanhSach(){
        $theloai = TheLoai::all();
        return view('admin.theloai.danhsach',['theloai'=>$theloai]);
    }

    public function getThem(){
        return view('admin.theloai.them');
    }

    public function postThem(Request $req){
        $this->validate($req,[
            'Ten'=>'required|min:3|max:100|unique:TheLoai,Ten'
            ],
            [
                'Ten.required'=>'Bạn chưa nhập tên thể loại',
                'Ten.min'=>'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
                'Ten.max'=>'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
                'Ten.unique'=>'Tên thể loại đã tồn tại',
            ]);
        $theloai = new TheLoai;
        $theloai->Ten = $req->Ten;
        $theloai->TenKhongDau = changeTitle($req->Ten);
        echo changeTitle($req->Ten);
        $theloai->save();
        return redirect('admin/theloai/them')->with('thongbao','Thêm thành công');
    }

    public function getSua($id){
        $theloai = TheLoai::find($id);
        return view('admin.theloai.sua',['theloai'=>$theloai]);
    }

    public function postSua(Request $req, $id){
        $theloai = TheLoai::find($id);
        $this->validate($req,
        [
            'Ten'=>'required|unique:TheLoai,Ten|min:3|max:100'
        ],
        [
            'Ten.required'=>'Bạn chưa nhập tên thể loại',
            'Ten.unique'=>'Tên thể loại đã tồn tại',
            'Ten.min'=>'Tên phải có độ dài 3 ký tự trở lên',

            'Ten.max'=>'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',

        ]);
        $theloai->Ten = $req->Ten;
        $theloai->TenKhongDau = changeTitle($req->Ten);
        $theloai->save();
        return redirect('admin/theloai/sua/'.$theloai->id)->with('thongbao',"Sửa thành công");
    }

    public function getXoa($id){
        $theloai = TheLoai::find($id);
        $theloai->delete();

        return redirect('admin/theloai/danhsach')->with('thongbao','Xóa thành công');
    }
}
