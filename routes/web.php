<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartegoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\TypeProductController;
use App\Http\Controllers\CouponController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/text', function () {return "Hello";})->name('text');
Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/product/{id}', [PageController::class, 'show'])->name('page.product');
Route::get('/product/{id}/favorite', [PageController::class, 'addToFavorite'])->name('product.favorite');
Route::delete('/favorites/remove/{id}', [PageController::class, 'removeFavorite'])->name('favorites.remove');
Route::get('/favorites', [PageController::class, 'getFavorites'])->name('getFavorites');
Route::get('/del-cart/{id}',[PageController::class,'delCartItem'])->name('page.xoagiohang');
Route::get('/checkout', function () {return view('page.checkout');});
Route::get('/cart',[PageController::class,'shopping_cart'])->name('page.shopping_cart');

Route::get('/add-to-cart/{id}',[PageController::class,'addToCart'])->name('page.addtocart');
Route::post('/update-cart', [PageController::class,'updateCart'])->name('cart.update');
Route::put('/cart/update/{productId}', [PageController::class,'updateQuantity'])->name('cart.updateQuantity');
Route::post('/apply/coupon', [PageController::class, 'apply'])->name('apply.coupon');

Route::get('/checkout/{total}',[PageController::class,'getCheckout'])->name('page.getdathang');
Route::post('/checkout',[PageController::class,'postCheckout'])->name('page.postdathang');
Route::get('/sign-up',[PageController::class,'getSignin'])->name('getsignin');
Route::post('/sign-up',[PageController::class,'postSignin'])->name('postsignin');
Route::get('/login',[PageController::class,'getLoginUser'])->name('getlogin');
Route::post('/login',[PageController::class,'postLoginUser'])->name('postlogin');
Route::get('/logout',[PageController::class,'getLogout'])->name('getlogout');
Route::get('/contacts',[PageController::class,'getContact'])->name('getContact');
Route::post('/contacts',[PageController::class,'postContact'])->name('postContact');
Route::get('/product_type/{cartegory}', [PageController::class,'getTypeByCartegory'])->name('getTypeCartegory');
Route::get('/products/{type}', [PageController::class,'showProductsByType'])->name('products.by.type');
Route::get('/search', [PageController::class, 'search'])->name('search.products');


//Route::get('/order-management', function () {return view('page.account.order_management');});
Route::get('/order-management',[PageController::class,'getOrderManagement'])->name('getOrderManagement');
//Route::get('/personal-information', function () {return view('page.account.personal_information');});
Route::get('/personal-information',[PageController::class,'getPersonalInformation'])->name('getPersonalInformation');
Route::put('/personal-information', [PageController::class, 'postUpdatePersonalInformation'])->name('postUpdatePersonalInformation');
Route::get('/change-password',[PageController::class,'getChangePassword'])->name('getChangePassword');
Route::put('/change-password', [PageController::class, 'postChangePassword'])->name('postChangePassword');

Route::get('/my-orders/{status?}', [PageController::class, 'showOrders'])->name('my.orders');

Route::get('/orders/{id}', [PageController::class, 'showDetailOrder'])->name('order.showDetailOrder');
Route::get('/order/cancel/{id}',[PageController::class, 'cancel'])->name('order.cancel');
Route::get('/order/request-cancel/{id}',[PageController::class, 'requestCancel'])->name('order.requestCancel');
Route::get('/order/cancel-request/{id}', [PageController::class, 'cancelRequest'])->name('order.cancelRequest');








// Route::get('cars/{id}',[CarController::class,'show'])->name('car-show');
// Route::get('/admin/login', function () {return view('admin.login');});
// Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
Route::get('/admin',[UserController::class,'getLogin'])->name('admin.getLogin');
Route::get('/admin/dangnhap',[UserController::class,'getLogin'])->name('admin.getLogin');
Route::post('/admin/dangnhap',[UserController::class,'postLogin'])->name('admin.postLogin');
Route::get('/admin/dangxuat',[UserController::class,'getLogout'])->name('admin.getLogout');;
Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){  
        // admin/category/danhsach
        Route::group(['prefix' => '/cartegory'], function () {
          Route::get('/danhsach',[CartegoryController::class,'getCateList'])->name('admin.getCateList');
          Route::get('/them',[CartegoryController::class,'getCateAdd'])->name('admin.getCateAdd');
          Route::post('/them',[CartegoryController::class,'postCateAdd'])->name('admin.postCateAdd');
          Route::delete('/xoa/{id}',[CartegoryController::class,'getCateDelete'])->name('admin.getCateDelete');
          Route::get('/sua/{id}',[CartegoryController::class,'getCateEdit'])->name('admin.getCateEdit');
          Route::put('/sua/{id}',[CartegoryController::class,'postCateEdit'])->name('admin.postCateEdit');
          
      });
         // admin/category/danhsach
      Route::group(['prefix' => '/type-product'], function () {
         Route::get('/danhsach',[TypeProductController::class,'getTypeList'])->name('admin.getTypeList');
         Route::get('/them',[TypeProductController::class,'getTypeAdd'])->name('admin.getTypeAdd');
         Route::post('/them',[TypeProductController::class,'postTypeAdd'])->name('admin.postTypeAdd');
         Route::delete('/xoa/{id}',[TypeProductController::class,'getTypeDelete'])->name('admin.getTypeDelete');
         Route::get('/sua/{id}',[TypeProductController::class,'getTypeEdit'])->name('admin.getTypeEdit');
         Route::put('/sua/{id}',[TypeProductController::class,'postTypeEdit'])->name('admin.postTypeEdit');
         
     });
     Route::group(['prefix' => '/product'], function () {
          // Product
          Route::get('/danhsach',[ProductController::class,'getProductList'])->name('admin.getProductList');
          Route::get('/them',[ProductController::class,'getProductAdd'])->name('admin.getProductAdd');
          Route::post('/them',[ProductController::class,'postProductAdd'])->name('admin.postProductAdd');
          Route::delete('/xoa/{id}',[ProductController::class,'getProductDelete'])->name('admin.getProductDelete');
          Route::get('/sua/{id}',[ProductController::class,'getProductEdit'])->name('admin.getProductEdit');
          Route::put('/sua/{id}',[ProductController::class,'postProductEdit'])->name('admin.postProductEdit');
     });
     Route::group(['prefix' => '/user'], function () {
          // Product
          Route::get('/danhsach',[UserController::class,'getUserList'])->name('admin.getUserList');
          Route::get('/them',[UserController::class,'getUserAdd'])->name('admin.getUserAdd');
          Route::post('/them',[UserController::class,'postUserAdd'])->name('admin.postUserAdd');
          Route::delete('/xoa/{id}',[UserController::class,'getUserDelete'])->name('admin.getUserDelete');
          Route::get('/sua/{id}',[UserController::class,'getUserEdit'])->name('admin.getUserEdit');
          Route::put('/sua/{id}',[UserController::class,'postUserEdit'])->name('admin.postUserEdit');
     });
     Route::group(['prefix' => '/contact'], function () {
          // Product
          Route::get('/danhsach/not-viewed',[ContactController::class,'getContactNotViewed'])->name('admin.getContactNotViewed');
          Route::get('/danhsach/viewed',[ContactController::class,'getContactViewed'])->name('admin.getContactViewed');
          Route::get('/danhsach/replied',[ContactController::class,'getContactReplied'])->name('admin.getContactReplied');
          Route::get('/danhsach/{id}', [ContactController::class,'showMessage'])->name('admin.show-contact');
          Route::post('/danhsach/{id}/send-response', [ContactController::class,'sendResponse'])->name('admin.send_response');
          Route::get('/them',[ContactController::class,'getUserAdd'])->name('admin.getContactAdd');
          Route::post('/them',[ContactController::class,'postUserAdd'])->name('admin.postContactAdd');
          Route::delete('/xoa/{id}',[ContactController::class,'getUserDelete'])->name('admin.getContactDelete');
          // Route::get('/sua/{id}',[ContactController::class,'getUserEdit'])->name('admin.getUserEdit');
          // Route::put('/sua/{id}',[ContactController::class,'postUserEdit'])->name('admin.postUserEdit');
     });
     Route::group(['prefix' => '/bill'], function () {
          // Product
          // Route::get('/danhsach',[BillController::class,'getBillList'])->name('admin.getBillList');
          Route::get('/danhsach/{status}', [BillController::class, 'getBillList'])->name('admin.bills.status');
          Route::get('/chitiet/{id}',[BillController::class,'getBillDetail'])->name('admin.getBillDetail');
          Route::put('/{id}/update-status/{newStatus}', [BillController::class, 'updateStatus'])->name('admin.bills.updateStatus');
          Route::get('/edit/{id}', [BillController::class,'edit'])->name('admin.edit');
          Route::put('/update/{id}', [BillController::class,'update'])->name('admin.update');
          Route::get('/bill-detail/edit/{id}',[BillController::class,'editBillDetail'])->name('admin.editBillDetail');
          Route::put('/bill-detail/update/{id}', [BillController::class,'updateBillDetail'])->name('admin.updateBillDetail');

          // Route::get('/sua/{id}',[ContactController::class,'getUserEdit'])->name('admin.getUserEdit');
          // Route::put('/sua/{id}',[ContactController::class,'postUserEdit'])->name('admin.postUserEdit');
     });
     Route::group(['prefix' => '/slide'], function () {
          
          Route::resource('/slides', SlideController::class);
       
     });
     Route::group(['prefix' => '/coupon'], function () {
          
          Route::get('/danhsach', [CouponController::class,'index'])->name('admin.coupons');
          Route::get('/create', [CouponController::class,'create'])->name('admin.coupons.create');
          Route::post('/store', [CouponController::class,'store'])->name('admin.coupons.store');
          Route::delete('/delete/{id}', [CouponController::class,'destroy'])->name('admin.coupons.delete');
          
       
     });
     
});
Route::get('/input-email',[PageController::class,'getInputEmail'])->name('getInputEmail');
Route::post('/input-email',[PageController::class,'postInputEmail'])->name('postInputEmail');
//viết tiếp các route khác cho crud products, users,.... thì viết tiếp

// Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function () {
    
//     // Routes for categories
//     Route::group(['prefix' => 'category'], function () {
//         Route::get('/danhsach', [CartegoryController::class, 'getCateList'])->name('admin.getCateList');
//         // Thêm các route CRUD khác cho categories ở đây nếu cần
//     });

//     // Routes for products
//     Route::group(['prefix' => 'product'], function () {
//         // Route::get('/danhsach', [ProductController::class, 'getProductList'])->name('admin.getProductList');
//         // Thêm các route CRUD cho products ở đây nếu cần
//     });

//     // Routes for users
//     Route::group(['prefix' => 'user'], function () {
//         // Route::get('/danhsach', [UserController::class, 'getUserList'])->name('admin.getUserList');
//         // Thêm các route CRUD cho users ở đây nếu cần
//     });

//     // Các route CRUD khác có thể được thêm ở đây cho các tài nguyên khác

// });


//  Route::get('/admin/danhsach',[CartegoryController::class,'getCateList'])->name('admin.getCateList');

// Route::get('car/create', [CarController::class, 'create'])->name('create');
// Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
// Route::get('/cars/{id}/edit', [CarController::class, 'edit'])->name('cars.edit');

// // Route cho phương thức update
// Route::put('/cars/{id}', [CarController::class, 'update'])->name('cars.update');

// Route::delete('/cars/{id}', [CarController::class, 'destroy'])->name('cars.destroy');
// Route::resource('cars',CarController::class);