<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RoomValidationRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
  public function type()
    {
        return $this->belongsTo(Type::class, 'id_type');
    }
    public function getProductList(Request $request)
    {
        $input = $request->input('input');
        $query = Product::query();
        if ($input) {
            $products = Product::where('description', 'LIKE', "%$input%")
                ->orWhere('name', 'LIKE', "%$input%")
                ->orWhere('id', 'LIKE', "%$input%")
                ->orWhereHas('type', function($query) use ($input) {
                    $query->where('name', 'LIKE', "%$input%");
                })
                ->orderBy('created_at', 'desc')
                ->paginate(15);
            } else {
                $products = Product::orderBy('created_at', 'desc')->paginate(15)->onEachSide(5);
            }
      
        return view('admin.product.list-product', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function getProductAdd()
    {
        //
        $types = Type::all();
        return view('admin.product.create-product',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function postProductAdd(Request $request)
    {
        $name=" ";
        $validation = Validator::make($request->all(),
        [
            "name" =>"required",
            "description"  => "required",
            "unit_price" => "required",
            "promotion_price"  => "required",
            "id_type" =>"required",
            "new" =>"required",
            "image"=>"mimes:jpeg,jpg,png,gif|max:10000"
        ]);

        if ($validation->fails()){
            return redirect()->route('admin.getProductAdd')->withErrors($validation)->withInput();
        }
        // Không cần phải tạo Validator thủ công, Laravel đã thực hiện điều này cho bạn
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('/images/product');
            $file->move($destinationPath, $name);
        } else {
            // Nếu không có tệp được tải lên, có thể xử lý theo ý của bạn, ví dụ:
            $name = null; // hoặc một giá trị mặc định khác
        }
        
        // Lưu dữ liệu vào CSDL
        $product = new Product();
        $product->name =$request->input('name');
        $product->description = $request->input('description');
        $product->unit_price = $request->input('unit_price');
        $product->promotion_price = $request->input('promotion_price');
        $product->id_type = $request->input('id_type');
        $product->new = $request->input('new');
        $product->unit = $request->input('unit');
        $product->image = $name;
        $product->save();
    
        return redirect()->route('admin.getProductList')->with('success', 'Thêm sản phẩm thành công');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getProductEdit($id)
    {
        $product = Product::findOrFail($id);
        $types = Type::all();
        // Trả về view edit
        return view('admin.product.edit-product', compact('product','types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function postProductEdit(Request $request, $id)
    {
        $name=" ";
        $validation = Validator::make($request->all(),
        [
            "name" =>"required",
            "description"  => "required",
            "unit_price" => "required",
            "promotion_price"  => "required",
            "id_type" =>"required",
            "new" =>"required",
            'image'=>'mimes:jpeg,jpg,png,gif|max:10000'
            
        ]);

        if ($validation->fails()){
            return redirect('admin.getProductEdit')->withErrors($validation)->withInput();
        }
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $name=time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('/images/product'); //project\public\images, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/
        }
     
        $product=Product::find($id);
        if($product!=null){
            $product->name=$request->input('name');
            $product->description=$request->input('description');
            $product->unit_price=$request->input('unit_price');
            $product->promotion_price=$request->input('promotion_price');
            $product->new=$request->input('new');
            $product->unit=$request->input('unit');
            $product->id_type=$request->input('id_type');
            if($name==" "){
                $name=$product->image;
            }
            $product->image=$name;
            $product->save();
        
        }
        return redirect()->route('admin.getProductList')->with('success', 'Thông tin sản phẩm đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function getProductDelete($id)
    {
        //
        // Tìm và xóa xe từ cơ sở dữ liệu
    $product = Product::find($id);

    // Kiểm tra xem xe có tồn tại không
    if(!$product) {
        return redirect()->route('admin.getProductList')->with('error', 'Không tìm thấy Sản phẩm.');
    }
    // Lấy đường dẫn tới file ảnh
   
    // Kiểm tra xem file ảnh có tồn tại không
    $linkImage=public_path('images/product').$product->image;
        if(File::exists($linkImage)){
            File::delete($linkImage);
        }
        
    // Xóa xe
    $product->delete();

    // Chuyển hướng 
    return redirect()->route('admin.getProductList')->with('success', 'Sản phẩm đã được xóa thành công.');

    }
}
