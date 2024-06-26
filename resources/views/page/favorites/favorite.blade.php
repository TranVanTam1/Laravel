@extends('layout.master')

@section('content')

<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Favorites</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="/">Home</a> / <span>Favorites</span>
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
                @if($favorites->isEmpty())
                    <div class="col-sm-12">
                        <p>You haven't added any products to your favorites yet.</p>
                    </div>
                @else
                    @foreach($favorites as $favorite)
                        <div class="col-sm-3">
                            <div class="single-item">
                                @if($favorite->product->promotion_price != 0)
                                    <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                @endif
                                <div class="single-item-header">
                                    <a href="product.html"><img src="../source/image/product/{{$favorite->product->image}}" alt="" height="250px"></a>
                                </div>
                                <div class="single-item-body">
                                    <p class="single-item-title">{{$favorite->product->name}}</p>
                                    <p class="single-item-price" style="font-size: 15px; font-weight: bold;">
                                        @if($favorite->product->promotion_price==0)
                                            <span class="flash-sale">{{ number_format($favorite->product->unit_price) }} đồng</span>
                                        @else
                                            <span class="flash-del">{{ number_format($favorite->product->unit_price) }} đồng</span>
                                            <span class="flash-sale">{{ number_format($favorite->product->promotion_price) }} đồng</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="single-item-caption">
                                    @if(Auth::check())
                                    <a href="{{ route('favorites.remove', ['id' => $favorite->id]) }}" onclick="event.preventDefault(); document.getElementById('remove-favorite-form-{{ $favorite->id }}').submit();">
                                        Bỏ yêu thích
                                    </a>
                                    <form id="remove-favorite-form-{{ $favorite->id }}" action="{{ route('favorites.remove', ['id' => $favorite->id]) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form> <br><br>
                                    @endif
                                    <a class="add-to-cart pull-left" href="{{ route('page.addtocart',$favorite->product->id) }}"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="beta-btn primary" href="{{route('page.product',['id'=>$favorite->product->id] ) }}">Chi tiết <i class="fa fa-chevron-right"></i></a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        @if($loop->iteration % 4 == 0)
                            <div class="space40">&nbsp;</div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
