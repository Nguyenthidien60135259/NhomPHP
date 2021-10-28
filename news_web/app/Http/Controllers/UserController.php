<?php

namespace App\Http\Controllers;

// Third library
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Own
use App\Http\Requests\UserStoreRequest;
use App\Models\User;

class UserController extends Controller
{
    
    public function getDanhSach(){
        $user = User::all();
        return view('admin.user.danhsach', ['user' => $user]);
    }

  
    public function getThem()
    {
        return view('admin.user.them');
    }

    public function postThem(UserStoreRequest $request) 
    {
        
       
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Mã hóa mật khẩu
        $user->quyen = $request->quyen;

        $user->save();
         return redirect('admin/user/them')->with('thongbao', 'Thêm người dùng thành công');
    }

    
    public function getSua($id)
    {
        $user = User::find($id);
        return view('admin.user.sua',['user'=>$user]);

    }
    public function postSua(Request $request, $id)
    {
        $this->validate($request,[
            'name'=> 'required|min:6',
            
        ],
        [
            'name.required'=>'Bạn chưa nhập tên người dùng',
            'name.min'=>'Tên người dùng phải từ 3 kí tự',
            
        ]);
         $user = User::find($id);
        $user->name = $request->name;
        $user->quyen = $request->quyen;

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
        return redirect('admin/user/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    ///////////////////
    // Xóa
    ///////////////////
    public function getXoa($id) 
    {
        $user = User::find($id);
        $user->delete();
        return redirect('admin/user/danhsach')->with('thongbao','Xóa tài khoản thành công');
    }

    public function getDangNhapAdmin() 
    {
        return view('admin.login');
    }
    public function postDangNhapAdmin(Request $request) 
    {
        $this->validate($request, [
            'email'=>'required',
            'password'=>'required|min:6|max:32'
        ], 
        [
            'email.required'=>'Bạn chưa nhập email',
            'password.required'=>'Bạn chưa nhập mật khẩu',
            'password.min'=>'Mật khẩu từ 6 kí tự trở lên',
            'password.max'=>'Mật khẩu khong được quá 32 kí tự'
        ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'quyen' => 1 ])) 
        {
            return redirect('admin/theloai/danhsach');
        } else {
            return redirect('admin/dangnhap')->with('thongbao', 'Đăng nhập thất bại');
        }
        
    }
    public function getDangXuat() 
    {
        Auth::logout();
        return redirect('admin/dangnhap');
    }
}
