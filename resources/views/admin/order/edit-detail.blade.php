@extends('admin.master')

@section('content')
    <div id="page-wrapper">
        <div class="container mt-5">
            <h1 class="mb-4" style="color: red; text-align: center;">Chỉnh sửa hóa đơn</h1>
            <br>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.updateBillDetail', ['id' => $billDetail->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="id_bill">ID Hóa đơn</label>
                    <input type="text" class="form-control" id="id_bill" name="id_bill" value="{{ $billDetail->id_bill }}" readonly>
                </div>

                <div class="form-group">
                    <label for="product_id">ID Sản phẩm</label>
                    <input type="text" class="form-control" id="product_id" name="product_id" value="{{ $billDetail->id_product }}" readonly>
                </div>

                <div class="form-group">
                    <label for="quantity">Số lượng</label>
                    <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $billDetail->quantity }}">
                </div>

                <div class="form-group">
                    <label for="unit_price">Đơn giá</label>
                    <input type="text" class="form-control" id="unit_price" name="unit_price" value="{{ $billDetail->unit_price }}">
                </div>

                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            </form>
        </div>
    </div>
@endsection
