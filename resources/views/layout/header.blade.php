

<div id="header">
    <div class="header-top">
        <div class="container">
            <div class="pull-left auto-width-left">
                <ul class="top-menu menu-beta l-inline">
                    <li><a href=""><i class="fa fa-home"></i> Cách Mạng Tháng 8, Cẩm Lệ, Đà Nẵng</a></li>
                    <li><a href=""><i class="fa fa-phone"></i> 0332541965</a></li>
                </ul>
            </div>
            <div class="pull-right auto-width-right">
                <ul class="top-details menu-beta l-inline">
                    @if (auth()->check())
                        <li><a href="{{ route('getPersonalInformation') }}"><i class="fa fa-user"></i>Tài khoản</a></li>
                    @endif
                
                    @if(Auth::check())
                        <li><a href="#"><i class="fa fa-user"></i>Chào bạn {{ Auth::user()->full_name }}</a></li>
                        <li><a href="{{ route('getlogout') }} "><i class="fa fa-user"></i>Đăng xuất</a></li>
                    @else
                        <li><a href="{{ route('getsignin') }}">Đăng kí</a></li>
                        <li><a href="{{ route('getlogin') }}">Đăng nhập</a></li>
                    @endif
                </ul>
            </div>

            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-top -->
    <div class="header-body">
        <div class="container beta-relative">
            <div class="pull-left">
                <a href="index.html" id="logo"><img src="/images/mm-logo.png" width="200px" alt=""></a>
            </div>
            <div class="pull-right beta-components space-left ov">
                <div class="space10">&nbsp;</div>
                <div class="beta-comp">
                    <form role="search" method="get" id="searchform" action="{{ route('search.products') }}">
                        <input type="text"  name="q" id="q" placeholder="Nhập từ khóa..." />
                        <button type="submit" id="searchsubmit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                    
                </div>

                <div class="beta-comp">
                   
                    <div class="cart">
                        <div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng 
                            (@if(Session::has('cart')){{ Session('cart')->totalQty }}
                            @else Trống 
                            @endif)
                        
                             <i class="fa fa-chevron-down"></i>
                        </div>
                        @if(Session::has('cart'))
                            <div class="beta-dropdown cart-body">
                                @foreach($productCarts as $product)
                                <div class="cart-item">
                                    <a class="cart-item-delete" href="{{ route('page.xoagiohang',$product['item']['id']) }}"><i class="fa fa-times"></i>
                                        {{-- {{ route('banhang.xoagiohang',$product['item']['id']) }} --}}
                                    </a>
                                    <div class="media">
                                        <a class="pull-left" href="#"><img src="/source/image/product/{{ $product['item']['image'] }}" alt=""></a>
                                        <div class="media-body">
                                            <span class="cart-item-title">{{ $product['item']['name'] }}</span>
                                            <span class="cart-item-amount">{{ $product['qty'] }}*<span>
                                                @if($product['item']['promotion_price']==0)
                                                {{ number_format($product['item']['unit_price']) }}@else
                                                {{ number_format($product['item']['promotion_price']) }}
                                                @endif
                                            </span></span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                <div class="cart-caption">
                                    <div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">{{ number_format($cart->totalPrice) }}</span></div>
                                    <div class="clearfix"></div>

                                    <div class="center">
                                        <div class="space10">&nbsp;</div>
                                        <a href="{{route('page.shopping_cart')}}" class="beta-btn primary text-center">Giỏ hàng <i class="fa fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                    </div> <!-- .cart -->
                    @endif
                </div>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-body -->
    
    <div class="header-bottom" style="background-color: #0277b8;">
        <div class="container">
            <a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
            <div class="visible-xs clearfix"></div>
            <nav class="main-menu">
                <ul class="l-inline ov">
                    <li><a href="/">Trang chủ</a></li>
                    <li><a href="#">Sản phẩm</a>
                        <ul class="sub-menu">
                            @isset($cartegorys)
                                @foreach ($cartegorys as $cartegory)
                                    <li><a href="{{ route('getTypeCartegory', ['cartegory' => $cartegory->id]) }}">{{ $cartegory->name }}</a></li>
                                @endforeach
                            @endisset
                        </ul>
                    </li>
                    <li><a href="about.html">Giới thiệu</a></li>
                    <li><a href="{{route('getFavorites')}}">Yêu thích</a></li>

                    <li><a href="{{ route('getContact') }}">Liên hệ</a></li>
                </ul>
                <div class="clearfix"></div>
            </nav>
        </div> <!-- .container -->
    </div> <!-- .header-bottom -->
</div> <!-- #header -->
@if (session('success'))
<div style="text-align: center" class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if (session('message'))
<div style="text-align: center" class="alert alert-danger">
    {{ session('message') }}
</div>
@endif
 