<!-- Trong resources/views/emails/orders/placed.blade.php -->

@component('mail::message')
# Xác nhận đơn hàng của bạn

Chào bạn,

Đơn hàng #{{ $order_id }} đã được đặt thành công.

Thông tin đơn hàng:
- Tổng thanh toán: {{ number_format($order_total) }}

Danh sách sản phẩm:
@foreach ($order_details as $detail)
- {{ $detail['product_name'] }} | Số lượng: {{ $detail['quantity'] }} | Giá: {{ number_format($detail['price']) }}
@endforeach

Cảm ơn bạn đã mua hàng của chúng tôi.

Cảm ơn,<br>
{{ config('app.name') }}
@endcomponent
