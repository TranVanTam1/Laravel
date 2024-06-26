<?php

namespace App\Http\Controllers;
use App\Models\Type;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
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
        return view('admin.user.list-user', compact('users'));

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
        return view('admin.user.create-user');
    }
    public function postUserAdd(Request $request)
    {
        // Validate the form data
        $validation = Validator::make($request->all(),
        [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|max:255',
            'phone' => 'required|string|max:15|unique:users,phone',
            'address' => 'required|string|max:255',
            'level' => 'required|in:1,2,3',
        ]);
        if ($validation->fails()){
            return redirect()->route('admin.getUserAdd')->withErrors($validation)->withInput();
        }
        // Create a new user instance
        $user = new User();
        $user->full_name = $request->input('full_name');
        $user->email = $request->input('email');
        $user->password=Hash::make($request->password);
       
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->level = $request->input('level');

      
        // Save the user to the database
        $user->save();

        // Redirect back with a success message
        return redirect()->route('admin.getUserList')->with('success', 'User added successfully.');
    }
      /**
     * Show the form for editing the specified resource.
     */
    public function getUserEdit($id)
    {
        $user = User::findOrFail($id);
      
        // Trả về view edit
        return view('admin.user.edit-user', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function postUserEdit(Request $request, $id)
    {
       
        $validation = Validator::make($request->all(), [
            "full_name" => "required",
            "email" => "required",
            "password" => "required",
            "phone" => "required",
            "address" => "required",
            "level" => "required",
        ], [
            "full_name.required" => "Vui lòng nhập họ và tên.",
            "email.required" => "Vui lòng nhập địa chỉ email.",
            "password.required" => "Vui lòng nhập mật khẩu.",
            "phone.required" => "Vui lòng nhập số điện thoại.",
            "address.required" => "Vui lòng nhập địa chỉ.",
            "level.required" => "Vui lòng chọn cấp độ người dùng.",
        ]);
         
        if ($validation->fails()){
            return redirect('admin.getUserEdit')->withErrors($validation)->withInput();
        }
      // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Nếu email đã tồn tại, bạn có thể cập nhật thông tin của người dùng
            $user->full_name = $request->full_name;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->level = $request->level;

            $user->save();
        }
        return redirect()->route('admin.getUserList')->with('success', 'Thông tin người dùng đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function getUserDelete($id)
    {
        //
        // Tìm và xóa xe từ cơ sở dữ liệu
    $user = User::find($id);

    // Kiểm tra xem xe có tồn tại không
    if(!$user) {
        return redirect()->route('admin.getCateList')->with('error', 'Không tìm thấy người dùng .');
    }
 
    $user->delete();

    // Chuyển hướng 
    return redirect()->route('admin.getUserList')->with('success', 'Người dùng đã được xóa thành công.');

    }

    
}
