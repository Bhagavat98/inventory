<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});




// ******  User Api  ****** // user api v1 as version 1
Route::prefix('user/v1')->group(function () {

// login or logout 
Route::post('/login','Api\User\ApiUserController@loginUser'); 
// verify Otp & send user data
Route::post('/verifyOtp','Api\User\ApiUserController@verifyOtp'); 
// fcm Register & update
Route::post('/fcm_register','Api\User\ApiUserController@fcm_register'); 
// Society Gate List 
Route::get('/societyGate','Api\User\ApiVisitorsController@societyGate'); 
//company list
Route::get('/visitorCompanyList','Api\User\ApiVisitorsController@visitorCompanyList'); 
// add new visitor 
Route::post('/addVisitor','Api\User\ApiVisitorsController@CreateVisitor'); 
//visitor list 
Route::get('/visitorslist','Api\User\ApiVisitorsController@visitorslist');   
// update visitor
Route::post('/visitorUpdate','Api\User\ApiVisitorsController@visitorUpdate'); 
// delete visitor
Route::post('/visitorDelete','Api\User\ApiVisitorsController@visitorDelete');
// visitor allow / yes no status change 
Route::post('/visitorAllow','Api\User\ApiVisitorsController@visitorAllow'); 
// visitor visit After Check Out
Route::post('/visitorCheckOut','Api\User\ApiVisitorsController@visitorCheckOut'); 
// notice list
Route::get('/noticeboard','Api\User\ApiUserController@noticeboard'); 
// voting like dislike to notice
Route::post('/noticeboardVoting','Api\User\ApiUserController@voting'); 
// noticeboard Voteing List
Route::get('/noticeboardVoteList','Api\User\ApiUserController@noticeboardVoteList');
// society members list
Route::get('/members','Api\User\ApiUserController@allMembers'); 
// complaints Type's
Route::get('/complaintsType','Api\User\ApiComplaintsController@complaintsType'); 
// complaint List
Route::get('/ComplaintsList','Api\User\ApiComplaintsController@ComplaintsList'); 
// add complaints
Route::post('/addComplaint','Api\User\ApiComplaintsController@createComplaint'); 
// all settings
Route::get('/settings','Api\User\ApiSettingsController@GetSettings'); 
// change password
Route::post('/changePassword','Api\User\ApiSettingsController@changePassword');  
// notifications on / off
Route::post('/notificationAllow','Api\User\ApiSettingsController@notificationAllow'); 
// vehicle list
Route::get('/vehiclesList','Api\User\ApiVehiclesController@vehiclesList'); 
// add vehicle
Route::post('/addVehicle','Api\User\ApiVehiclesController@createVehicle');  
// delete Vehicle
Route::post('/deleteVehicle','Api\User\ApiVehiclesController@deleteVehicle'); 
// Advantisment list
Route::get('/myAddsList','Api\User\ApiMyAddController@myAddsList'); 
//add / created Trending Stores
Route::post('/addTrendingStores','Api\User\ApiTrendingStoresController@createdTrendingStores');
// Trending Stores List
Route::get('/trendingStoresList','Api\User\ApiTrendingStoresController@trendingStoresList');
// trending Stores Delete trendingStoresDelete
Route::get('/trendingStoresDelete','Api\User\ApiTrendingStoresController@trendingStoresDelete');
// databoard 
Route::get('/getDashboard','Api\User\ApiDashboardController@getDashboard');
// change profile etc update 
Route::post('/changeProfile','Api\User\ApiChangeProfileController@changeProfile');
// maintenance Details 
Route::get('/maintenanceDetails','Api\User\ApiSocietyMaintenanceController@maintenanceDetails');
// add Family Members
Route::post('/addFamilyMember','Api\User\ApiFamilyMembersController@addFamilyMember');
// Family Members List
Route::get('/familyMembersList','Api\User\ApiFamilyMembersController@familyMembersList');
// Delete Family Memeber
Route::post('/deletefamilyMember','Api\User\ApiFamilyMembersController@deletefamilyMember');
// sos list
Route::get('/sosList','Api\User\ApiSosController@GetSosList');
// emergency near me flat 
Route::get('/emergencyNearMeList','Api\User\ApiSosController@GetEmergencyNearMeList');
// Emergency Request
Route::post('/emergencySendRequest','Api\User\ApiSosController@EmergencyRequest');
// response Sos Request
Route::get('/emergencyRequestList','Api\User\ApiSosController@EmergencyRequestList');
// response Sos Request
Route::post('/responseSosRequest','Api\User\ApiSosController@ResponseSosRequest');
// Emergency press Sos 
Route::post('/emergencyPressSos','Api\User\ApiSosController@EmergencySos');
// daily cab Request
Route::post('/cabRequest','Api\User\ApiDailyCabController@CreateCabRequest');
// today all Notification
Route::get('/getAllNotification','Api\User\ApiUserController@getAllNotification');
// payment
Route::post('/payment','Api\User\ApiPaymentController@payment');
// payment List 
Route::get('/paymentList','Api\User\ApiPaymentController@paymentList');
// Add Regular Visitor
Route::post('/addRegularVisitor','Api\User\ApiVisitorsController@createRegularVisitors');




});

// api test Notification
Route::get('/testNotification','Api\ApiTestNotificationController@index');


// ***** Security *****//
Route::prefix('security/v1')->group(function () {
// login or logout 
Route::post('/login','Api\Security\ApiSecurityController@loginSecurity');
// verify Otp 
Route::post('/verifyOtp','Api\Security\ApiSecurityController@verifyOtp');
//fcm Register || update
Route::post('/fcm_register','Api\Security\ApiSecurityController@fcm_register');
// exipected visiter List
Route::get('/exipectedVisitor','Api\Security\ApiSecurityVisitorsController@exipectedVisitor');
// check In List
Route::get('/checkInList','Api\Security\ApiSecurityVisitorsController@checkInList');
// visitor check In
Route::post('/checkInVisitor','Api\Security\ApiSecurityVisitorsController@checkIn');
// check out visitor secruty
Route::post('/checkOut','Api\Security\ApiSecurityVisitorsController@checkOut');
// check out list
Route::get('/checkOutList','Api\Security\ApiSecurityVisitorsController@checkOutList');
// Add Regular Visitor
Route::post('/addRegularVisitor','Api\Security\ApiSecurityVisitorsController@createRegularVisitors');

// regular Visitors List
Route::get('/regularVisitorsList','Api\Security\ApiSecurityVisitorsController@regularVisitorsList');
// visitor verify otp
Route::post('/verifyVisitorOtp','Api\Security\ApiSecurityVisitorsController@verifyVisitorOtp');
// get Buliding List
Route::get('/getBulidingList','Api\Security\ApiSecurityVisitorsController@getBulidingList');
// get Cutomers 
Route::get('/getCustomer','Api\Security\ApiSecurityVisitorsController@getCustomer');
// send by securty   
Route::post('/addVisitorBySecurity','Api\Security\ApiSecurityVisitorsController@CreateVisitor');
//Visitor company list
Route::get('/visitorCompanyList','Api\User\ApiVisitorsController@visitorCompanyList'); 
// Allow By Security 
Route::post('/visitorAllowBySecurity','Api\Security\ApiSecurityVisitorsController@visitorAllowBySecurity'); 
// regular Visitor Check In
Route::post('/regularVisitorCheckIn','Api\Security\ApiSecurityVisitorsController@regularVisitorCheckIn'); 
// regular Visitor Check Out
Route::post('/regularVisitorCheckOut','Api\Security\ApiSecurityVisitorsController@regularVisitorCheckOut'); 

});


//******  Admin Api  ******* //
Route::prefix('admin/v1')->group(function () {
// login or logout api
Route::post('/login','Api\Admin\ApiAdminController@loginAdmin'); 
// fcmRegister api
Route::post('/fcmRegister','Api\Admin\ApiAdminController@fcmRegister');
//Visitor List from to date
Route::get('/visitorList','Api\Admin\ApiVisitorsController@VisitorList'); 
// Society Gate List 
Route::get('/societyGate','Api\Admin\ApiCustomersController@societyGate'); 
// society in Building List
Route::get('/buildingList','Api\Admin\ApiCustomersController@buildingList'); 
//customer as member list 
Route::get('/membersList','Api\Admin\ApiCustomersController@memberList'); 
// Add New Customer / memeber 
Route::post('/addMember','Api\Admin\ApiCustomersController@CreateMember');
// delete cutomers / member
Route::post('/deleteMember','Api\Admin\ApiCustomersController@deleteMember');
// api get all security list
Route::get('/securityList','Api\Admin\ApiSecurityController@securityList');
// Add New Security
Route::post('/addSecurity','Api\Admin\ApiSecurityController@CreateSecurity');
// Delete security
Route::post('/deleteSecurity','Api\Admin\ApiSecurityController@deleteSecurity');
// get All noticeboard List
Route::get('/noticeboardList','Api\Admin\ApiNoticeboardController@noticeboardList');
// Add New Notice Board 
Route::post('/addNoticeboard','Api\Admin\ApiNoticeboardController@CreateNoticeboard');
// edit noticeboard
Route::post('/editNoticeboard','Api\Admin\ApiNoticeboardController@UpdateNoticeboard');
// Delete Noticeboard
Route::post('/deleteNoticeboard','Api\Admin\ApiNoticeboardController@deleteNoticeboard');
// noticeboard Voteing List
Route::get('/noticeboardVoteList','Api\Admin\ApiNoticeboardController@noticeboardVoteList');
// Get All complaints List
Route::get('/complaintsList','Api\Admin\ApiComplaintsController@complaintsList');
// complaint Status
Route::post('/complaintStatus','Api\Admin\ApiComplaintsController@complaintStatus');
// Maintenance List
Route::get('/maintenanceList','Api\Admin\ApiMaintenanceController@maintenanceList');
// maintenance paid unpaid list
Route::get('/maintenancePaidUnpadList','Api\Admin\ApiMaintenanceController@maintenancePaidUnpadList');













});