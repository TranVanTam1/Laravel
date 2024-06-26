<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\Favorite;
use App\Models\Type;
use App\Mail\OrderPlaced;
use App\Models\Slide;
use App\Models\BillDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Coupon;
use Carbon\Carbon;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
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
    public function addToCart(Request $request,$id){
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
    public function getCheckout($total){

        return view('page.checkout',compact('total'));
    }

    public function postCheckout(Request $request)
{
    $cart = Session::get('cart');
    
    // Lấy thông tin người dùng đang đăng nhập
    $user = Auth::user();
// Kiểm tra sự tồn tại của khách hàng dựa trên email
$existingCustomer = Customer::where('email', $request->input('email'))->first();

if ($existingCustomer) {
    // Khách hàng đã tồn tại, không cần lưu thông tin mới
    $customer = $existingCustomer;
} else {
    // Khách hàng chưa tồn tại, tạo mới đối tượng Customer và lưu thông tin
    $customer = new Customer();
    $customer->name = $request->input('name');
    $customer->gender = $request->input('gender');
    $customer->email = $request->input('email');
    $customer->address = $request->input('address');
    $customer->phone_number = $request->input('phone_number');
    $customer->note = $request->input('notes');
    $customer->save();
}

// Tạo một đối tượng Bill và lưu thông tin đơn hàng
$bill = new Bill();
$bill->id_customer = $customer->id; // Sử dụng id của khách hàng (có thể là $existingCustomer->id hoặc $customer->id tùy vào trường hợp)
$bill->date_order = date('Y-m-d');
$bill->total = $cart->totalPrice;
$bill->payment = $request->input('payment_method');
$bill->note = $request->input('notes');
$bill->status = "New";
$bill->save();
    // Lưu chi tiết đơn hàng vào bảng BillDetail
    foreach ($cart->items as $key => $value) {
        $bill_detail = new BillDetail();
        $bill_detail->id_bill = $bill->id;
        $bill_detail->id_product = $key;
        $bill_detail->quantity = $value['qty'];
        $bill_detail->unit_price = $value['price'] / $value['qty'];
        $bill_detail->save();
    }

    // Xóa giỏ hàng sau khi đã đặt hàng thành công
    Session::forget('cart');
    // Gửi email thông báo cho người dùng
Mail::to($customer->email)->send(new OrderPlaced($bill));
    // Chuyển hướng về lại trang trước đó và gửi thông báo thành công
    return redirect()->back()->with('success', 'Đặt hàng thành công');
}

public function updateCart(Request $request)
{
    // Xử lý cập nhật số lượng sản phẩm trong giỏ hàng

    // Ví dụ: Lấy thông tin sản phẩm từ request
    $productId = $request->input('product_id');
    $newQuantity = $request->input('quantity');

    // Cập nhật số lượng trong giỏ hàng (ví dụ)
    // Lưu ý: Đây là logic giả, bạn cần thay thế bằng logic xử lý thực tế của bạn
    $product = Product::find($productId);
    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }

    // Cập nhật số lượng trong session hoặc database
    // Ví dụ: Sử dụng session để lưu giỏ hàng
    $cart = session()->get('cart');

    // Tìm sản phẩm trong giỏ hàng
    foreach ($cart as $key => $item) {
        if ($item['item']['id'] == $productId) {
            // Cập nhật số lượng
            $cart[$key]['qty'] = $newQuantity;
        }
    }

    session()->put('cart', $cart);

    // Tính lại tổng tiền
    $totalAmount = 0;
    foreach ($cart as $item) {
        $subtotal = $item['item']['promotion_price'] == 0 ? $item['item']['unit_price'] * $item['qty'] : $item['item']['promotion_price'] * $item['qty'];
        $totalAmount += $subtotal;
    }

    // Kiểm tra điều kiện để đặt phí vận chuyển
    $shippingFee = $totalAmount > 500000 ? 0 : 30000;

    // Chuẩn bị dữ liệu trả về dưới dạng JSON
    $response = [
        'subtotal' => $totalAmount,
        'shippingFee' => $shippingFee,
        // Các thông tin khác cần thiết khác có thể điền vào đây
    ];

    return response()->json($response);
}
public function updateQuantity(Request $request, $productId)
{
    $cart = session()->get('cart'); // Fetch cart from session (adjust as per your implementation)

    $productId = $request->product_id;
    $newQuantity = $request->quantity;

    $productId = $request->product_id;
        $newQuantity = $request->quantity;

        $oldCart = session()->has('cart') ? session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->updateQuantity($productId, $newQuantity);

        session()->put('cart', $cart);

      

    // Redirect back to cart or do whatever is needed
    return redirect()->back();
}
public function shopping_cart()
{
    // Retrieve cart from session
    $oldCart = session()->has('cart') ? session()->get('cart') : null;
    $cart = new Cart($oldCart);

    // Calculate subtotal
    $subtotal = $cart->subtotal();
    $total = $cart->total(); // Lấy giá trị subtotal từ session hoặc nơi lưu trữ
    
    // Pass data to the view
    return view('page.shopping_cart', [
        'cart' => $cart,
        'subtotal' => $subtotal,
        'total' => $total,
    ]);
}
public function apply(Request $request)
{
    $couponCode = $request->input('coupon_code');
    $oldCart = session()->has('cart') ? session()->get('cart') : null;
    $cart = new Cart($oldCart);
    // Tìm mã giảm giá trong CSDL
    $coupon = Coupon::where('code', $couponCode)->first();
    $discountTotal=0;
    $discountPercent=0;
    if (!$coupon) {
        // Xử lý khi không tìm thấy mã giảm giá
        return redirect()->back()->with('message', 'Invalid coupon code. Please try again.');
    }
    
    // Lấy giá trị discount_percent từ mã giảm giá
    $discountPercent = $coupon->discount_percent;
    
    // Lấy $subtotal từ session hoặc bất kỳ nơi nào lưu trữ giá trị subtotal
    $subtotal = $cart->subtotal(); // Lấy giá trị subtotal từ session hoặc nơi lưu trữ
    $total = $cart->total(); // Lấy giá trị subtotal từ session hoặc nơi lưu trữ
    
    // Tính toán giá trị giảm giá
    $discountTotal = ($subtotal * $discountPercent)/100 ;
    $total = $subtotal-$discountTotal;
    return view('page.shopping_cart', [
        'cart' => $cart,
        'subtotal' => $subtotal,
        'discountTotal' => $discountTotal,
        'total' => $total,
    ])->with('success', 'Coupon applied successfully.');
}

public function getTypeByCartegory($cartegory)
{
    // Lấy các loại (Type) có cùng cartegory_id từ bảng type_products
    $types = Type::where('cartegory_id', $cartegory)->get();

    // Lấy các sản phẩm mới có cùng cartegory_id từ bảng products
    $new_products = Product::whereHas('type', function ($query) use ($cartegory) {
        $query->where('cartegory_id', $cartegory);
    })->where('new', 1)->get();

    // Lấy các sản phẩm không phải mới có cùng cartegory_id từ bảng products và phân trang
    $products = Product::whereHas('type', function ($query) use ($cartegory) {
        $query->where('cartegory_id', $cartegory);
    })->where('new', 0)->paginate(9);

    // Trả về view 'page.product_type' với dữ liệu sản phẩm và loại
    return view('page.product_type', compact('new_products', 'products', 'types'));
}

public function showProductsByType($type)
{
    // Retrieve new products based on $type
    $new_products = Product::where('id_type', $type)->where('new', 1)->get();
    
    // Retrieve other products (not new) based on $type and paginate
    $products = Product::where('id_type', $type)->where('new', 0)->paginate(9)->onEachSide(5);
    
    // Retrieve types based on $type
    $types = Type::where('cartegory_id', function ($query) use ($type) {
        $query->select('cartegory_id')->from('type_products')->where('id', $type);
    })->get();

    return view('page.product_type', compact('new_products', 'products', 'types'));
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
    public function getLoginUser(){
        return view('page.login');
    }

    public function postLoginUser(Request $req){
        $this->validate($req,
            [
                'email' => 'required|email',
                'password' => 'required|min:6|max:20'
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Không đúng định dạng email',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu ít nhất 6 ký tự'
            ]
        );
    
        $credentials = [
            'email' => $req->email,
            'password' => $req->password,
        ];
    
        // Thử đăng nhập người dùng
        if (Auth::attempt($credentials)) {
            // Lấy thông tin người dùng đã đăng nhập
            $user = Auth::user();
            
            // Kiểm tra nếu người dùng là admin
            if ($user->isAdmin) {
                // Đăng xuất người dùng admin để không tự động đăng nhập với người dùng bình thường
                Auth::logout();
                
                // Điều hướng về trang trước đó với thông báo không được phép đăng nhập
                return redirect()->back()->with(['flag' => 'danger', 'message' => 'Bạn không có quyền truy cập']);
            }
            
            // Điều hướng về trang chủ và thông báo đăng nhập thành công cho người dùng bình thường
            return redirect('/')->with(['flag' => 'alert', 'success' => 'Đăng nhập thành công']);
        } else {
            // Điều hướng về trang trước đó với thông báo đăng nhập không thành công
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Đăng nhập không thành công']);
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
      // Lấy thông tin của người dùng hiện tại đã đăng nhập
      $user = auth()->user(); // Lấy thông tin người dùng đã đăng nhập

      // Trả về view và truyền dữ liệu của người dùng
      return view('page.account.personal_information', compact('user'));
  }


      // Method to update personal information including password
public function postUpdatePersonalInformation(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'account_last_name' => 'required|string',
            'account_email' => 'required|email',
            'account_phone_number' => 'required|string',
            'address' => 'required|string',
        ]);

        try {
            // Get authenticated user
            $user = auth()->user();

            // Update user information
            $user->full_name = $request->input('account_last_name');
            $user->email = $request->input('account_email');
            $user->phone = $request->input('account_phone_number');
            $user->address = $request->input('address');
         

            // Save user changes
            $user->save();

            // Redirect back or to a success page
            return redirect()->back()->with('success', 'Thông tin cá nhân đã được cập nhật thành công.');
        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            return redirect()->back()->with('message', 'Đã xảy ra lỗi khi cập nhật thông tin cá nhân.');
        }
    }
    public function getChangePassword(){
        return view('page.account.change_password');
    }
    public function postChangePassword(Request $request)
    {
        // Validate the input
        $request->validate([
            'password_current' => 'required',
            'password_1' => 'required|string|min:6|different:password_current',
            'password_2' => 'required|same:password_1',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Check if the current password matches the authenticated user's password
        if (!Hash::check($request->password_current, $user->password)) {
            return redirect()->back()->with('message', 'Current password is incorrect.');
        }

        // Change the password
        $user->password = Hash::make($request->password_1);
        $user->save();

        // Redirect with success message
        return redirect()->back()->with('success', 'Password changed successfully.');
    }
    public function showOrders(Request $request, $status = null)
    {
        // Lấy thông tin người dùng đã đăng nhập
        $user = Auth::user();
        
        // Bắt đầu câu truy vấn đơn hàng của người dùng đã đăng nhập
        $ordersQuery = Bill::where('id_customer', $user->id);
        
        // Áp dụng điều kiện lọc theo trạng thái nếu được chỉ định
        if ($status) {
            $ordersQuery->where('status', $status);
        }
        
        // Phân trang với số lượng mỗi trang là 10
        $orders = $ordersQuery->paginate(10);
        
        // Đếm số lượng đơn hàng
        $dem = $orders->total(); // Lấy tổng số lượng đơn hàng
        
        // Trả về view 'order_management' với dữ liệu đơn hàng và số lượng đơn hàng
        return view('page.account.order_management', compact('orders', 'dem'));
    }

    public function showDetailOrder($id)
    {
        // Truy vấn các chi tiết hóa đơn có id_bill tương ứng với $id
        $billDetails = BillDetail::where('id_bill', $id)->get();
        
        // Trả về view 'admin.order.bill-detail' với dữ liệu $billDetails
        return view('page.account.order_detail', compact('billDetails'));
    }
public function addToFavorite($id)
{
    $user = Auth::user();
    $product = Product::findOrFail($id);

    // Kiểm tra xem sản phẩm đã được yêu thích chưa
    $existingFavorite = Favorite::where('id_customer', $user->id)
                                ->where('product_id', $id)
                                ->first();

    if (!$existingFavorite) {
      
        // Nếu chưa có, thêm vào danh sách yêu thích
        $favorite = new Favorite();
        $favorite->id_customer = $user->id;
        $favorite->product_id = $id;
        $favorite->save();
        
        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào danh sách yêu thích!');
    } else {
        // Nếu đã có, có thể xử lý thông báo cho người dùng
        return redirect()->back()->with('error', 'Sản phẩm đã có trong danh sách yêu thích của bạn!');
    }
}
public function getFavorites()
    {
        
        // Lấy danh sách các sản phẩm yêu thích của người dùng hiện tại
        $favorites = Favorite::where('id_customer', auth()->id())->with('product')->get();

        return view('page.favorites.favorite', compact('favorites'));
    }
    // Previous methods...

    public function removeFavorite($id)
    {
        $favorite = Favorite::findOrFail($id);
        
        // Check if the authenticated user is the owner of this favorite
        if ($favorite->id_customer != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $favorite->delete();

        return redirect()->route('getFavorites')->with('success', 'Đã bỏ sản phẩm yêu thích.');
    }
   
   
    public function cancel($id)
    {
        $order = Bill::findOrFail($id);

        // Check if the order status is eligible for cancellation (e.g., 'New')
        if ($order->status == 'New') {
            // Update order status to 'Cancelled'
            $order->status = 'Cancelled';
            $order->save();

            // Optionally, you may want to perform additional actions here, such as notifying the user via email, etc.

            return redirect()->back()->with('success', 'Đơn hàng đã được hủy thành công.');
        } else {
            return redirect()->back()->with('error', 'Không thể hủy đơn hàng này.');
        }

    }

    
    public function requestCancel($id)
    {
        $order = Bill::findOrFail($id);

        // Assuming you have a 'cancellation_requested' status or flag in your orders table
        $order->status = 'Request';

        $order->save();

        // Optionally, you may notify the admin about the cancellation request.
        // Example: send an email or notification to the admin.

        return redirect()->back()->with('success', 'Yêu cầu hủy đơn hàng đã được gửi.');
    }
    public function cancelRequest($id)
    {
        $order = Bill::findOrFail($id);

        // Update the cancellation_requested status or flag to false
        $order->status = 'New';
        $order->save();

        return redirect()->back()->with('success', 'Yêu cầu hủy đơn hàng đã được rút lại.');
    }
    public function search(Request $request)
    {
        $query = $request->input('q'); // Lấy từ khóa tìm kiếm từ query string
        $products = Product::where('name', 'like', '%' . $query . '%')->paginate(10); // Tìm kiếm sản phẩm theo tên
    
        return view('page.search_results', compact('products', 'query'));
    }


}