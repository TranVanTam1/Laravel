@extends('admin.master')

@section('content')
    <div id="page-wrapper">
        <div class="container mt-5">
            <h1 class="mb-4" style="color: red; text-align: center;">Danh sách các hóa đơn</h1>
            <p><br>
            <!-- Thêm thanh menu trạng thái -->
            <div class="mb-3">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::get('status') == 'New' ? 'active' : '' }}" href="{{ route('admin.bills.status',['status'=>'New']) }}">Mới </a>
                        
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::get('status') == 'In progress' ? 'active' : '' }}" href="{{ route('admin.bills.status', ['status' => 'In progress']) }}">Đang giao</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::get('status') == 'Delivered' ? 'active' : '' }}" href="{{ route('admin.bills.status', ['status' => 'Delivered']) }}">Đã giao</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::get('status') == 'Cancelled' ? 'active' : '' }}" href="{{ route('admin.bills.status', ['status' => 'Cancelled']) }}">Đã hủy</a>
                    </li>
                    <li class="nav-item">

                        <a class="nav-link {{ Request::get('status') == 'Request' ? 'active' : '' }}" href="{{ route('admin.bills.status',['status'=>'Request']) }}">Yêu cầu hủy</a>
                    </li>
  
                </ul>
            </div>
            <br>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">ID</th>
                        <th class="text-center">Khách hàng</th>
                        <th class="text-center">Ngày đặt hàng</th>
                        <th class="text-center">Tổng tiền</th>
                        <th class="text-center">Hình thức thanh toán</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Ghi chú</th>
                        <th class="text-center">Chỉnh sửa</th>
                        <th class="text-center">Xem chi tiết</th>
                        <th class="text-center">Chuyển trạng thái</th>
                        <th class="text-center">Hủy đơn</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($bills)
                        @foreach($bills as $bill)
                            <tr>
                                <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                <td class="align-middle text-center">{{ $bill->id }}</td>
                                <td class="align-middle text-center">{{ $bill->customer->name }}</td>
                                <td class="align-middle text-center">{{ $bill->date_order }}</td>
                                <td class="align-middle text-center">{{ $bill->total }}</td>
                                <td class="align-middle text-center">{{ $bill->payment }}</td>
                                <td class="align-middle text-center">{{ $bill->status }}</td>
                                <td class="align-middle">
                                    @if (strlen($bill->note) > 20)
                                        {{ substr($bill->note, 0, 20) }}{{ strlen($bill->note) > 20 ? '...' : '' }}
                                        <span id="note_{{ $bill->id }}" style="display:none;">{{ substr($bill->note, 20) }}</span>
                                        <button class="btn btn-link btn-sm" style="border: none;" onclick="toggleNote({{ $bill->id }})">Xem thêm</button>
                                    @else
                                        {{ $bill->note }}
                                    @endif
                                </td>
                                <td class="align-middle text-center"><a href="{{ route('admin.edit', ['id' => $bill->id]) }}"><button class="btn btn-sm btn-info">Chỉnh sửa</button></a></td>

                                <td class="align-middle text-center"><a href="{{ route('admin.getBillDetail', ['id' => $bill->id]) }}"><button class="btn btn-sm btn-info">Chi tiết</button></a></td>
                                <td class="align-middle text-center">
                                    @if ($bill->status == 'New') {{-- Kiểm tra nếu đơn hàng chưa hoàn thành thì mới hiển thị nút --}}
                                        <form action="{{ route('admin.bills.updateStatus', ['id' => $bill->id, 'newStatus' => 'In progress']) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-success">Đang giao</button>
                                        </form>
                                    @endif
                                    @if ($bill->status == 'In progress') {{-- Kiểm tra nếu đơn hàng chưa hoàn thành thì mới hiển thị nút --}}
                                        <form action="{{ route('admin.bills.updateStatus', ['id' => $bill->id, 'newStatus' => 'Delivered']) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-success">Đã giao</button>
                                        </form>
                                    @endif
                                    @if ($bill->status == 'Delivered') {{-- Kiểm tra nếu đơn hàng chưa hoàn thành thì mới hiển thị nút --}}
                                   <span style="color:rgb(6, 148, 82)">Đã hoàn thành </span>
                                @endif
                                    @if ($bill->status == 'Cancelled') {{-- Kiểm tra nếu đơn hàng chưa hoàn thành thì mới hiển thị nút --}}
                                    <form action="{{ route('admin.bills.updateStatus', ['id' => $bill->id, 'newStatus' => 'New']) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-success">Mua lại</button>
                                    </form>
                                @endif
                                </td>
                                <td class="align-middle text-center">
                                   @if ($bill->status != 'Cancelled' && $bill->status !='Delivered')
                                   <form action="{{ route('admin.bills.updateStatus', ['id' => $bill->id, 'newStatus' => 'Cancelled']) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-danger">Hủy</button>
                                </form>
                                
                                   
                                        @endif
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
            {{ $bills->links() }}
        </div>
    </div>
    <style>
        .nav-pills .nav-item .nav-link.active {
    background-color: #f0f0f0; /* Đây là màu xám trắng, bạn có thể thay đổi màu sắc tại đây */
    /* Các thuộc tính khác nếu cần */
}
</style>
<script>
    function toggleNote(billId) {
        var noteElement = document.getElementById('note_' + billId);
        var buttonText = noteElement.style.display === 'none' ? 'Thu gọn' : 'Xem thêm';
        noteElement.style.display = noteElement.style.display === 'none' ? 'inline' : 'none';
        document.querySelector('[onclick="toggleNote(' + billId + ')"]').innerHTML = buttonText;
    }
</script>
@endsection
