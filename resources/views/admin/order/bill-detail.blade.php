@extends('admin.master')

@section('content')
    <div id="page-wrapper">
        <div class="container mt-5">
            <h1 class="mb-4" style="color: red; text-align: center;">Chi tiết hóa đơn</h1>
            <br>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">ID Hóa đơn</th>
                        <th class="text-center">Tên Sản phẩm</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-center">Đơn giá</th>
                        <th class="text-center">Thành tiền</th>
                        <th class="text-center">Chỉnh sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($billDetails)
                        @foreach($billDetails as $billDetail)
                            <tr>
                                <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                <td class="align-middle text-center">{{ $billDetail->id_bill }}</td>
                                <td class="align-middle text-center">{{ $billDetail->product->name }}</td>
                                <td class="align-middle text-center">{{ $billDetail->quantity }}</td>
                                <td class="align-middle text-center">{{ $billDetail->unit_price }}</td>
                                <td class="align-middle text-center">{{ $billDetail->quantity * $billDetail->unit_price }}</td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('admin.editBillDetail', ['id' => $billDetail->id]) }}" class="btn btn-sm btn-info">Chỉnh sửa</a>
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
@endsection
