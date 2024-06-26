<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cartegory;
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
        $cartegorys= Cartegory::orderBy('created_at', 'desc')->paginate(15)->onEachSide(5);
        return view('admin.cartegory.list-cartegory', compact('cartegorys'));

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
          
            
        ]);

        if ($validation->fails()){
            return redirect('cartegory/create')->withErrors($validation)->withInput();
        }
        
        $cartegory=new Cartegory();
        $cartegory->name=$request->input('name');
        $cartegory->description=$request->input('description');
        
        $cartegory->save();
        return redirect()->route('admin.getCateList')->with('success', 'Thông tin danh mucj đã được cập nhật thành công.');
    }

  
    /**
     * Show the form for editing the specified resource.
     */
    public function getCateEdit($id)
    {
        $cartegory = Cartegory::findOrFail($id);
      
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
        
            
        ]);

        if ($validation->fails()){
            return redirect('admin.getCateEdit')->withErrors($validation)->withInput();
        }
       
     
        $cartegory=Cartegory::find($id);
        if($cartegory!=null){
            $cartegory->name=$request->input('name');
            $cartegory->description=$request->input('description');
            
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
    $cartegory = Cartegory::find($id);

    // Kiểm tra xem xe có tồn tại không
    if(!$cartegory) {
        return redirect()->route('admin.getCateList')->with('error', 'Không tìm thấy danh muc.');
    }
    // Lấy đường dẫn tới file ảnh
   
  
    // Xóa xe
    $cartegory->delete();

    // Chuyển hướng 
    return redirect()->route('admin.getCateList')->with('success', 'Sản phẩm đã được xóa thành công.');

    }
}
