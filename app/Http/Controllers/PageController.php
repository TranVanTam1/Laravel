<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\Slide;
use App\Models\BillDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class PageController extends Controller
{
    //
    public function index()
    {
        
        $new_products = Product::where('new',1)->get();
        $products = Product::where('new',0)->paginate(12)->onEachSide(5);;
        $slides =  Slide::all();
        return view('page.index', compact('new_products','slides','products'));

    }
    public function show($id)
    {
        $product= Product::find($id);
        return view('page.product', compact('product'));
    }
    //thêm 1 sản phẩm có id cụ thể vào model cart rồi lưu dữ liệu của model cart vào 1 session có tên cart (session được truy cập bằng thực thể Request)
   public function addToCart(Request $request,$id)
   {
        $product=Product::find($id);
        $oldCart=Session('cart')?Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->add($product,$id);
        $request->session()->put('cart',$cart);
        return redirect()->back();
    }
    public function delCartItem($id){
        $oldCart=Session::has('cart')?Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }else Session::forget('cart');
        return redirect()->back();
    }
    public function getCheckout(){
        return view('page.checkout');
    }

    public function postCheckout(Request $request){
    
        $cart=Session::get('cart');
        $customer=new Customer();
        $customer->name=$request->input('name');
        $customer->gender=$request->input('gender');
        $customer->email=$request->input('email');
        $customer->address=$request->input('address');
        $customer->phone_number=$request->input('phone_number');
        $customer->note=$request->input('notes');
        $customer->save();

        $bill=new Bill();
        $bill->id_customer=$customer->id;
        $bill->date_order=date('Y-m-d');
        $bill->total=$cart->totalPrice;
        $bill->payment=$request->input('payment_method');
        $bill->note=$request->input('notes');
        $bill->save();

        foreach($cart->items as $key=>$value)
        {
            $bill_detail=new BillDetail();
            $bill_detail->id_bill=$bill->id;
            $bill_detail->id_product=$key;
            $bill_detail->quantity=$value['qty'];
            $bill_detail->unit_price=$value['price']/$value['qty'];
            $bill_detail->save();
        }
        Session::forget('cart');
        return redirect()->back()->with('success','Đặt hàng thành công');

    }
    public function getProductsByType($product_type) {
        // Retrieve products based on $product_type
        $new_products = Product::where('id_type', $product_type)->where('new', 1)->get();
        $products = Product::where('id_type', $product_type)->where('new', 0)->paginate(9)->onEachSide(5);
        
        // Pass $products to your view and render it
        return view('page.product_type', compact('new_products','products'));
    }
    
    public function getSignin(){
       
        return view('page.sign_up');
    }

    public function postSignin(Request $req){
        $this->validate($req,
        ['email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|max:20',
            'fullname'=>'required',
            'repassword'=>'required|same:password'
        ],
        ['email.required'=>'Vui lòng nhập email',
        'email.email'=>'Không đúng định dạng email',
        'email.unique'=>'Email đã có người sử  dụng',
        'password.required'=>'Vui lòng nhập mật khẩu',
        'repassword.same'=>'Mật khẩu không giống nhau',
        'password.min'=>'Mật khẩu ít nhất 6 ký tự'
        ]);

        $user=new User();
        $user->full_name=$req->fullname;
        $user->email=$req->email;
        $user->password=Hash::make($req->password);
        $user->phone=$req->phone;
        $user->address=$req->address;
        $user->level=3;  //level=1: admin; level=2:kỹ thuật; level=3: khách hàng
        $user->save();
        return redirect()->back()->with('success','Tạo tài khoản thành công');
    }
    public function getLogin(){
        return view('page.login');
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
        $credentials=['email'=>$req->email,'password'=>$req->password];
        if(Auth::attempt($credentials)){//The attempt method will return true if authentication was successful. Otherwise, false will be returned.
            return redirect('/')->with(['flag'=>'alert','message'=>'Đăng nhập thành công']);
        }
        else{
            return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập không thành công']);
        }
    }
    public function getLogout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }
    public function getContact(){
        return view('page.contacts');
    }
    public function postContact(Request $request){
        $email = $request->email;
    
        // Kiểm tra có user có email như vậy không
        $user = User::where('email', $email)->first();
    
        if($user !== null){
            // Lưu dữ liệu vào CSDL
            $contact = new Contact();
            $contact->name = $request->input('name');
            $contact->email = $request->input('email');
            $contact->subject = $request->input('subject');
            $contact->message = $request->input('message');
            $contact->status = "Not viewed";
            $contact->created_at = now();
            $contact->updated_at = now();
            
            $contact->save();
            return redirect()->back()->with('success', 'Gửi thành công');
        } else {
            return redirect()->back()->with('message', 'Email của bạn không đúng');
        }
    }
    
    public function getInputEmail(){
        return view('emails.input-email');
    }
    //hàm xử lý gửi email
    public function postInputEmail(Request $req)
{
    $email = $req->txtEmail;

    // Validate địa chỉ email
    $validatedData = $req->validate([
        'txtEmail' => 'required|email',
    ]);

    // Kiểm tra xem có người dùng nào có email như vậy không
    $user = User::where('email', $email)->first();

    if ($user) {
        // Tạo mật khẩu mới
        $newPassword = Str::random(8); // Mật khẩu ngẫu nhiên có 8 ký tự

        // Cập nhật mật khẩu mới cho người dùng
        $user->password = bcrypt($newPassword);
        $user->save();

        // Gửi email chứa mật khẩu mới đến địa chỉ email của người dùng
        $sentData = [
            'title' => 'Mật khẩu mới của bạn là:',
            'body' => $newPassword
        ];

        Mail::to($email)->send(new \App\Mail\SendMail($sentData));

        // Thông báo thành công
        Session::flash('success', 'Mật khẩu mới đã được gửi đến địa chỉ email của bạn.');

        // Redirect về trang đăng nhập
        return redirect()->route('getlogin');
    } else {
        // Thông báo email không tồn tại
        return redirect()->route('emails.getInputEmail')->with('message', 'Địa chỉ email không tồn tại.');
    }

}
public function getOrderManagement(){
    return view('page.account.order_management');
}
public function getPersonalInformation(){
    return view('page.account.personal_information');
}

}
