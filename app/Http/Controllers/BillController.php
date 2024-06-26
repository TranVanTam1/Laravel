<?php

namespace App\Http\Controllers;
use App\Models\Bill ; 
use App\Models\BillDetail ; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
class BillController extends Controller
{
    //
   
    public function getBillList($status = null)
    {
        // Query các hóa đơn dựa trên trạng thái và sắp xếp theo ngày đặt hàng giảm dần
        $query = Bill::query()->orderBy('date_order', 'desc');
    
        // Nếu có trạng thái được cung cấp, thêm điều kiện lọc
        if ($status && in_array($status, ['New', 'In progress', 'Delivered','Cancelled','Request'])) {
            $query->where('status', $status);
        }
    
        // Lấy danh sách hóa đơn với phân trang
        $bills = $query->paginate(10); // Số lượng hóa đơn mỗi trang (có thể thay đổi tùy ý)
    
        // Trả về view và truyền danh sách hóa đơn
        return view('admin.order.list-bill', compact('bills'));
    }
    

    public function getBillDetail($id)
{
    // Truy vấn các chi tiết hóa đơn có id_bill tương ứng với $id
    $billDetails = BillDetail::where('id_bill', $id)->get();
    
    // Trả về view 'admin.order.bill-detail' với dữ liệu $billDetails
    return view('admin.order.bill-detail', compact('billDetails'));
}
public function updateStatus($id, $newStatus)
{
    $bill = Bill::findOrFail($id);

    // Kiểm tra xem $newStatus có hợp lệ không và thực hiện cập nhật
    if (in_array($newStatus, ['New', 'In progress', 'Delivered', 'Cancelled','Request'])) {
        $bill->status = $newStatus;
        $bill->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
    } else {
        return redirect()->back()->with('error', 'Không thể cập nhật trạng thái đơn hàng.');
    }
}

public function edit($id)
{
    $bill = Bill::findOrFail($id); // Lấy hóa đơn từ ID, sử dụng Eloquent Model

    return view('admin.order.edit',compact('bill'));
}

public function update(Request $request, $id)
{
    $bill = Bill::findOrFail($id); // Tìm hóa đơn cần cập nhật

    // Validate dữ liệu nếu cần thiết
    $request->validate([
        'customer_name' => 'required|string|max:255',
        'total' => 'required|numeric',
        'payment_method' => 'required|string',
        'date_order' => 'required|date',
        'status' => 'required|in:New,In progress,Delivered,Cancelled,Request',
        'note' => 'nullable|string',
        // Thêm các trường dữ liệu khác cần thiết
    ]);

    // Cập nhật thông tin hóa đơn từ dữ liệu form
    $bill->id_customer = $request->input('customer_name');
    $bill->total = $request->input('total');
    $bill->payment= $request->input('payment_method');
    $bill->date_order = $request->input('date_order');
    $bill->status = $request->input('status');
    $bill->note = $request->input('note');

    // Lưu thay đổi vào cơ sở dữ liệu
    $bill->save();

    return redirect()->route('admin.bills.status', ['status' => $bill->status])
                     ->with('success', 'Hóa đơn đã được cập nhật thành công');
}

public function editBillDetail($id)
    {
        $billDetail = BillDetail::findOrFail($id);

        return view('admin.order.edit-detail', compact('billDetail'));
    }

    public function updateBillDetail(Request $request, $id)
    {
        $billDetail = BillDetail::findOrFail($id);

        // Validate dữ liệu nếu cần thiết
        $request->validate([
            'quantity' => 'required|numeric',
            'unit_price' => 'required|numeric',
            // Thêm các trường dữ liệu khác cần thiết
        ]);

        // Cập nhật thông tin chi tiết hóa đơn từ dữ liệu form
        $billDetail->quantity = $request->input('quantity');
        $billDetail->unit_price = $request->input('unit_price');
        // Cập nhật các trường dữ liệu khác tương tự

        $billDetail->save();

        return redirect()->route('admin.bills.status', ['status' => $billDetail->bill->status])
                         ->with('success', 'Chi tiết hóa đơn đã được cập nhật thành công');
    }


// Phương thức khác của controller nếu cần thiết
}

