<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\TheLoai;
use App\Models\LoaiTin;
use App\Models\TinTuc;
use App\Models\Comment;

class TinTucController extends Controller
{
    // Lấy ra danh sách 
    public function getDanhSach()
    {
        $tintuc = TinTuc::orderBy('id', 'DESC')->get();
        return view('admin.tintuc.danhsach', ['tintuc' => $tintuc]);
    }

    // Thêm
    public function getThem()
    {
        $theloai = TheLoai::All();
        $loaitin = LoaiTin::All();
        return view('admin.tintuc.them', ['theloai' => $theloai, 'loaitin' => $loaitin]);

    }

    public function postThem(Request $request) {
        $this->validate($request, 
        [
            'LoaiTin' => 'required',
            // Yêu cầu phải có, min = 3, không trùng trong bảng TinTuc->cột tiêu để
            'TieuDe' => 'required|min:3|unique:TinTuc,TieuDe', 
            'TomTat' => 'required',
            'NoiDung' => 'required',
            'NoiBat' => 'required',
        ],
        [
            'LoaiTin.required' => 'Bạn chưa chọn loại tin',
            'TieuDe.required' => 'Bạn chưa nhập tiêu đề',
            'TieuDe.min' => 'Độ dài tiêu đề >= 3 kí tự',
            'TieuDe.unique' => 'Tiêu đề này bị trùng. Vui lòng nhập tiêu đề khác',
            'TomTat.required' => 'Yêu cầu nhập tóm tắt',
            'NoiDung.required' => 'Yêu cầu nhập nội dung',
            
        
        ]);
        $tintuc = new TinTuc;
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->TomTat = $request->TomTat;
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->SoLuotXem = 0;
        if ($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg'&&$duoi != 'png'&&$duoi != 'jpeg')
            {
                 return redirect('admin/tintuc/them')->with('loi', 'Bạn chỉ được chọn file có đuôi là jpg, png, jpeg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists("upload/tintuc/".$Hinh))
            {
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move("upload/tintuc",$Hinh);
            $tintuc->Hinh = $Hinh;
        }else{
            $tintuc->Hinh="";
        }
        $tintuc->save();
        return redirect('admin/tintuc/them')->with('thongbao', 'Thêm tin tức thành công');
    }

    // Sửa
    public function getSua($id)
    {
        $tintuc = TinTuc::Find($id);
        $theloai = TheLoai::All();
        $loaitin = LoaiTin::All();
        return view('admin.tintuc.sua', ['tintuc' => $tintuc, 'theloai' => $theloai, 'loaitin' => $loaitin]);

    }
    public function postSua(Request $request, $id)
    {
        $tintuc = TinTuc::Find($id);
        
        $this->validate($request, 
        [
            'LoaiTin' => 'required',
            // Yêu cầu phải có, min = 3, không trùng trong bảng TinTuc->cột tiêu để
            'TieuDe' => 'required|min:3|unique:TinTuc,TieuDe', 
            'TomTat' => 'required',
            'NoiDung' => 'required',
            'NoiBat' => 'required',
        ],
        [
            'LoaiTin.required' => 'Bạn chưa chọn loại tin',
            'TieuDe.required' => 'Bạn chưa nhập tiêu đề',
            'TieuDe.min' => 'Độ dài tiêu đề >= 3 kí tự',
            'TieuDe.unique' => 'Tiêu đề này bị trùng. Vui lòng nhập tiêu đề khác',
            'TomTat.required' => 'Yêu cầu nhập tóm tắt',
            'NoiDung.required' => 'Yêu cầu nhập nội dung',
            
        
        ]);
       
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->TomTat = $request->TomTat;
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->NoiDung = $request->NoiDung;
        
        if ($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg'&&$duoi != 'png'&&$duoi != 'jpeg')
            {
                 return redirect('admin/tintuc/them')->with('loi', 'Bạn chỉ được chọn file có đuôi là jpg, png, jpeg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists("upload/tintuc/".$Hinh))
            {
                $Hinh = Str::random(4)."_".$name;
            }

            $file->move("upload/tintuc",$Hinh);
             
            $tintuc->Hinh = $Hinh;
        }
        $tintuc->save();
        return redirect('admin/tintuc/sua/'.$id)->with('thongbao', 'Sửa thành công');

    }

    // Xóa
    public function getXoa($id) {
        $tintuc = TinTuc::find($id);
        $tintuc->delete();

        return redirect('admin/tintuc/danhsach')->with('thongbao', 'Xóa thành công');
    }
    public function getBinhluan($id)
    {
         $tintuc = TinTuc::Find($id);
        $theloai = TheLoai::All();
        $loaitin = LoaiTin::All();
        return view('admin.tintuc.binhluan', ['tintuc' => $tintuc, 'theloai' => $theloai, 'loaitin' => $loaitin]);
    }
}
