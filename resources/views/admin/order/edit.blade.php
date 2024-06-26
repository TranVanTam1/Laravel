@extends('admin.master')

@section('content')
    <div id="page-wrapper">
        <div class="container mt-5">
            <h1 class="mb-4" style="color: red; text-align: center;">Chỉnh sửa hóa đơn #{{ $bill->id }}</h1>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('admin.update', ['id' => $bill->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="customer_name">Tên khách hàng:</label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{  $bill->id_customer  }}" required>
                </div>

                <div class="form-group">
                    <label for="total">Tổng tiền:</label>
                    <input type="text" class="form-control" id="total" name="total" value="{{ $bill->total }}" required>
                </div>

                <div class="form-group">
                    <label for="payment_method">Hình thức thanh toán:</label>
                    <input type="text" class="form-control" id="payment_method" name="payment_method" value="{{ $bill->payment }}" required>
                </div>

                <div class="form-group">
                    <label for="date_order">Ngày đặt hàng:</label>
                    <input type="date" class="form-control" id="date_order" name="date_order" value="{{ $bill->date_order }}" required>
                </div>

                <div class="form-group">
                    <label for="status">Trạng thái:</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="{{$bill->status}}" {{$bill->status}}>Mới</option>
                        <option value="New" >Mới</option>
                        <option value="In progress" >Đang giao</option>
                        <option value="Delivered" >Đã giao</option>
                        <option value="Cancelled" >Đã hủy</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="note">Ghi chú:</label>
                    <textarea class="form-control" id="note" name="note" rows="3" required>{{ $bill->note }}</textarea>
                </div>

                <!-- Thêm các trường dữ liệu khác cần thiết cho hóa đơn -->

                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
@endsection
