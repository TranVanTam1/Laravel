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
                                    </span>
                                </td>
                                <td class="product-status">
                                    In Stock
                                </td>
                                <td class="product-quantity">
                                    <select class="product-qty" data-product-id="{{ $product['item']['id'] }}">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" @if($i == $product['qty']) selected @endif>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </td>
                                <td class="product-subtotal">
                                    <span class="subtotal-amount">
                                        {{ number_format($product['item']['promotion_price'] == 0 ? $product['item']['unit_price'] * $product['qty'] : $product['item']['promotion_price'] * $product['qty']) }}
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
                            <div class="coupon">
                                <label for="coupon_code">Coupon</label> 
                                <input type="text" name="coupon_code" value="" placeholder="Coupon code"> 
                                <button type="submit" class="beta-btn primary" name="apply_coupon">Apply Coupon <i class="fa fa-chevron-right"></i></button>
                            </div>
                            <button type="submit" class="beta-btn primary update-cart-btn" name="update_cart">Update Cart <i class="fa fa-chevron-right"></i></button> 
                            <a href="{{ route('page.getdathang') }}">
                                <button type="button" name="proceed" class="beta-btn primary">
                                    Proceed to Checkout <i class="fa fa-chevron-right"></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="cart-collaterals">
            <form class="shipping_calculator pull-left" action="#" method="post">
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
                    <input type="hidden" id="woocommerce-shipping-calculator-nonce" name="woocommerce-shipping-calculator-nonce" value="e5087acaa3">
                    <input type="hidden" name="_wp_http_referer" value="/wp-admin/admin-ajax.php">
                </section>
            </form>

            <div class="cart-totals pull-right">
                <div class="cart-totals-row">
                    <h5 class="cart-total-title">Cart Totals</h5>
                </div>
                <div class="cart-totals-row">
                    <h5>Subtotal:</h5>
                    <span class="subtotal-amount"></span>
                </div>
                <div class="cart-totals-row">
                    <h5>Shipping:</h5>
                    <span>Free Shipping</span>
                </div>
                <div class="cart-totals-row">
                    <h5>Total:</h5>
                    <span class="total-amount"></span>
                </div>
                <div class="clearfix"></div>
                <div class="cart-totals-row beta-billing-checkout">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{ route('page.getdathang') }}" class="beta-btn primary">Proceed to Checkout <i class="fa fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div> <!-- #content -->
</div> <!-- .container -->

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Update cart item quantity via AJAX
        $('.product-qty').change(function() {
            var productId = $(this).data('product-id');
            var quantity = $(this).val();

            $.ajax({
                type: "POST",
                url: "{{ route('page.capnhatgiohang') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: productId,
                    quantity: quantity
                },
                success: function(data) {
                    // Update subtotal amount in the UI
                    var unitPrice = data.unitPrice;
                    var subtotal = unitPrice * quantity;
                    $(this).closest('.cart_item').find('.subtotal-amount').text(subtotal.toLocaleString('en-US', { style: 'currency', currency: 'USD' }));

                    // Recalculate total amount in the UI (if needed)
                    // calculateCartTotals();
                }.bind(this), // bind `this` to maintain the correct context
                error: function(xhr, textStatus, errorThrown) {
                    console.error('Error:', errorThrown);
                }
            });
        });

        // Initial calculation of cart totals
        // calculateCartTotals();
    });

    function calculateCartTotals() {
        var total = 0;
        $('.subtotal-amount').each(function() {
            total += parseFloat($(this).text().replace(/[^\d.-]/g, ''));
        });
        $('.total-amount').text(total.toLocaleString('en-US', { style: 'currency', currency: 'USD' }));
    }
</script>
@endsection

