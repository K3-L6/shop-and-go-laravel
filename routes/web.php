<?php

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

use App\DataTables\UsersDataTable;

Route::get('/', 'WelcomeController@index');
Route::get('/location', 'WelcomeController@location');
Route::get('/aboutus', 'WelcomeController@aboutus');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/2c2p', 'CustomerController@forward2c2p');

//email verification
Route::get('resend/{email}/{verifyToken}', 'Auth\LoginController@resendEmail')->name('resendEmail');

Route::get('verify/{email}/{verifyToken}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');

Route::post('/user/changeinfo/', 'CustomerCOntroller@changeinfo');

Route::post('review/{id}', 'CustomerController@review');

// province city
Route::get('/findCities', 'UserController@findCities');
Route::get('/findmoneytransfers', 'CustomerController@findmoneytransfers');

// socialite facebook
Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');



//user controller
Route::post('/avatar/change', 'UserController@updateAvatar');

//profile
Route::get('/profile', 'CustomerController@profile');
Route::get('/transaction', 'CustomerController@transaction');
Route::get('/transaction/manageorder/{id}', 'CustomerController@manageorder');
Route::post('/transaction/uploadreceipt/{id}', 'CustomerController@uploadreceipt');
Route::post('/transaction/cancelproductrequest/{id}', 'CustomerController@cancelproductrequest');
Route::post('/transaction/returnproductrequest/{id}', 'CustomerController@returnproductrequest');


Route::post('/admin/transaction/order/print/{id}', 'AdminController@printreceipt');
Route::post('/admin/transaction/order/dispatch/{id}', 'AdminController@dispatch');
Route::post('/admin/transaction/order/fulfill/{id}', 'AdminController@fulfill');


Route::get('/admin/transaction/cancelrequest/', 'AdminController@cancelrequest');
Route::get('/admin/transaction/cancelrequest/', 'AdminController@cancelrequest')->name('admin.cancelrequest.api');

Route::get('/admin/transaction/cancelproductrequest/', 'AdminController@cancelproductrequest');
Route::get('api/cancelproductrequest', 'AdminController@cancelproductrequest_api')->name('admin.cancelproductrequest.api');

Route::get('/admin/transaction/returnproductrequest/', 'AdminController@returnproductrequest');
Route::get('api/returnproductrequest', 'AdminController@returnproductrequest_api')->name('admin.returnproductrequest.api');


//product customer

Route::get('/product/single/{id}', 'CustomerController@product_single_display');
Route::get('/product/showcase/{id}', 'CustomerController@product_showcase_display');
Route::post('/product/search', 'CustomerController@product_search');
Route::get('/product/{sort}', 'CustomerController@product_display');




//carts
Route::get('/cart', 'CustomerController@cart');
Route::get('/cart/checkout', 'CustomerController@checkout');
Route::post('/cart/checkout/payment', 'CustomerController@payment');
Route::post('/cart/checkout/payment/postfinish', 'CustomerController@postfinish');

Route::post('/cart/refresh/{id}', 'CustomerController@cartrefresh');
Route::delete('/cart/delete/{id}', 'CustomerController@cartdelete');
Route::post('cart/addtocart/{productid}', 'CustomerController@addtocart');

Route::get('/wishlist', 'CustomerController@wishlist');
Route::post('/wishlist/removewishlist/{id}', 'CustomerController@removewishlist');
Route::post('wishlist/addtowishlist/{productid}', 'CustomerController@addtowishlist');

//admin auth
Route::get('/admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('/admin', 'Admin\LoginController@login');
Route::get('/admin/dashboard', 'AdminController@index');
Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin-password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/reset','Admin\ResetPasswordController@reset');
Route::get('admin-password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');

//transaction

//payment approvals
Route::get('admin/transaction/pending', 'AdminController@pending');
Route::post('admin/transaction/pending/validate/{id}', 'AdminController@pending_validate');
Route::post('admin/transaction/pending/decline/{id}', 'AdminController@pending_decline');
Route::get('api/pending', 'AdminController@pending_api')->name('admin.pending.api');

//order
Route::get('admin/transaction/order', 'AdminController@order');
Route::post('admin/transaction/order/verify/{id}', 'AdminController@order_verify');
Route::delete('admin/transaction/order/delete/{id}', 'AdminController@order_delete');
Route::get('admin/transaction/order/item/{id}', 'AdminController@order_item');
Route::get('/api/order/item/{id}', 'AdminController@order_item_api')->name('admin.order.item.api');
Route::get('/api/order', 'AdminController@order_api')->name('admin.order.api');

Route::post('/admin/transaction/orderitem/refund/{id}', 'AdminController@refund');
Route::post('/admin/transaction/orderitem/return/{id}', 'AdminController@return');
Route::post('/admin/transaction/orderitem/cancel/{id}', 'AdminController@cancel');


// inventory list product movement and order product movement
Route::get('/admin/productinventory/inventorylist', 'AdminController@inventorylist');
Route::get('/api/inventorylist', 'AdminController@inventorylist_api')->name('admin.inventorylist.api');

Route::get('/admin/productinventory/productmovement', 'AdminController@productmovement');
Route::get('/api/productmovement', 'AdminController@productmovement_api')->name('admin.productmovement.api');

Route::get('/admin/productinventory/orderproductmovement', 'AdminController@orderproductmovement');
Route::get('/api/orderproductmovement', 'AdminController@orderproductmovement_api')->name('admin.orderproductmovement.api');

// sales report

Route::get('/admin/salesreport/report1', 'AdminController@report1');
Route::get('api/report1', 'AdminController@report1_api')->name('admin.report1.api');

Route::get('/admin/salesreport/report2', 'AdminController@report2');
Route::get('api/report2', 'AdminController@report2_api')->name('admin.report2.api');

Route::get('/admin/salesreport/report3', 'AdminController@report3');
Route::get('api/report3', 'AdminController@report3_api')->name('admin.report3.api');

Route::get('/admin/salesreport/report4', 'AdminController@report4');
Route::get('api/report4', 'AdminController@report4_api')->name('admin.report4.api');


//user list
Route::get('/admin/customerrelation/user/', 'AdminController@user');
Route::delete('/admin/customerrelation/user/delete/{id}', 'AdminController@user_delete');
Route::get('/api/user/', 'AdminController@user_api')->name('admin.user.api');

//dellivery
Route::get('admin/transaction/delivery', 'AdminController@delivery');
Route::get('admin/transaction/delivery/product/{id}', 'AdminController@delivery_product');
Route::post('admin/transaction/delivery/verify/{id}', 'AdminController@delivery_verify');
Route::delete('admin/transaction/delivery/delete/{id}', 'AdminController@delivery_delete');
Route::get('/api/delivery', 'AdminController@delivery_api')->name('admin.delivery.api');
Route::get('/api/delivery/product/{id}', 'AdminController@delivery_product_api')->name('admin.delivery.product.api');



//admin file maintenance

//subcategory deleted
Route::get('/admin/filemaintenance/subcategory', 'AdminController@subcategory');
Route::get('/admin/filemaintenance/subcategory/create', 'AdminController@subcategory_showcreate');
Route::post('/admin/filemaintenance/subcategory/create', 'AdminController@subcategory_create');
Route::put('/admin/filemaintenance/subcategory/update/{id}', 'AdminController@subcategory_update');
Route::delete('/admin/filemaintenance/subcategory/delete/{id}', 'AdminController@subcategory_delete');
//moneytransfer
Route::get('/admin/filemaintenance/moneytransfer', 'AdminController@moneytransfer');
Route::get('/admin/filemaintenance/moneytransfer/create', 'AdminController@moneytransfer_showcreate');
Route::post('/admin/filemaintenance/moneytransfer/create', 'AdminController@moneytransfer_create');
Route::get('/admin/filemaintenance/moneytransfer/edit/{id}', 'AdminController@moneytransfer_showedit');
Route::put('/admin/filemaintenance/moneytransfer/edit/{id}', 'AdminController@moneytransfer_edit');
Route::delete('/admin/filemaintenance/moneytransfer/delete/{id}', 'AdminController@moneytransfer_delete');
Route::get('/api/moneytransfer', 'AdminController@moneytransfer_api')->name('admin.moneytransfer.api');
//customer
Route::get('/admin/filemaintenance/customer', 'AdminController@customer');
Route::post('/admin/filemaintenance/customer/create', 'AdminController@customer_create');
Route::put('/admin/filemaintenance/customer/update/{id}', 'AdminController@customer_update');
Route::delete('/admin/filemaintenance/customer/delete/{id}', 'AdminController@customer_delete');
//showcase
Route::get('/admin/filemaintenance/showcase', 'AdminController@showcase');
Route::get('/admin/filemaintenance/showcase/create', 'AdminController@showcase_showcreate');
Route::post('/admin/filemaintenance/showcase/create', 'AdminController@showcase_create');

//TODO
Route::get('/admin/filemaintenance/showcase/addproduct/{id}', 'AdminController@showcase_addproduct');
Route::post('/admin/filemaintenance/showcase/addproduct/create/{showcaseid}/{productid}', 'AdminController@showcase_addproduct_create');
Route::delete('/admin/filemaintenance/showcase/addproduct/delete/{id}', 'AdminController@showcase_addproduct_delete');

Route::get('/admin/filemaintenance/showcase/edit/{id}', 'AdminController@showcase_showedit');
Route::put('/admin/filemaintenance/showcase/edit/{id}', 'AdminController@showcase_edit');
Route::delete('/admin/filemaintenance/showcase/delete/{id}', 'AdminController@showcase_delete');
Route::get('/api/showcase', 'AdminController@showcase_api')->name('admin.showcase.api');
Route::get('/api/showcase/item/{id}', 'AdminController@showcase_item_api')->name('admin.showcase.item.api');
Route::get('/api/showcase/product/{id}', 'AdminController@showcase_product_api')->name('admin.showcase.product.api');
//brand
Route::get('/admin/filemaintenance/brand', 'AdminController@brand');
Route::get('/admin/filemaintenance/brand/create', 'AdminController@brand_showcreate');
Route::post('/admin/filemaintenance/brand/create', 'AdminController@brand_create');
Route::get('/admin/filemaintenance/brand/edit/{id}', 'AdminController@brand_showedit');
Route::put('/admin/filemaintenance/brand/edit/{id}', 'AdminController@brand_edit');
Route::delete('/admin/filemaintenance/brand/delete/{id}', 'AdminController@brand_delete');
Route::get('/api/brand', 'AdminController@brand_api')->name('admin.brand.api');
//product
Route::get('/admin/filemaintenance/product', 'AdminController@product');
Route::get('/admin/filemaintenance/product/specification/{id}', 'AdminController@product_specification');
Route::post('/admin/filemaintenance/product/specification/create/{id}', 'AdminController@product_specification_create');
Route::put('/admin/filemaintenance/product/specification/edit/{id}', 'AdminController@product_specification_edit');
Route::delete('/admin/filemaintenance/product/specification/delete/{id}', 'AdminController@product_specification_delete');
Route::get('/admin/filemaintenance/product/specification/api/{id}', 'AdminController@product_specification_api')->name('admin.specification.api');
Route::get('/admin/filemaintenance/product/image/{id}', 'AdminController@product_image');
Route::post('/admin/filemaintenance/product/image/upload/{id}', 'AdminController@product_image_upload');
Route::delete('/admin/filemaintenance/product/image/delete/{id}', 'AdminController@product_image_delete');
Route::get('/admin/filemaintenance/product/edit/{id}', 'AdminController@product_showedit');
Route::put('/admin/filemaintenance/product/edit/{id}', 'AdminController@product_edit');
Route::put('/admin/filemaintenance/product/percentoff/edit/{id}', 'AdminController@product_percentoff_edit');
Route::get('/admin/filemaintenance/product/create', 'AdminController@product_showcreate');
Route::post('/admin/filemaintenance/product/create', 'AdminController@product_create');
Route::post('/admin/filemaintenance/product/replenish/{id}', 'AdminController@product_replenish');
Route::delete('/admin/filemaintenance/product/delete/{id}', 'AdminController@product_delete');
Route::get('/api/product', 'AdminController@product_api')->name('admin.product.api');


Route::get('admin/salesreport/', 'AdminController@salesreport');





