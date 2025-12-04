<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'MainController@home');

Route::get('/dashboard', 'MainController@dashboard');

Route::get('/login', 'MainController@login');

Route::post('/login', 'MainController@validatelogin');

Route::get('/logout', 'MainController@logout');

Route::get('/registeradmin', 'MainController@register');

Route::post('/registeradmin', 'MainController@storeadmin');

Route::get('/addcustomer', 'MainController@addcustomer');

Route::post('/addcustomer', 'MainController@storecustomer');

Route::get('/editcustomer/{id}', 'MainController@editcustomer');

Route::post('/editcustomer', 'MainController@validatededitcustomer');

Route::get('/customerlist', 'MainController@customerlist');

Route::get('customer', 'MainController@getcustomerlist')->name('customerlist.index');

Route::get('getcustomers', 'MainController@getcustomers');

Route::get('getcustomersname', 'MainController@getcustomersname');

Route::get('/addbrand', 'MainController@addbrand');

Route::post('/addbrand', 'MainController@storebrand');

Route::get('/editbrand/{id}', 'MainController@editbrand');

Route::post('/editbrand', 'MainController@validatededitbrand');

Route::get('/brandlist', 'MainController@brandlist');

Route::get('brand', 'MainController@getbrandlist')->name('brandlist.index');

Route::get('getbrands', 'MainController@getbrands');

Route::get('/addcategory', 'MainController@addcategory');

Route::post('/addcategory', 'MainController@storecategory');

Route::get('/editcategory/{id}', 'MainController@editcategory');

Route::post('/editcategory', 'MainController@validatededitcategory');

Route::get('/categorylist', 'MainController@categorylist');

Route::get('category', 'MainController@getcategorylist')->name('categorylist.index');

Route::get('getcategories', 'MainController@getcategories');

Route::get('/additem', 'MainController@additem');

Route::post('/additem', 'MainController@storeitem');

Route::get('/itemlist', 'MainController@itemlist');

Route::get('item', 'MainController@getitemlist')->name('itemlist.index');

Route::get('getitems', 'MainController@getitems');

Route::get('getitemprices', 'MainController@getitemprices');

Route::get('/edititem/{id}', 'MainController@edititem');

Route::post('/edititem', 'MainController@validateedititem');

Route::get('/addtransaction', 'MainController@addtransaction');

Route::post('/addtransaction', 'MainController@storetransaction');

Route::get('/transactionlist', 'MainController@transactionlist');

Route::get('transaction', 'MainController@gettransactionlist')->name('transactionlist.index');

Route::get('/detailtransaction/{id}', 'MainController@gettransactiondetail');

Route::get('/edittransaction/{id}', 'MainController@edittransactiondetail');

Route::post('/edittransactiondetail', 'MainController@edittransaction');

Route::post('/deletetransactiondetail', 'MainController@deletetransactiondetail');

Route::post('/adddetailtransaction', 'MainController@adddetailtransaction');

Route::get('/invoice/{id}', 'MainController@getinvoice');

Route::get('/addpurchase', 'MainController@addpurchase');

Route::post('/addpurchase', 'MainController@storepurchase');

Route::get('/purchaselist', 'MainController@purchaselist');

Route::get('purchase', 'MainController@getpurchaselist')->name('purchaselist.index');

Route::get('/detailpurchase/{id}', 'MainController@getpurchasedetail');

Route::get('/statusupdatepurchasedetail/{id}/{item_id}', 'MainController@statusupdatepurchasedetail');

Route::get('/purchasecompletelist', 'MainController@purchasecompletelist');

Route::get('purchasecomplete', 'MainController@getpurchasecompletelist')->name('purchasecompletelist.index');

Route::get('/yearlyreport', 'MainController@yearlyreport');

// Route::post('/yearlyreport', 'MainController@monthlyreportgraph');