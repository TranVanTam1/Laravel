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
                        <li><a href="#">Typography</a></li>
                        <li><a href="#">Buttons</a></li>
                        <li><a href="#">Dividers</a></li>
                        <li><a href="#">Columns</a></li>
                        <li><a href="#">Icon box</a></li>
                        <li><a href="#">Notifications</a></li>
                        <li><a href="#">Progress bars and Skill meter</a></li>
                        <li><a href="#">Tabs</a></li>
                        <li><a href="#">Testimonial</a></li>
                        <li><a href="#">Video</a></li>
                        <li><a href="#">Social icons</a></li>
                        <li><a href="#">Carousel sliders</a></li>
                        <li><a href="#">Custom List</a></li>
                        <li><a href="#">Image frames &amp; gallery</a></li>
                        <li><a href="#">Google Maps</a></li>
                        <li><a href="#">Accordion and Toggles</a></li>
                        <li class="is-active"><a href="#">Custom callout box</a></li>
                        <li><a href="#">Page section</a></li>
                        <li><a href="#">Mini callout box</a></li>
                        <li><a href="#">Content box</a></li>
                        <li><a href="#">Computer sliders</a></li>
                        <li><a href="#">Pricing &amp; Data tables</a></li>
                        <li><a href="#">Process Builders</a></li>
                    </ul>
                </div>
                <div class="col-sm-9">
                    <div class="beta-products-list">
                        <h4>New Products</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">{{count($new_products) }} styles found</p>
                            <div class="clearfix"></div>
                        </div>

                        <div class="row">
                            @php $stt=0; @endphp
                                @foreach($new_products as $new_product)
                                @php $stt++; @endphp
                            <div class="col-sm-4">
                                <div class="single-item">
                                    @if($new_product->promotion_price!=0)
                                        <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                        @endif
                                    <div class="single-item-header">
                                        <a href="{{ route('page.product', ['id' => $new_product->id]) }}">
                                            <img src="../source/image/product/{{ $new_product->image }}" height="200px" alt="{{ $new_product->name }}">
                                        </a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">{{ $new_product->name }}</p>
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
                                        <a class="add-to-cart pull-left" href="{{ route('page.addtocart', ['id' => $new_product->id]) }}">
                                            <i class="fa fa-shopping-cart"></i>
                                        </a>
                                        <a class="beta-btn primary" href="{{ route('page.product', ['id' => $new_product->id]) }}">Details <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            @if($stt % 3==0)
                                <div class="space40">&nbsp;</div>
                                @endif
                            @endforeach
                        </div>
                        
                        
                    </div> <!-- .beta-products-list -->

                    <div class="space50">&nbsp;</div>

                    <div class="beta-products-list">
                        <h4>Top Products</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">{{count($products)}} styles found</p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            @php $stt=0; @endphp
                                @foreach($products as $product)
                                @php $stt++; @endphp
                            <div class="col-sm-4">
                                <div class="single-item">
                                    @if($product->promotion_price!=0)
                                        <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                        @endif
                                    <div class="single-item-header">
                                        <a href="{{ route('page.product', ['id' => $product->id]) }}">
                                            <img src="../source/image/product/{{ $product->image }}" height="200px" alt="{{ $product->name }}">
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
                                        <a class="add-to-cart pull-left" href="{{ route('page.addtocart', ['id' => $product->id]) }}">
                                            <i class="fa fa-shopping-cart"></i>
                                        </a>
                                        <a class="beta-btn primary" href="{{ route('page.product', ['id' => $product->id]) }}">Details <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            @if($stt % 3==0)
                                <div class="space40">&nbsp;</div>
                                @endif
                            @endforeach
                        </div>
                        {{ $products->links() }}
                        <div class="space40">&nbsp;</div>
                        
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
