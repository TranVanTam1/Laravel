<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartegoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
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

Route::get('/cart', function () {return view('page.shopping_cart');});
Route::get('/text', function () {return view('page.text');});
Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/product/{id}', [PageController::class, 'show'])->name('page.product');
Route::get('/del-cart/{id}',[PageController::class,'delCartItem'])->name('page.xoagiohang');
Route::get('/checkout', function () {return view('page.checkout');});
Route::get('/add-to-cart/{id}',[PageController::class,'addToCart'])->name('page.addtocart');
Route::get('/checkout',[PageController::class,'getCheckout'])->name('page.getdathang');
Route::post('/checkout',[PageController::class,'postCheckout'])->name('page.postdathang');
Route::get('/sign-up',[PageController::class,'getSignin'])->name('getsignin');
Route::post('/sign-up',[PageController::class,'postSignin'])->name('postsignin');
Route::get('/login',[PageController::class,'getLogin'])->name('getlogin');
Route::post('/login',[PageController::class,'postLogin'])->name('postlogin');
Route::get('/logout',[PageController::class,'getLogout'])->name('getlogout');
Route::get('/contacts',[PageController::class,'getContact'])->name('getContact');
Route::post('/contacts',[PageController::class,'postContact'])->name('postContact');
Route::get('/product_type/{product_type}', [PageController::class,'getProductsByType'])->name('getProductType');
//Route::get('/order-management', function () {return view('page.account.order_management');});
Route::get('/order-management',[PageController::class,'getOrderManagement'])->name('getOrderManagement');
//Route::get('/personal-information', function () {return view('page.account.personal_information');});
Route::get('/personal-information',[PageController::class,'getPersonalInformation'])->name('getPersonalInformation');


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
         Route::get('/xoa/{id}',[CartegoryController::class,'getCateDelete'])->name('admin.getCateDelete');
         Route::get('/sua/{id}',[CartegoryController::class,'getCateEdit'])->name('admin.getCateEdit');
         Route::post('/sua/{id}',[CartegoryController::class,'postCateEdit'])->name('admin.postCateEdit');
         
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