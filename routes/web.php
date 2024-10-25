<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Homecontroller;
use App\Http\Controllers\shopcontroller;
use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\Myorderscontroller;
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


Route::get('/',[Homecontroller::class,'index'])->name('home');
Route::post('/searched_item',[Homecontroller::class,'searched_item']);
Route::get('/admin', [Admincontroller::class,'index'])->name('admin.index');
Route::get('/login', [Homecontroller::class,'index'])->name('login');
Route::post('adminAUTH',[Admincontroller::class,'adminAUTH']);
Route::get('category/{category}',[Homecontroller::class,'category'])->name('category.products');
Route::get('addtocart/{id}',[Homecontroller::class,'addtocart']);
Route::post('/userlogin',[Homecontroller::class,'userlogin']);
Route::get('/userlogin',[Homecontroller::class,'userlogin']);
Route::post('/userlogin2',[Homecontroller::class,'userlogin2']);
Route::get('/logoutuser',[Homecontroller::class,'logout']);
Route::post('/usersignup',[Homecontroller::class,'usersignup']);
Route::post('/usersignup2',[Homecontroller::class,'usersignup2']);
Route::get('/showcart',[Homecontroller::class,'showcart']);
Route::get('removeProduct/{productID}',[Homecontroller::class,'removeProduct'])->name('removeProduct');
Route::post('minusProduct/{productID}',[Homecontroller::class,'minusProduct'])->name('minusProduct');
Route::post('addProduct/{productID}',[Homecontroller::class,'addProduct'])->name('addProduct');
Route::get('/buynow/{productID}',[Homecontroller::class,'buynow'])->name('buynow');
Route::get('/userdetails',[Homecontroller::class,'userdetails'])->name('userdetails');
Route::post('/userdetailsform',[Homecontroller::class,'userdetailsform'])->name('userdetailsform');
Route::get('/payment/{total_cost}/{id}',[Homecontroller::class,'payment'])->name('payment');
Route::get('allcartpayment/{totalprice}',[Homecontroller::class,'allcartpayment'])->name('allcartpayment');
Route::get('allcartpaymentfinal/{totalprice}',[Homecontroller::class,'allcartpaymentfinal'])->name('allcartpaymentfinal');
Route::post('/pay/{amount}',[Homecontroller::class,'pay'])->name('pay');
Route::get('/myorders',[Myorderscontroller::class,'index'])->name('myorders');
Route::get('/returnproduct/{productID}',[Myorderscontroller::class,'returnproduct'])->name('returnproduct');
Route::get('/signup', function () {
    return view('signup');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/productdetails/{productid}',[Homecontroller::class,'productdetails']);

Route::get('/test-notification', function () {
    $user = Auth::user(); // Replace with a valid user if necessary
    $details = ['message' => 'Test notification', 'completed_at' => now()];
    
    $user->notify(new \App\Notifications\productsuploaded($details));
    
    return 'Notification sent!';
});

Route::post('/paycart/{amount}',[Homecontroller::class,'paycart']);
Route::get('/shop',[shopcontroller::class,'index']);
Route::get('/dummyorder', function () {
    return view('myordersdummy');
});
// Admin routes
Route::group(['middleware' => 'CheckAdmin', 'namespace' => 'App\Http\Controllers'], function () {
    Route::get('/addproduct',[Admincontroller::class,'addproducts'])->name('addproduct');
    Route::get('/productlisting/{page?}',[Admincontroller::class,'productlisting'])->name('productlisting');
    Route::get('/editproduct/{pid}',[Admincontroller::class,'editproduct'])->name('editproduct');
    Route::get('/deleteproduct/{pid}',[Admincontroller::class,'deleteproduct'])->name('deleteproduct');
    Route::get('/managecategory',[Admincontroller::class,'managecategory'])->name('managecategory');
    Route::post('/addcategory',[Admincontroller::class,'addcategory'])->name('addcategory');
    Route::get('/editcategory/{cid}',[Admincontroller::class,'editcategory'])->name('editcategory');
    Route::post('editcategorybackend',[Admincontroller::class,'editcategorybackend'])->name('editcategorybackend');
    Route::get('deletecategory/{cid}',[Admincontroller::class,'deletecategory'])->name('deletecategory');
    Route::get('deleteproduct/{pid}',[Admincontroller::class,'deleteproduct'])->name('deleteproduct');
    Route::get('editproductpage/{pid}',[Admincontroller::class,'editproductpage'])->name('editproductpage');
    Route::post('updateproduct',[Admincontroller::class,'updateproduct'])->name('updateproduct');
    Route::get('/logoutadmin',[Admincontroller::class,'logout']);
    Route::post('productdata',[Admincontroller::class,'productdata']);
    Route::get('/orders',[Admincontroller::class,'orders']);
    Route::get('/orderdata',[Admincontroller::class,'orderdata']);
    Route::get('/orderdetails',[Admincontroller::class,'orderdetails']);
    Route::get('/acceptorder/{userid}/{productid}',[Admincontroller::class,'acceptorder']);
    Route::get('/declineorder/{userid}/{productid}',[Admincontroller::class,'declineorder']);
    Route::get('/orderdelivered/{userid}/{productid}',[Admincontroller::class,'orderdelivered']);
    Route::post('/updatenewstatus',[Admincontroller::class,'updatenewstatus']);
    Route::get('/bulkupload',[Admincontroller::class,'bulkupload'])->name('bulkupload');
    Route::get('/downloaddemo',[Admincontroller::class,'downloaddemo'])->name('downloaddemo');
    Route::post('/uploadproductexcel',[Admincontroller::class,'uploadproductexcel'])->name('uploadproductexcel');
    Route::get('/batch-progress/{batchId}', [Admincontroller::class, 'showProgress'])->name('batch-progress');
    Route::get('/batch', [Admincontroller::class, 'batch'])->name('batch');
    Route::get('/notify',[Admincontroller::class,'notify'])->name('notify');
    Route::get('/manageadmin/{no?}/{page?}',[Admincontroller::class,'manageadmin'])->name('manageadmin');
    Route::get('/editadmin/{adminid}',[Admincontroller::class,'editadmin'])->name('editadmin');
    Route::post('/editadminbackend',[Admincontroller::class,'editadminbackend'])->name('editadminbackend');
    Route::get('/searchedproduct',[Admincontroller::class,'searchedproduct'])->name('searchedproduct');
    Route::get('/show-chart', [Admincontroller::class, 'showchart']);
    Route::get('/showsales-chart', [Admincontroller::class, 'saleschart']);
    Route::get('/addnewadmin', [Admincontroller::class, 'addnewadmin']);
    Route::post('/newadminbackend', [Admincontroller::class, 'newadminbackend']);
    
    Route::get('/addnewuser', [Admincontroller::class, 'addnewuser']);
    Route::post('/newauserbackend', [Admincontroller::class, 'newauserbackend']);
    Route::get('/editusers/{id}', [Admincontroller::class, 'editusers']);
    Route::post('/editauserbackend', [Admincontroller::class, 'editauserbackend']);
    Route::get('/deleteuser/{userid}', [Admincontroller::class, 'deleteuser']);
    Route::get('/deleteadmin/{userid}', [Admincontroller::class, 'deleteadmin']);
    Route::post('/searchadmin', [Admincontroller::class, 'searchadmin']);
    Route::post('/searchuser', [Admincontroller::class, 'searchuser']);
    Route::get('/showdashboard', [Admincontroller::class, 'showdashboard']);

    
    
    
   

   });





