@extends('layout.master')
@section('content')

<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Sản phẩm</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="index.html">Home</a> / <span>Sản phẩm</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="row">
               <div class="col-sm-3">
    <ul class="aside-menu">
        @isset($types)
            @foreach ($types as $type)
                <li><a href="{{ route('products.by.type', ['type' => $type->id]) }}">{{ $type->name }}</a></li>
            @endforeach
        @endisset
    </ul>
</div>
                <div class="col-sm-9">
                    <div class="beta-products-list">
                        <h4>Sản phẩm mới</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">{{ count($new_products) }} styles found</p>
                            <div class="clearfix"></div>
                        </div>
                
                        <div class="row">
                            @php $stt = 0; @endphp
                            @foreach($new_products as $new_product)
                                @php $stt++; @endphp
                                <div class="col-sm-4">
                                    <div class="single-item">
                                        @if($new_product->promotion_price != 0)
                                            <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                        @endif
                                        <div class="single-item-header">
                                            <a href="{{ route('page.product', ['id' => $new_product->id]) }}">
                                                <img src="/images/product/{{ $new_product->image }}" height="200px" alt="{{ $new_product->name }}">
                                            </a>
                                        </div>
                                        <div class="single-item-body">
                                            <p class="single-item-title">{{ strlen($new_product->name) > 30 ? substr($new_product->name, 0, 30) . '...' : $new_product->name }}</p>

                                            <p class="single-item-price">
                                                @if($new_product->promotion_price == 0)
                                                    <span class="flash-sale small">{{ number_format($new_product->unit_price) }} đồng</span>
                                                @else
                                                    <span class="flash-del small">{{ number_format($new_product->unit_price) }} đồng</span>
                                                    <span class="flash-sale small">{{ number_format($new_product->promotion_price) }} đồng</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="single-item-caption">
                                            @if(Auth::check())
                                                <a href="{{ route('product.favorite', $new_product->id) }}" class="add-to-favorites pull-left">
                                                    <i class="fa fa-heart"></i> Yêu thích
                                                </a> <br><br>
                                            @endif
                                            <a class="add-to-cart pull-left" href="{{ route('page.addtocart', ['id' => $new_product->id]) }}">
                                                <i class="fa fa-shopping-cart"></i>
                                            </a>
                                            <a class="beta-btn primary" href="{{ route('page.product', ['id' => $new_product->id]) }}">Details <i class="fa fa-chevron-right"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                                @if($stt % 3 == 0)
                                    <div class="space40">&nbsp;</div>
                                @endif
                            @endforeach
                        </div>
                        
                                <div class="beta-products-details">
                                    <p class="pull-left">{{ count($products) }} styles found</p>
                                    <div class="clearfix"></div>
                                </div>
                                <h4>Sản phẩm khác</h4>
                                <div class="row">
                                    @php $stt = 0; @endphp
                                    @foreach($products as $product)
                                        @php $stt++; @endphp
                                        <div class="col-sm-4">
                                            <div class="single-item">
                                                @if($product->promotion_price != 0)
                                                    <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                                @endif
                                                <div class="single-item-header">
                                                    <a href="{{ route('page.product', ['id' => $product->id]) }}">
                                                        <img src="/images/product/{{ $product->image }}" height="200px" alt="{{ $product->name }}">
                                                    </a>
                                                </div>
                                                <div class="single-item-body">
                                                    <p class="single-item-title">{{ $product->name }}</p>
                                                    <p class="single-item-price">
                                                        @if($product->promotion_price == 0)
                                                            <span class="flash-sale small">{{ number_format($product->unit_price) }} đồng</span>
                                                        @else
                                                            <span class="flash-del small">{{ number_format($product->unit_price) }} đồng</span>
                                                            <span class="flash-sale small">{{ number_format($product->promotion_price) }} đồng</span>
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="single-item-caption">
                                                    @if(Auth::check())
                                                        <a href="{{ route('product.favorite', $product->id) }}" class="add-to-favorites pull-left">
                                                            <i class="fa fa-heart"></i> Yêu thích
                                                        </a> <br><br>
                                                    @endif
                                                    <a class="add-to-cart pull-left" href="{{ route('page.addtocart', ['id' => $product->id]) }}">
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </a>
                                                    <a class="beta-btn primary" href="{{ route('page.product', ['id' => $product->id]) }}">Details <i class="fa fa-chevron-right"></i></a>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                        @if($stt % 3 == 0)
                                            <div class="space40">&nbsp;</div>
                                        @endif
                                    @endforeach
                                
                        </div>
                        {{ $products->links() }} <!-- Pagination links -->
                
                        <div class="space50">&nbsp;</div>
                    </div> <!-- .beta-products-list -->
                </div>
                
            </div> <!-- end section with sidebar and main content -->
            
            

        </div> <!-- .main-content -->
    </div> <!-- #content -->
</div> <!-- .container -->
<script>
	$(document).ready(function($) {    
		$(window).scroll(function(){
			if($(this).scrollTop()>150){
			$(".header-bottom").addClass('fixNav')
			}else{
				$(".header-bottom").removeClass('fixNav')
			}}
		)
	})
	</script>

<style>
.small {
    font-size: 80%; /* Adjust the percentage as needed */
}
</style>
@endsection
