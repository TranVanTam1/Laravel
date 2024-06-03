<?php

namespace App\Http\Controllers;
use App\Models\Type;
use App\Models\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function index()
    {
        // Lấy menu với số lượng liên hệ
        $menu = app('App\Http\Controllers\ContactController')->getMenuWithCounts();

        return view('admin.master', compact('menu'));
    }
    public function getUserList()
    {
        //
        $users= User::orderBy('created_at', 'desc')->paginate(15)->onEachSide(5);
        return view('admin.list-user', compact('users'));

    }
    //
    public function getLogin(){
        return view('admin.login');
    }

    public function postLogin(Request $req){
        $this->validate($req,
        [
            'email'=>'required|email',
            'password'=>'required|min:6|max:20'
        ],
        [
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Không đúng định dạng email',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu ít nhất 6 ký tự'
        ]
        );
        $credentials=array('email'=>$req->email,'password'=>$req->password);
        if(Auth::attempt($credentials)){
            return redirect('/admin/cartegory/danhsach')->with(['flag'=>'alert','message'=>'Đăng nhập thành công']);
        }
        else{
           
            return redirect()->back()->withInput()->withErrors(['email' => 'Email hoặc mật khẩu không đúng']); // Chuyển hướng về trang đăng nhập và hiển thị thông báo lỗi
        }
    }

    public function getLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.getLogin');
    }
    public function getUserAdd()
    {
        return view('admin.create-user');
    }
    public function postUserAdd(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|max:255',
            'phone' => 'required|string|max:15|unique:users,phone',
            'address' => 'required|string|max:255',
            'level' => 'required|in:1,2,3',
        ]);

        // Create a new user instance
        $user = new User();
        $user->full_name = $request->input('full_name');
        $user->email = $request->input('email');
         $user->password = $request->input('password');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->level = $request->input('level');

        // Save the user to the database
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'User added successfully.');
    }

}
