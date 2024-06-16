<?php

namespace App\Http\Controllers;
use App\Models\Bill ; 
use App\Models\BillDetail ; 
use Illuminate\Http\Request;

class BillController extends Controller
{
    //
   
    public function getBillList($status = null)
    {
        // Query các hóa đơn dựa trên trạng thái và sắp xếp theo ngày đặt hàng giảm dần
        $query = Bill::query()->orderBy('date_order', 'desc');
    
        // Nếu có trạng thái được cung cấp, thêm điều kiện lọc
        if ($status && in_array($status, ['New', 'In progress', 'Delivered','Cancelled'])) {
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
    if (in_array($newStatus, ['New', 'In progress', 'Delivered', 'Cancelled'])) {
        $bill->status = $newStatus;
        $bill->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
    } else {
        return redirect()->back()->with('error', 'Không thể cập nhật trạng thái đơn hàng.');
    }
}

// Phương thức khác của controller nếu cần thiết
}

