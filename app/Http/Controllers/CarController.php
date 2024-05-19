<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Mf;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function mf()
    {
        return $this->belongsTo(Mf::class, 'mf_id');
    }
    public function index(Request $request)
    {
        $input = $request->input('input');
        $query = Car::query();
        if ($input) {
            $cars = Car::where('description', 'LIKE', "%$input%")
                ->orWhere('model', 'LIKE', "%$input%")
                ->orWhere('id', 'LIKE', "%$input%")
                ->orWhereHas('mf', function($query) use ($input) {
                    $query->where('mf_name', 'LIKE', "%$input%");
                })
                ->orderBy('created_at', 'desc')
                ->paginate(15);
            } else {
                $cars = Car::orderBy('created_at', 'desc')->paginate(15)->onEachSide(5);
            }
        $totalCar=$cars->count();
        return view('car.index', compact('cars','totalCar'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $mfs = Mf::all();
        return view('car.create',compact('mfs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $name=" ";
        $validation = Validator::make($request->all(),
        [
            "description"  => "required",
            "model" => "required",
            "produced_on"  => "required|date",
            "mf_id" =>"required",
            'image'=>'mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        if ($validation->fails()){
            return redirect('cars/create')->withErrors($validation)->withInput();
        }
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $name=time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('images'); //project\public\images, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/
        }
     
        $car=new Car();
        $car->description=$request->input('description');
        $car->model=$request->input('model');
        $car->produced_on=$request->input('produced_on');
        $car->mf_id=$request->input('mf_id');
        $car->image=$name;
        $car->save();
        return redirect('cars')->with('success','Thêm xe thành công');
    }
    
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $car = Car::find($id);
        return view('car.car-show',compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $car = Car::findOrFail($id);
        $mfs = Mf::all();
        // Trả về view edit
        return view('car.edit', compact('car','mfs'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $name=" ";
        $validation = Validator::make($request->all(),
        [
            "description"  => "required",
            "model" => "required",
            "produced_on"  => "required|date",
            "mf_id" =>"required",
            'image'=>'mimes:jpeg,jpg,png,gif|max:10000'
            
        ]);

        if ($validation->fails()){
            return redirect('cars/create')->withErrors($validation)->withInput();
        }
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $name=time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('images'); //project\public\images, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/
        }
     
        $car=Car::find($id);
        if($car!=null){
            $car->description=$request->input('description');
            $car->model=$request->input('model');
            $car->produced_on=$request->input('produced_on');
            $car->mf_id=$request->input('mf_id');
            if($name==" "){
                $name=$car->image;
            }
            $car->image=$name;
            $car->save();
        
        }
        return redirect()->route('cars.index')->with('success', 'Thông tin xe đã được cập nhật thành công.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Tìm và xóa xe từ cơ sở dữ liệu
    $car = Car::find($id);

    // Kiểm tra xem xe có tồn tại không
    if(!$car) {
        return redirect()->route('cars.index')->with('error', 'Không tìm thấy xe.');
    }
    // Lấy đường dẫn tới file ảnh
   
    // Kiểm tra xem file ảnh có tồn tại không
    $linkImage=public_path('images/').$car->image;
        if(File::exists($linkImage)){
            File::delete($linkImage);
        }
        
    // Xóa xe
    $car->delete();

    // Chuyển hướng 
    return redirect()->route('cars.index')->with('success', 'Xe đã được xóa thành công.');
}
}
