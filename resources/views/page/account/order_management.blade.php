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
                <li class="nav-item">
                    <a class="nav-link {{ Request::get('status') == 'Request' ? 'active' : '' }}" href="{{ route('my.orders', ['status' => 'Request']) }}">Yêu cầu hủy</a>
                </li>
            </ul>
        </div>

        {{-- Orders Display --}}
        <div id="orders-container">
            @isset($orders) 
                @if($orders->count() > 0)
                    @foreach ($orders as $order)
                    <div class="col-md-6">
                        <div class="order card mb-4">
                            <div class="card-body">
                                <h5 class="order-title card-title">Đơn hàng #{{ $order->id }}</h5>
                                <ul class="list-unstyled order-details">
                                    <li><strong>Ngày đặt hàng:</strong> {{ $order->created_at->format('F j, Y') }}</li>
                                    <li><strong>Tổng thanh toán:</strong> {{ number_format($order->total) }}</li>
                                    <li><strong>Tình trạng:</strong> {{ $order->status }}</li>
                                </ul>
                                <div class="order-actions">
                                    <a href="{{ route('order.showDetailOrder', ['id' => $order->id]) }}" class="btn btn-primary">Xem chi tiết</a>
                                    @if ($order->status == 'New')
                                    <a href="{{ route('order.cancel', ['id' => $order->id]) }}" class="btn btn-danger">Hủy đơn</a>

                                    @elseif($order->status == 'In progress')
                                    <a href="{{ route('order.requestCancel', ['id' => $order->id]) }}" class="btn btn-danger">Yêu cầu hủy</a>
                                    
                                    @elseif($order->status == 'Request')
                                    <a href="{{ route('order.cancelRequest', ['id' => $order->id]) }}" class="btn btn-danger">Bỏ hủy</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else 
                <p>Không có đơn hàng !</p>
                @endif
            @else
            <p>Không có đơn hàng !</p>
            @endisset
        </div>

        <a class="continue-shopping-btn" href="https://online.mmvietnam.com">Tiếp tục mua sắm</a>
    </div>
</div>
@endsection
