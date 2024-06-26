<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Cartegory; // Thêm Category model
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class TypeProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getTypeList()
    {
        $types = Type::with('cartegory')->orderBy('created_at', 'desc')->paginate(15)->onEachSide(5);
        return view('admin.type-product.list-type', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getTypeAdd()
    {
        
        $cartegorys = Cartegory::all(); // Lấy danh sách tất cả các danh mục= Cartegory::all(); // Lấy danh sách tất cả các danh mục
        return view('admin.type-product.create-type', compact('cartegorys'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function postTypeAdd(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "name" => "required",
            "description" => "required",
            'image' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'cartegory_id' => 'required|exists:cartegory,id' // Kiểm tra category_id tồn tại trong bảng categories
        ]);

        if ($validation->fails()) {
            return redirect()->route('admin.getTypeAdd')->withErrors($validation)->withInput();
        }

        $image = "default.jpg"; // Ảnh mặc định nếu không có ảnh được tải lên
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images/type-product');
            $file->move($destinationPath, $name);
            $image = $name;
        }

        $type = new Type();
        $type->name = $request->input('name');
        $type->description = $request->input('description');
        $type->image = $image;
        $type->cartegory_id = $request->input('cartegory_id'); // Lưu category_id
        $type->save();

        return redirect()->route('admin.getTypeList')->with('success', 'Thông tin sản phẩm đã được cập nhật thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getTypeEdit($id)
{
    $type = Type::findOrFail($id); // Fetch the type by ID
    $cartegorys = Cartegory::all(); // Fetch all categories to populate the dropdown

    return view('admin.type-product.edit-type', compact('type', 'cartegorys'));
}

    /**
     * Update the specified resource in storage.
     */
    public function postTypeEdit(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            "name" => "required",
            "description" => "required",
            'image' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'cartegory_id' => 'required|exists:cartegory,id' // Kiểm tra category_id tồn tại trong bảng categories
        ]);

        if ($validation->fails()) {
            return redirect()->route('admin.getTypeEdit', $id)->withErrors($validation)->withInput();
        }

        $type = Type::find($id);
        if (!$type) {
            return redirect()->route('admin.getTypeList')->with('error', 'Không tìm thấy loại sản phẩm.');
        }

        $image = $type->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images/type-product');
            $file->move($destinationPath, $name);
            $image = $name;

            // Xóa ảnh cũ nếu tồn tại và không phải là ảnh mặc định
            // Kiểm tra xem file ảnh có tồn tại không
            $linkImage=public_path('/images/type-product/').$type->image;
            if(File::exists($linkImage)){
                File::delete($linkImage);
            }
    
        }

        $type->name = $request->input('name');
        $type->description = $request->input('description');
        $type->image = $image;
        $type->cartegory_id = $request->input('cartegory_id');
        $type->save();

        return redirect()->route('admin.getTypeList')->with('success', 'Thông tin sản phẩm đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function getTypeDelete($id)
    {
        $type = Type::find($id);
        if (!$type) {
            return redirect()->route('admin.getTypeList')->with('error', 'Không tìm thấy sản phẩm.');
        }

        // Kiểm tra xem file ảnh có tồn tại không
        $linkImage=public_path('/images/type-product/').$type->image;
        if(File::exists($linkImage)){
            File::delete($linkImage);
        }
        

        $type->delete();

        return redirect()->route('admin.getTypeList')->with('success', 'Sản phẩm đã được xóa thành công.');
    }
}
