<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\Type;
use App\Models\Contact;
use Illuminate\View\View;
use App\Models\Cart;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

   
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        //Paginator::useBootstrapFour();
         //chia sẻ biến $producttypes cho các view header.blade.php và loaisp.blade.php
         Facades\View::composer(['layout.header'], function (View $view) {
            $producttypes=Type::all();
            //truyền biến $producttypes cho view header thông qua biến $view
            $view->with('producttypes',$producttypes);
        });
        //
         //chia sẻ biến Session('cart') cho các view header.blade.php và checkout.php
         Facades\View::composer(['layout.header','page.checkout','page.shopping_cart'], function (View $view) {
            if(Session('cart')){
                $oldCart=Session::get('cart'); //session cart được tạo trong method addToCart của PageController
                $cart=new Cart($oldCart);
                $view->with(['cart'=>Session::get('cart'),'productCarts'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            }
        });
        Facades\View::composer('admin.master', function ($view) {
            $notViewedCount = Contact::where('status', 'Not Viewed')->count();
            $viewedCount = Contact::where('status', 'Viewed')->count();
            $repliedCount = Contact::where('status', 'Replied')->count();

            $view->with('notViewedCount', $notViewedCount);
            $view->with('viewedCount', $viewedCount);
            $view->with('repliedCount', $repliedCount);
        });
    }
}
