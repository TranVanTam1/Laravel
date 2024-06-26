@extends('page.account.layout')

@section('content2')
<div class="col-md-9">
    <div class="woocommerce-MyAccount-content p-4 bg-white rounded">
        <div class="woocommerce-notices-wrapper"></div>
        <div class="account-details-head">Theo dõi đơn hàng</div>
        
        {{-- Filter Orders by Status --}}
        <div class="mb-3">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link {{ Request::get('status') == 'New' ? 'active' : '' }}" href="{{ route('my.orders', ['status' => 'New']) }}">Mới</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::get('status') == 'In progress' ? 'active' : '' }}" href="{{ route('my.orders', ['status' => 'In progress']) }}">Đang giao</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::get('status') == 'Delivered' ? 'active' : '' }}" href="{{ route('my.orders', ['status' => 'Delivered']) }}">Đã giao</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::get('status') == 'Cancelled' ? 'active' : '' }}" href="{{ route('my.orders', ['status' => 'Cancelled']) }}">Đã hủy</a>
                </li>
            </ul>
        </div>

        {{-- Orders Display --}}
        <div id="orders-container">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">ID Hóa đơn</th>
                        <th class="text-center">Tên Sản phẩm</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-center">Đơn giá</th>
                        <th class="text-center">Thành tiền</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalBill=0;
                    @endphp
                    @isset($billDetails)
                        @foreach($billDetails as $billDetail)
                            <tr>
                                <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                <td class="align-middle text-center">{{ $billDetail->id_bill }}</td>
                                <td class="align-middle text-center">{{ $billDetail->product->name }}</td>
                                <td class="align-middle text-center">{{ $billDetail->quantity }}</td>
                                <td class="align-middle text-center">{{ $billDetail->unit_price }}</td>
                                <td class="align-middle text-center">{{ $billDetail->quantity * $billDetail->unit_price }}</td>
                               @php
                                    $totalBill+=$billDetail->quantity * $billDetail->unit_price
                               @endphp
                               
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
            <div style="text-align: end ; margin-right: 30px;">Tổng tiền đơn hàng của bạn : {{number_format($totalBill)}} <sup>đ</sup></div> <br>
        </div>
        <a class="continue-shopping-btn" href="{{ route('my.orders', ['status' => 'New']) }}">Quay lại</a>
        <a class="continue-shopping-btn" href="https://online.mmvietnam.com">Tiếp tục mua sắm</a>
    </div>
</div>



@endsection
