<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\TheLoai;
use App\Models\Slide;
use App\Models\LoaiTin;
use App\Models\TinTuc;
use App\Models\User;
class PageController extends Controller
{
    //hàm khởi tạo
    function __construct()
    {
        
        //lấy toàn bộ TheLoai,Slide
        $theloai = TheLoai::all();
        $slide = Slide::all();
        //response dữ liệu ra file trang chủ
        view()->share('theloai',$theloai);
        view()->share('slide',$slide);
        if(Auth::check())
        {
            view()->share('nguoidung',Auth::user());
        }    

    }
    
    //hàm này lấy về biến $theloai ở hàm khởi tạo
    public function trangchu()
    {
       
        return view('page.trangchu');
    }

    function lienhe()
    {
        
        return view('page.lienhe');
    }

    function gioithieu()
    {
        
        return view('page.gioithieu');
    }

    //hàm loại tin
    function loaitin($id)
    {
        //lấy loại tin theo id
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
        //response dữ liệu ra view loaitin
        return view('page.loaitin',['loaitin'=>$loaitin, 'tintuc'=>$tintuc]);
    }

    //hàm tin tức
    function tintuc($id)
    {
        //lấy tin tức có NoiBat
        $tintuc = TinTuc::find($id);
        $tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
        $tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
        return view('page.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
    }

    function getDangnhap()
    {
        return view('page.dangnhap');
    }

    function postDangnhap(Request $req)
    {
        
        $this->validate($req, [
            'email'=>'required',
            'password'=>'required|min:6|max:32'
        ], 
        [
            'email.required'=>'Bạn chưa nhập email',
            'password.required'=>'Bạn chưa nhập mật khẩu',
            'password.min'=>'Mật khẩu từ 6 kí tự trở lên',
            'password.max'=>'Mật khẩu không được quá 32 kí tự'
        ]);

        if(Auth::attempt(['email' => $req->email, 'password' => $req->password, 'quyen' => 0 ])) 
        {
            return redirect('trangchu');
        } else {
            return redirect('dangnhap')->with('thongbao', 'Đăng nhập không thành công: sai email hoặc mật khẩu');
        }
    }

    function getDangxuat()
    {
        Auth::logout();
        return redirect('trangchu');
    }

    function getNguoidung()
    {
        $user = Auth::user();
        return view('page.nguoidung',['nguoidung'=>$user]);
    }

    function postNguoidung(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required|min:6',
            
        ],
        [
            'name.required'=>'Bạn chưa nhập tên người dùng',
            'name.min'=>'Tên người dùng phải từ 3 kí tự',
            
        ]);
         $user = Auth::user();
        $user->name = $request->name;
       
        if($request->changePassword == "on")
        {
             $this->validate($request,[
            'password'=>'required|min:6|max:32',
            'passwordAgain'=>'required|same:password',
        ],
        [
            
            'password.required'=>'Bạn chưa nhập mật khẩu',
            'password.min'=>'Mật khẩu phải có ít nhất 6 kí tự',
            'password.max'=>'Mật khẩu không được quá 32 kí tự',
            'passwordAgain.required'=>'Hãy nhập lại mật khẩu',
            'passwordAgain.same'=>'Mật khẩu nhập lại không đúng',
        ]);
            $user->password = bcrypt($request->password);
        }    
        $user->save();
        return redirect('nguoidung')->with('thongbao','Sửa thành công');
    }

    function getDangky()
    {
        return view('page.dangky');
    }

    function postDangky(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required|min:6',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|max:32',
            'passwordAgain'=>'required|same:password'
        ],
        [
            'name.required'=>'Bạn chưa nhập tên người dùng',
            'name.min'=>'Tên người dùng phải từ 3 kí tự',
            'email.required'=>'Bạn chưa nhập email',
            'email.email'=>'Hãy nhập đúng định dạng email',
            'email.unique'=>'Email này đã tồn tại',
            'password.required'=>'Bạn chưa nhập mật khẩu',
            'password.min'=>'Mật khẩu phải có ít nhất 6 kí tự',
            'password.max'=>'Mật khẩu không được quá 32 kí tự',
            'passwordAgain.required'=>'Hãy nhập lại mật khẩu',
            'passwordAgain.same'=>'Mật khẩu nhập lại không đúng',
            
        ]);
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Mã hóa mật khẩu
        $user->quyen = 0;
        $user->save();
         return redirect('dangnhap')->with('thongbao', 'Đăng ký thành công');
    }

    
    //hàm tìm kiếm
    function timkiem(Request $request)
    {
        // request từ khóa 
        $tukhoa = $request->tukhoa;
        // tìm từ khóa trong TieuDe,TomTat,NoiDung
        $tintuc = TinTuc::where('TieuDe','like',"%$tukhoa%")->orWhere('TomTat','like',"%$tukhoa%")->orWhere('NoiDung','like',"%$tukhoa%")->take(30)->paginate(5);
        //response dữ liệu về view timkiem
        return view('page.timkiem',['tintuc'=>$tintuc, 'tukhoa'=>$tukhoa]);
    }

    
}
