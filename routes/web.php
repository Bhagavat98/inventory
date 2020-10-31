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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');

// multi login
Route::post('/accounts/adminlogin','HomeController@adminUserLogin')->name('account.login');

/******** Accounts **********/
//show
Route::get('/Accounts','AccountsController@index')->name('Accounts');
// get all Accounts
 Route::get('/AllAccounts','AccountsController@GetAllAccounts')->name('AllAccounts');
// // return add Accounts view 
 Route::get('/account/add', function () { return view('addAccount'); })->middleware('checkrole');
// // create Account
 Route::post('/account/create','AccountsController@Create')->name('account.create');
// // Delete Account
 Route::post('/account/delete','AccountsController@AccountDelete')->name('account.delete');

/******* Accounts End *********/


/************ My Profile **************/
/* profile */
// change password view
Route::get('myProfile','HomeController@myProfile')->name('myProfile');
// change Password
Route::post('/updateProfile/{id}','HomeController@updateProfile')->name('updateProfile');


/* Chnage Passsword */

// change password view
Route::get('passwordChange','HomeController@passwordChangeView')->name('passwordReset.view');
// change Password
Route::post('/passwordChange','HomeController@passwordChange')->name('passwordChange');


/* reset Passsword */

// change password view
Route::get('resetPassword','ResetPasswordController@index')->name('resetPassword.view');
// change Password
Route::post('/resetPassword','ResetPasswordController@resetUserPassword')->name('resetPassword');


/************ End Profile **************/




/******** Customer **********/
//show
Route::get('Customer/','CustomerController@index')->name('Customer');
// get all customer
 Route::get('/AllCustomer','CustomerController@GetAllCustomer')->name('AllCustomer');
// // return add customer view 
 Route::get('/customer/add', 'CustomerController@addCustomer')->middleware('auth');
// // create customer
 Route::post('/customer/create','CustomerController@Create')->name('customer.create');
// edit customer view
Route::get('/customer/edit/{id}','CustomerController@edit')->name('edit.create');
// update customer 
Route::post('/customer/update/{id}','CustomerController@update')->name('edit.update');
// // Delete customer
 Route::post('/customer/delete','CustomerController@CustomerDelete')->name('customer.delete');

/******* Customer End *********/




/********* settings *********/
Route::get('/Settings','HomeController@settings')->name('settings');
// recent activity device & sim 
Route::post('/settings/recentactivity','HomeController@recentactivity')->name('settings.recentactivity');


/*********  settings end **********/


/******** Device **********/
//return view device
Route::get('/Device','DeviceController@index')->name('Device');
// import Excel, csv. format
Route::post('/device/import','DeviceController@import')->name('device.import');
// export Excel, csv. format
Route::post('/device/export','DeviceController@export')->name('device.export');
// get all Devices
Route::get('/AllDevices','DeviceController@GetAllDevice')->name('AllDevices');
//  return add device view 
Route::get('/device/add', function () { return '<h3>Working progress</h3>'; })->middleware('auth');
// edit  Devices
Route::post('/device/edit','DeviceController@edit')->name('device.edit');
// // create Account
 Route::post('/account/create','AccountsController@Create')->name('account.create');
//Delete device
Route::post('/device/delete','DeviceController@DeviceDelete')->name('device.delete');
// Device Template Download
Route::get('device/template/download','DeviceController@downloadTemplate')->name('deviceTemplate');

/******* Device End *********/



/******** SIM Start **********/
//return view sim
Route::get('/Sim','SimController@index')->name('Sim');
//imprt sim excel,csv, format 
Route::post('/sim/import','SimController@import')->name('sim.import');
// export Excel, csv. format
Route::post('/sim/export','SimController@export')->name('sim.export');
// get all Devices
Route::get('/AllSim','SimController@GetAllSim')->name('AllSim');
// return add Accounts view 
Route::get('/sim/add', function () { return '<h3>Working progress</h3>'; })->middleware('auth');
// edit  Devices
Route::post('/sim/edit','SimController@edit')->name('sim.edit');
//Delete device
Route::post('/sim/delete','SimController@SimDelete')->name('sim.delete');
// sim Template Download
Route::get('/template/download','SimController@downloadTemplate')->name('simTemplate.download');


/******* Sim End *********/

/******* Other Stock Start *********/
// manage all other stock 
Route::get('/other/stock','OtherStockController@index')->name('other.stock');

//add new stock multiple
Route::get('/add/other/stock','OtherStockController@addStock')->name('otherStock.add');


//add new stock multiple
Route::post('/other/stock/create','OtherStockController@create')->name('otherStock.create');

//filter show date 
Route::post('/other/stock/showFromDate','OtherStockController@showFromDate')->name('otherStock.showFromDate');


// export stock
Route::get('/other/export/{id}','OtherStockController@export');

/******* Other Stock End *********/



/******** SIM expiry/renewal **********/
//return expiry
Route::get('/sim/expiry','SimController@expiry')->name('sim.expiry');
// renewal sim
Route::post('/sim/renewal','SimController@renewal')->name('sim.renewal');
// in-active sim
Route::post('/sim/InActive','SimController@InActive')->name('sim.InActive');

/******* SIM expiry/renewal End *********/


/******** Delivery Challan **********/
//create view delivery Challan
Route::get('/DeliveryChallan','DeliveryChallanController@index')->name('DeliveryChallan');
//create view Delivery Challan Multiple
Route::get('/DeliveryChallanMultiple','DeliveryChallanController@index')->name('DeliveryChallan');

// show delivery Challan
Route::get('/DeliveryChallan/show','DeliveryChallanController@show')->name('deliveryChallan.show');
// show delivery Challan filter
Route::post('/DeliveryChallan/show/fromDate','DeliveryChallanController@showFromDate')->name('deliveryChallan.fromDate');
// dowload delivery Challan
Route::get('/DeliveryChallan/downloadPDF/{id}','DeliveryChallanController@downloadPDF')->name('deliveryChallan.downloadPDF');
// print Challan 
Route::get('/DeliveryChallan/printChallan/{id}','DeliveryChallanController@printChallan')->name('deliveryChallan.printChallan');
// create delivery Challan
Route::post('/DeliveryChallan/create','DeliveryChallanController@create')->name('deliveryChallan.create');


// in-active sim
//Route::post('/sim/InActive','SimController@InActive')->name('sim.InActive');

/******* Delivery Challan End *********/


/******** SIM expiry/renewal **********/
//return expiry
Route::get('/device/expiry','DeviceController@expiry')->name('device.expiry');
// renewal device
Route::post('/device/renewal','DeviceController@renewal')->name('device.renewal');
// in-active device
Route::post('/device/InActive','DeviceController@InActive')->name('device.InActive');
/******* device expiry/renewal End *********/



/******** Barcode Inventory **********/
//barcode inventory show
Route::get('/barcode-inventory/show','BarcodeInventoryController@show')->name('barcode.show');
// show date wise
Route::post('/barcode-inventory/fromDate','BarcodeInventoryController@showFromDate')->name('barcode-inventory.fromDate');
// barcode inventory show
Route::post('/barcode-inventory/add','BarcodeInventoryController@create')->name('barcode-inventory.add');

// barcode inventory to device add stock
Route::post('/add/stock/device','BarcodeInventoryController@addStockDevice')->name('device.addStock');

// barcode inventory to device add stock
Route::get('/addStock','BarcodeInventoryController@addStock')->name('addStock');

// barcode inventory to device add stock o
Route::post('/addStockToDevice','BarcodeInventoryController@addStockToDevice')->name('addStockToDevice');


// barcode inventory to device add stock
Route::get('/barcode-inventory/export/{id}','BarcodeInventoryController@export');


/******* Barcode Inventory End *********/







/******* Reports  *********/
//device
Route::get('/reports/device','ReportsController@device')->name('report.device');
// Device Reports
Route::post('/reports/device','ReportsController@deviceReport');

//sim
Route::get('/reports/sim','ReportsController@sim')->name('report.sim');
// Device Reports
Route::post('/reports/sim','ReportsController@simReport');


/******* Reports End ******/
//sim
Route::get('/excelStyle','ReportsController@excelStyle')->name('excelStyle');

// new 22-Feb
Route::post('/deliveryChallanStatusUpdate','DeliveryChallanController@deliveryChallanStatusUpdate')->name('deliveryChallanStatusUpdate');

Route::post('/sendChallanEmail','DeliveryChallanController@sendChallanEmail')->name('sendChallanEmail');

Route::get('/searchChallanItems','DeliveryChallanController@searchChallanItems')->name('searchChallanItems');

//show Challan Items
Route::get('/showChallanItems/{id}','DeliveryChallanController@showChallanItems')->name('showChallanItems');



Route::post('/challanDelete','DeliveryChallanController@challanDelete')->name('challanDelete');

Route::get('/challanMail','DeliveryChallanController@challanMail')->name('challanMail');






