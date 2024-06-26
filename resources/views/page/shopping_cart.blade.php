<!-- resources/views/cart.blade.php -->

@extends('layout.master')
@section('content')

<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Shopping Cart</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="index.html">Home</a> / <span>Shopping Cart</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        <div class="table-responsive">
            <table class="shop_table beta-shopping-cart-table" cellspacing="0">
                <thead>
                    <tr>
                        <th class="product-name">Product</th>
                        <th class="product-price">Price</th>
                        <th class="product-status">Status</th>
                        <th class="product-quantity">Qty.</th>
                        <th class="product-subtotal">Total</th>
                        <th class="product-remove">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalAmount = 0;            
                        $shippingFree=0;
                    if($subtotal>=500000){
                        $shippingFree=0;
                    }else{
                        $shippingFree=30000;
                    }
                    $totalPrice=$total+$shippingFree;
                @endphp

                    @if(Session::has('cart'))
                        @foreach($productCarts as $product)
                            <tr class="cart_item">
                                <td class="product-name">
                                    <div class="media">
                                        <img class="pull-left" src="assets/dest/images/shoping1.jpg" alt="">
                                        <div class="media-body">
                                            <p class="font-large table-title">{{ $product['item']['name'] }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="product-price">
                                    <span class="unit-price">
                                        @if($product['item']['promotion_price'] == 0)
                                            {{ number_format($product['item']['unit_price']) }}
                                        @else
                                            {{ number_format($product['item']['promotion_price']) }}
                                        @endif
                                    </span><sup>vnđ</sup>
                                </td>
                                <td class="product-status">
                                    Đủ hàng
                                </td>
                                <td class="product-quantity">
                                    <form action="{{ route('cart.updateQuantity', $product['item']['id']) }}" method="POST" class="update-quantity-form">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="product_id" value="{{ $product['item']['id'] }}">
                                        <select name="quantity" class="product-qty" data-product-id="{{ $product['item']['id'] }}">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}" @if($i == $product['qty']) selected @endif>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                    </form>
                                </td>
                                <td class="product-subtotal">
                                    <span class="subtotal-amount">
                                        {{ number_format($product['item']['promotion_price'] == 0 ? $product['item']['unit_price'] * $product['qty'] : $product['item']['promotion_price'] * $product['qty']) }} <sup>vnđ</sup>
                                    </span>
                                </td>
                                <td class="product-remove">
                                    <a href="{{ route('page.xoagiohang', $product['item']['id']) }}" class="remove" title="Remove this item"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                            
                        @endforeach
                    @else

                        <tr class="cart_item">
                            <td class="product-name">
                                <div class="media">
                                    <img class="pull-left" src="assets/dest/images/shoping1.jpg" alt="">
                                    <div class="media-body">
                                        <p class="font-large table-title">0</p>
                                    </div>
                                </div>
                            </td>
                            <td class="product-price">
                                <span class="amount">0</span>
                            </td>
                            <td class="product-status">
                                0
                            </td>
                            <td class="product-quantity">
                                <select name="product-qty" id="product-qty">
                                    <option value="">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </td>
                            <td class="product-subtotal">
                                <span class="amount">0</span>
                            </td>
                            <td class="product-remove">
                                <a href="#" class="remove" title="Remove this item"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" class="actions">
                           <!-- Trong phần coupon.blade.php -->
                           <div class="coupon">
                            <label for="coupon_code">Coupon</label>
                            <form id="apply_coupon_form" action="{{ route('apply.coupon') }}" method="POST">
                                @csrf
                                <input type="text" id="coupon_code" required name="coupon_code" placeholder="Enter coupon code">
                                <button type="submit" id="apply_coupon_btn">Apply Coupon</button>
                            </form>
                            <p id="discount_message"></p>
                        </div>
            
                       
                        <a href="{{ route('page.getdathang', ['total' =>$totalPrice]) }}">
                            <button type="button" class="beta-btn primary">Proceed to Checkout <i class="fa fa-chevron-right"></i></button>
                        </a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="cart-collaterals">
            <form class="shipping_calculator pull-left" action="" method="post">
                @csrf
                <h2><a href="#" class="shipping-calculator-button">Calculate Shipping <span>↓</span></a></h2>
                <section class="shipping-calculator-form" style="display: none;">
                    <p class="form-row form-row-wide">
                        <select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state" style="padding:10px;" rel="calc_shipping_state">
                            <option value="">Select a country…</option>
                            <!-- Your country options here -->
                        </select>
                    </p>
                    <p class="form-row form-row-wide" id="calc_shipping_state_field" style="display: none;">
                        <input type="text" value="" placeholder="State / country" id="calc_shipping_state" name="calc_shipping_state">
                    </p>
                    <p class="form-row form-row-wide">
                        <input type="text" value="" placeholder="Postcode / ZIP" id="calc_shipping_postcode" name="calc_shipping_postcode">
                    </p>
                    <p>
                        <button type="submit" name="calc_shipping" value="1" class="beta-btn primary">Update Totals</button>
                    </p>
                </section>
            </form>
            <h6 class="cart-total-title" style="color:red;font-size: 20px">Với những hóa đơn có tổng đơn hàng trên 500k sẽ được FREESHIP !</h6>
           
            <div class="cart-collaterals">
                
    
                <div class="cart-totals pull-right">
                    <div class="cart-totals-row">
                        <h5 class="cart-total-title">Cart Totals</h5>
                    </div>
                    <div class="cart-totals-row">
                        <div class="subtotal">
                           <h5>Subtotal: <span class="subtotal-amount">{{ number_format($subtotal) }}</span><sup>vnđ</sup></h5>
                        </div> 
                    </div>
                   
                    <div class="cart-totals-row">
                        <div class="shipping">
                            <h5>Shipping: <span class="shipping-amount">
                              
                                    {{ number_format($shippingFree) }}  
                               
                            </span><sup>vnđ</sup></h5>
                        </div>
                    </div>
                    <div class="cart-totals-row">
                        <div class="discount">
                            <h5>Discount: <span class="discount-amount">@isset($discountTotal)
                                {{$discountTotal}}
                            @endisset</span><sup>vnđ</sup></h5>
                        </div>
                    </div>
                    <div class="cart-totals-row">
                        <div class="total">
                            <h5>Total: <span class="total-amount">{{ number_format($total + $shippingFree) }}</span><sup>vnđ</sup></h5>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="cart-totals-row beta-billing-checkout">
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="{{ route('page.getdathang', ['total' =>$totalPrice]) }}" class="beta-btn primary">Checkout <i class="fa fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            
            <div class="clearfix"></div>
        </div>
        
    </div> <!-- #content -->
</div> <!-- .container -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

$(document).ready(function() {
    // Xử lý khi bấm nút "Update Cart"
    $('.update-cart-btn').click(function(event) {
        event.preventDefault(); // Ngăn chặn hành động mặc định của nút submit

        // Tạo một mảng chứa thông tin sản phẩm cần cập nhật
        var products = [];

        // Lặp qua từng sản phẩm trong giỏ hàng
        $('.cart_item').each(function() {
            var productId = $(this).find('.product-qty').data('product-id');
            var quantity = $(this).find('.product-qty').val();

            // Thêm thông tin sản phẩm vào mảng products
            products.push({
                id: productId,
                quantity: quantity
            });
        });

        // Gửi yêu cầu AJAX để cập nhật giỏ hàng
        $.ajax({
            type: "POST",
            url: "{{ route('cart.update') }}", // Thay đổi route tương ứng của bạn
            data: {
                _token: "{{ csrf_token() }}",
                products: products
            },
            success: function(data) {
                // Cập nhật lại tổng tiền và các thông tin khác trên giao diện
                updateCartTotals(data);
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error('Error:', errorThrown);
                // Xử lý lỗi nếu có
            }
        });
    });

    // Hàm cập nhật tổng tiền và các thông tin khác trên giao diện
    function updateCartTotals(data) {
        // Cập nhật subtotal
        $('.subtotal-amount').text(number_format(data.subtotal, 0, ',', '.') + ' vnđ');

        // Cập nhật shipping fee
        $('.total-amount').text(number_format(data.total, 0, ',', '.') );
    
        $('.shipping-amount').text(data.shippingFee === 0 ? 'FreeShip' : number_format(data.shippingFee, 0, ',', '.') + ' vnđ');
    }
});

 

function number_format(number, decimals, dec_point, thousands_sep) {
    // Hàm JavaScript mô phỏng hàm number_format() của PHP
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };

    // Kiểm tra phân số và định dạng số
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}




 
</script>

    
@endsection


