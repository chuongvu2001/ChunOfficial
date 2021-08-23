<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryNewController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\NewController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\VerifyEmailController;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('admin', function () {
//    if(auth()->user()->role->assignRole('admin'));
    if(auth()->user()->role == 100){
        $user =  auth()->user();
        $user->assignRole('admin');
        $user->givePermissionTo('admin public');
//        $role = \Spatie\Permission\Models\Role::findByName('admin');
//        $role->givePermissionTo('admin public');
    }
    else if(auth()->user()->role == 10){
        $user =  auth()->user();
        $user->assignRole('user');
    }
    else{
        auth()->user()->removeRole('user');
//        return redirect()->back();
    }
});

Route::get('db',function (){
    return "abc";
})->middleware('role_or_permission:user|admin public');

Route::view('login/admin', 'auth.login')->name('login.admin');
Route::post('login/admin', [LoginController::class, 'postLogin']);
Route::any('logout', function(){
    Auth::logout();
    return redirect(route('login.admin'));
})->name('logout');

//member
Route::view('login/member','frontend.login-member');
Route::prefix('login/member')->middleware('auth-verify')->group(function(){
    Route::post('/',[LoginController::class,'postMember'])->name('login.member');
});
Route::any('logout/member', function(){
    session()->forget('cart');
    session()->forget('auth');
    session()->forget('voucher');
    session()->forget('ship-cod');
    return redirect(url('login/member'));
})->name('logout/member');

Route::view('forgot/member', 'frontend.forgot')->name('forgot.member');
Route::post('forgot/member',[LoginController::class,'forgotPassword'])->name('post.forgot');
Route::get('reset-password/{email}/{token}',[LoginController::class,'getPassword']);
Route::post('reset-password',[LoginController::class,'updatePassword']);

Route::get('register/member',[LoginController::class,'formRegister']);
Route::post('check-email',[LoginController::class,'CheckEmail']);
//Auth::routes(['verify'=>true]);
Route::post('register/member',[LoginController::class,'Register']);
Route::get('register/verify/{code}', [LoginController::class,'verify']);
Route::post('authenticate',[LoginController::class,'authenticate']);


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::view('forgot','auth.forgot')->name('forgot');
Route::post('forgot',[LoginController::class,'forgotPassword']);
Route::get('reset-password/{token}',[LoginController::class,'getPassword']);
Route::post('reset-password',[LoginController::class,'updatePassword']);

Route::prefix('admin/danh-muc')->middleware('role_or_permission:user|admin public')->group(function(){
    Route::get('/',[CategoryController::class,'index']);
    Route::get('/child/{id}',[CategoryController::class,'show']);
    Route::get('/add',[CategoryController::class,'create']);
    Route::post('/addSubmit',[CategoryController::class,'store'])->name('cate.name');
    Route::get('/edit/{id}',[CategoryController::class,'edit']);
    Route::post('/edit/editSubmit/{id}',[CategoryController::class,'update']);
    Route::get('xoastatus/{id}',[CategoryController::class,'xoaStatus']);
    Route::get('editstatus/{id}',[CategoryController::class,'editStatus']);
    Route::get('remove/{id}',[CategoryController::class, 'destroy'])->name('cate.remove');
});
Route::prefix('admin/san-pham')->middleware('role_or_permission:user|admin public')->group(function (){
    Route::get('/',[ProductController::class,'index']);
    Route::get('/add',[ProductController::class,'create']);
    Route::post('/add',[ProductController::class,'store'])->name('products.add');
    Route::get('/edit/{id}',[ProductController::class,'edit']);
    Route::post('/edit/{id}',[ProductController::class,'update'])->name('products.edit');
    Route::post('/upload',[ProductController::class,'uploadImage']);
    Route::get('/show',[ProductController::class,'show']);
    Route::get('/chi-tiet/{id}',[ProductController::class,'detail']);
    Route::get('/xoa-status/{id}',[ProductController::class,'xoaStatus']);
    Route::get('/edit-status/{id}',[ProductController::class,'editStatus']);
    Route::post('/options',[ProductController::class,'options']);
    Route::get('success',[ProductController::class,'success']);
    Route::get('xoa',[ProductController::class,'xoa']);
    Route::get('/delete',[ProductController::class,'destroy']);
});
Route::prefix('admin/thong-so')->middleware('role_or_permission:user|admin public')->group(function (){
    Route::get('/',[ParamController::class,'index']);
});
Route::prefix('admin/ky-thuat')->middleware('role_or_permission:user|admin public')->group(function (){
    Route::get('/',[SkillController::class,'index']);
});
Route::prefix('admin/binh-luan')->middleware('role_or_permission:user|admin public')->group(function (){
    Route::get('/',[CommentController::class,'index']);
    Route::get('/reply/{id}',[CommentController::class,'reply']);
});
Route::prefix('admin/ghi-chu')->middleware('role_or_permission:user|admin public')->group(function (){
    Route::get('/',[NoteController::class,'index']);
    Route::get('favourite',[NoteController::class,'Favourite']);
    Route::get('tags',[NoteController::class,'tags']);
    Route::get('delete',[NoteController::class,'destroy']);
    Route::get('status',[NoteController::class,'status']);
    Route::post('add-note',[NoteController::class,'store']);
});

Route::prefix('admin/voucher')->middleware('role_or_permission:user|admin public')->group(function (){
    Route::get('/',[VoucherController::class,'index']);
    Route::get('show/{id}',[VoucherController::class,'show']);

});

Route::prefix('admin/tai-khoan')->middleware('role_or_permission:admin|admin public')->group(function (){
    Route::get('/',[UserController::class,'index']);
    Route::get('/remove/{id}',[UserController::class,'destroy']);
    Route::get('/add',[UserController::class,'create']);
    Route::post('/add',[UserController::class,'store'])->name('users.add');
});

Route::prefix('admin/chuyen-muc')->middleware('role_or_permission:user|admin public')->group(function(){
    Route::get('/',[CategoryNewController::class,'index']);
    Route::get('/add',[CategoryNewController::class,'create']);
    Route::get('/child/{id}',[CategoryNewController::class,'show']);
    Route::post('/addSubmit',[CategoryNewController::class,'store'])->name('catenew.name');
    Route::get('/edit/{id}',[CategoryNewController::class,'edit']);
    Route::post('/edit/{id}',[CategoryNewController::class,'update']);
    Route::get('xoastatus/{id}',[CategoryNewController::class,'xoaStatus']);
    Route::get('editstatus/{id}',[CategoryNewController::class,'editStatus']);
    Route::get('remove/{id}',[CategoryNewController::class, 'destroy'])->name('cate.remove');
});

//News

Route::prefix('admin/tin-tuc')->middleware('role_or_permission:user|admin public')->group(function (){
    Route::get('/',[NewController::class,'index']);
    Route::get('add',[NewController::class,'create']);
    Route::post('/add',[NewController::class,'store'])->name('news.add');
    Route::get('/edit/{id}',[NewController::class,'edit']);
    Route::post('/edit/{id}',[NewController::class,'update']);
    Route::get('/remove/{id}',[NewController::class,'destroy']);
});


Route::prefix('admin/hoa-don')->middleware('role_or_permission:user|admin public')->group(function (){
    Route::get('/',[InvoiceController::class,'index']);
    Route::get('show/{id}',[InvoiceController::class,'show']);
    Route::get('add',[InvoiceController::class,'create']);
//    Route::post('/add',[NewController::class,'store'])->name('news.add');
//    Route::get('/edit/{id}',[NewController::class,'edit']);
//    Route::post('/edit/{id}',[NewController::class,'update']);
//    Route::get('/remove/{id}',[NewController::class,'destroy']);
});



Route::get('/',[HomeController::class,'index']);
Route::get('/product/{slug}/{id}',[HomeController::class,'productDetail']);
Route::get('options',[HomeController::class,'Options']);

//Route::get('/home',[LoginController::class,'Home']);

Route::get('add/to/cart',[HomeController::class,'Cart']);
Route::get('cart',[HomeController::class,'showCart']);
Route::get('up/amount',[HomeController::class,'UpAmount']);
Route::get('down/amount',[HomeController::class,'DownAmount']);

Route::get('up/qty',[HomeController::class,'UpQty']);
Route::get('down/qty',[HomeController::class,'DownQty']);

Route::get('remove/{id}',[HomeController::class,'RemoveCart']);
Route::any('delete/cart',function (){
    session()->forget('cart');
    session()->forget('voucher');
    session()->forget('ship-cod');
    return redirect(url('cart'));
});
Route::get('checkout',[HomeController::class,'CheckOut'])->middleware('auth-verify');
Route::get('checkout/verify',[HomeController::class,'CheckOutVerify']);
Route::post('submit-checkout',[HomeController::class,'submitCheckout']);
Route::get('open/modal',[HomeController::class,'openModal']);
Auth::routes();


// address

Route::get('city/town',[HomeController::class,'Town']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('check-voucher',[HomeController::class,'CheckVoucher']);
Route::get('check-address',[HomeController::class,'CheckAddress']);



//checkout

Route::get('execute-payment',[PaymentController::class,'execute']);

Route::get('{slug}.html',[HomeController::class,'ProductSidebar']);
Route::get('{slug}/{id}.html',[HomeController::class,'ProductCategorySidebar']);

Route::get('/news/{slug}/{id}',[HomeController::class,'newDetail']);

//filter-order

Route::get('order/by',[HomeController::class,'filterOrder']);
Route::get('range/price',[HomeController::class,'RangePrice']);
Route::get('color/filter',[HomeController::class,'ColorFilter']);
Route::get('brand/filter',[HomeController::class,'BrandFilter']);

Route::get('staff/register/verify/{code}', [UserController::class,'verify']);
Route::post('staff/authenticate',[UserController::class,'authenticate']);

Route::get('checkout/verify/customer/{code}', [HomeController::class,'verifyCustomer']);

//Route::get('test',function (){
//    return view('email.checkout-verify');
//});


//Route::get('create_paypal_plan',[PaymentController::class,'create_plan']);

//Route::get('/subscribe/paypal', [PaymentController::class,'paypalRedirect'])->name('paypal.redirect');
//Route::get('/subscribe/paypal/return',[PaymentController::class,'paypalReturn'])->name('paypal.return');

//
