<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class SlideController extends Controller
{
    //
    // SlideController.php

public function index()
{
    $slides = Slide::all();
    return view('admin.slide.index', compact('slides'));
}

public function create()
{
    return view('admin.slide.create');
}

public function store(Request $request)
{
    // Validate input
    $name=" ";
        $validation = Validator::make($request->all(),
        [
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'stt' => 'required|integer',
    ]);
try {
    if ($validation->fails()){
        return redirect()->route('admin.create')->withErrors($validation)->withInput();
    }
    // Không cần phải tạo Validator thủ công, Laravel đã thực hiện điều này cho bạn
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $name = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('/images/slide');
        $file->move($destinationPath, $name);
    } else {
        // Nếu không có tệp được tải lên, có thể xử lý theo ý của bạn, ví dụ:
        $name = null; // hoặc một giá trị mặc định khác
    }
    
    // Lưu dữ liệu vào CSDL
    $slide = new Slide();
    $slide->stt = $request->input('stt');
    $slide->image = $name;
    $slide->save();

    return redirect()->route('slides.index')->with('success', 'Slide đã được tạo thành công.');
} catch (\Exception $e) {
    return redirect()->back()->with('error', 'Failed to update slide: ' . $e->getMessage());
}
}

public function edit($id)
{
    $slide = Slide::findOrFail($id);
    return view('admin.slide.edit', compact('slide'));
}

public function update(Request $request, $id)
{
    // Validate input
    $validatedData = $request->validate([
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'stt' => 'required|integer',
    ]);

    try {
        // Find slide
        $slide = Slide::findOrFail($id);

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('/images/slide'); // Destination folder for image storage
        
            // Delete old image if exists
            if ($slide->image) {
                $oldImagePath = public_path('/images/slide/' . $slide->image); // Add a slash before slide
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        
            // Move new image to storage folder and update slide image field
            $file->move($destinationPath, $name);
            $slide->image = $name;
        }
        

        // Update slide order
        $slide->stt = $validatedData['stt'];

        // Save changes to the database
        $slide->save();

        return redirect()->route('slides.index')->with('success', 'Slide updated successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to update slide: ' . $e->getMessage());
    }
}



public function destroy($id)
{
    $slide = Slide::findOrFail($id);
    if(!$slide) {
        return redirect()->route('slides.index')->with('error', 'Không tìm thấy Sản phẩm.');
    }
    // Lấy đường dẫn tới file ảnh
   
    // Kiểm tra xem file ảnh có tồn tại không
    $linkImage=public_path('/images/slide/').$slide->image;
        if(File::exists($linkImage)){
            File::delete($linkImage);
        }
        
    // Xóa xe
    $slide->delete();
    return redirect()->route('slides.index')->with('success', 'Slide đã được xoá thành công.');
}

}
