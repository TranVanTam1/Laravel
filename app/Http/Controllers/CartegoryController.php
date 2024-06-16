<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class CartegoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getCateList()
    {
        //
        $types= Type::orderBy('created_at', 'desc')->paginate(15)->onEachSide(5);
        return view('admin.cartegory.list-cartegory', compact('types'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function getCateAdd()
    {
        //
        return view('admin.cartegory.create-cartegory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function postCateAdd(Request $request)
    {
        //
        //
        $name="khong";
        $validation = Validator::make($request->all(),
        [
            "name" => "required",
            "description"  => "required",
            'image'=>'mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        if ($validation->fails()){
            return redirect('cartegory/create')->withErrors($validation)->withInput();
        }
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $name=time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('images'); //project\public\images, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/
        }
     
        $cartegory=new Type();
        $cartegory->name=$request->input('name');
        $cartegory->description=$request->input('description');
        $cartegory->image=$name;
        $cartegory->save();
        return redirect()->route('admin.getCateList')->with('success', 'Thông tin sản phẩm đã được cập nhật thành công.');
    }

  
    /**
     * Show the form for editing the specified resource.
     */
    public function getCateEdit($id)
    {
        $cartegory = Type::findOrFail($id);
      
        // Trả về view edit
        return view('admin.cartegory.edit-cartegory', compact('cartegory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function postCateEdit(Request $request, $id)
    {
        $name=" ";
        $validation = Validator::make($request->all(),
        [
            "name" =>"required",
            "description"  => "required",
            'image'=>'mimes:jpeg,jpg,png,gif|max:10000'
            
        ]);

        if ($validation->fails()){
            return redirect('admin.getCateEdit')->withErrors($validation)->withInput();
        }
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $name=time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('images/produsts'); //project\public\images, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/
        }
     
        $cartegory=Type::find($id);
        if($cartegory!=null){
            $cartegory->name=$request->input('name');
            $cartegory->description=$request->input('description');
            if($name==" "){
                $name=$cartegory->image;
            }
            $cartegory->image=$name;
            $cartegory->save();
        
        }
        return redirect()->route('admin.getCateList')->with('success', 'Thông tin sản phẩm đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function getCateDelete($id)
    {
        //
        // Tìm và xóa xe từ cơ sở dữ liệu
    $cartegory = Type::find($id);

    // Kiểm tra xem xe có tồn tại không
    if(!$cartegory) {
        return redirect()->route('admin.getCateList')->with('error', 'Không tìm thấy sản phẩm.');
    }
    // Lấy đường dẫn tới file ảnh
   
    // Kiểm tra xem file ảnh có tồn tại không
    $linkImage=public_path('images/products').$cartegory->image;
        if(File::exists($linkImage)){
            File::delete($linkImage);
        }
        
    // Xóa xe
    $cartegory->delete();

    // Chuyển hướng 
    return redirect()->route('admin.getCateList')->with('success', 'Sản phẩm đã được xóa thành công.');

    }
}
