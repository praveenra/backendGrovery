<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Superadmin\ProductSizeController;


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
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    return 'cache cleared';
});

Route::get('site/shutdown', function(){
    return Artisan::call('down');
});

Route::get('site/live', function(){
    return Artisan::call('up');
}); 

Route::group(['prefix'=>'admin','middleware'=>'admin'], function(){

    Route::resource('/dashboard','App\Http\Controllers\Admin\AdminDashboard');
    Route::resource('/selleradmin','App\Http\Controllers\Admin\AdminSeller');
    Route::resource('/deliveryadmin','App\Http\Controllers\Admin\AdminDelivery');
    Route::resource('/banneradmin','App\Http\Controllers\Admin\AdminBanner');
    Route::resource('/areabanneradmin','App\Http\Controllers\Admin\AdminAreaBanner');
    Route::resource('/areaadmin','App\Http\Controllers\Admin\AdminArea');
    Route::resource('/cityadmin','App\Http\Controllers\Admin\AdminCity');
    Route::resource('/categoryadmin','App\Http\Controllers\Admin\AdminCategory');
    Route::resource('/brandadmin','App\Http\Controllers\Admin\AdminBrand');
    Route::resource('/subcategoryadmin','App\Http\Controllers\Admin\AdminSubCategory');
    Route::resource('/plan','App\Http\Controllers\Admin\AdminPlan');
    Route::resource('/contactusadmin','App\Http\Controllers\Admin\AdminContactus');
    Route::resource('/offer','App\Http\Controllers\Admin\AdminOffer');
    Route::resource('/settings','App\Http\Controllers\Admin\AdminSettings');
    Route::resource('/pagesadmin','App\Http\Controllers\Admin\AdminPages');
    Route::resource('/faqadmin','App\Http\Controllers\Admin\AdminFaq');
    Route::get('productsadmin/remove_images', 'App\Http\Controllers\Admin\AdminProducts@remove_images');
    Route::get('productsadmin/get_subcategory', 'App\Http\Controllers\Admin\AdminProducts@get_subcategory');
    Route::get('productsadmin/get_subsubcategory', 'App\Http\Controllers\Admin\AdminProducts@get_subsubcategory');
    Route::get('productsadmin/get_brand', 'App\Http\Controllers\Admin\AdminProducts@get_brand');
    Route::get('productsadmin/uploadview', 'App\Http\Controllers\Admin\AdminProducts@uploadview');
    
    Route::post('productsadmin/uploadexcel', 'App\Http\Controllers\Admin\AdminProducts@uploadexcel');


    Route::resource('/productsadmin','App\Http\Controllers\Admin\AdminProducts');
    Route::resource('/maincategoryadmin','App\Http\Controllers\Admin\AdminMainCategory');
    Route::resource('/measurement','App\Http\Controllers\Admin\AdminMeasurement');

    Route::get('customers', 'App\Http\Controllers\Admin\AdminCustomer@list');
    Route::get('store_reviews', 'App\Http\Controllers\Admin\AdminReviews@store_reviews');
    Route::get('change_review_status', 'App\Http\Controllers\Admin\AdminReviews@change_review_status');
    Route::get('change_all_review_status', 'App\Http\Controllers\Admin\AdminReviews@change_all_review_status');
    Route::get('product_reviews', 'App\Http\Controllers\Admin\AdminReviews@product_reviews');
    Route::get('change_product_review_status', 'App\Http\Controllers\Admin\AdminReviews@change_product_review_status');
    Route::get('change_all_product_review_status', 'App\Http\Controllers\Admin\AdminReviews@change_all_product_review_status');
    

    Route::get('notification', 'App\Http\Controllers\Admin\AdminNotification@list');
    Route::post('send_notification', 'App\Http\Controllers\Admin\AdminNotification@send')->name('sendAdminNotification');


    Route::get('/subsubcategory', 'App\Http\Controllers\Admin\AdminSubSubCategory@list');
    Route::get('/subsubcategory/form/{id?}', 'App\Http\Controllers\Admin\AdminSubSubCategory@form');
    Route::post('/subsubcategory/save', 'App\Http\Controllers\Admin\AdminSubSubCategory@save');
    Route::post('/subsubcategory/delete','App\Http\Controllers\Admin\AdminSubSubCategory@delete')->name('deleteSubSubCategory');
    

    Route::get('log_history', 'App\Http\Controllers\Admin\AdminActivityLog@list');
    Route::get('filter_log', 'App\Http\Controllers\Admin\AdminActivityLog@filter');
    Route::get('export_log', 'App\Http\Controllers\Admin\AdminActivityLog@export');
   
    Route::get('/delivery_city/city_dropdown','App\Http\Controllers\Admin\AdminDelivery@city_dropdown');
    Route::get('/delivery_city/area_dropdown','App\Http\Controllers\Admin\AdminDelivery@area_dropdown');
    Route::get('/delivery_city/assigncaregiver','App\Http\Controllers\Admin\AdminDelivery@assigncaregiver');

    //Orders

    // Route::get('orders', 'App\Http\Controllers\Admin\AdminOrder@orders');
    // Route::post('approve_or_reject', 'App\Http\Controllers\Admin\AdminOrder@approveOrReject')->name('adminApproveOrReject');
    // Route::post('progress_order', 'App\Http\Controllers\Admin\AdminOrder@progressOrder')->name('adminProgressOrder');


    Route::post('/approve_order','App\Http\Controllers\Admin\AdminOrder@approveOrder')->name('approveOrder');
    Route::post('/proceed_order','App\Http\Controllers\Admin\AdminOrder@proceedOrder')->name('proceedOrder');
    Route::post('/out_for_delivery_order','App\Http\Controllers\Admin\AdminOrder@outfordeliveryOrder')->name('outfordeliveryOrder');
     Route::post('/complete_order','App\Http\Controllers\Admin\AdminOrder@completeOrder')->name('completeOrder');
    Route::post('/return_order','App\Http\Controllers\Admin\AdminOrder@returnOrder')->name('returnOrder');
    Route::post('/assign_check_delivery_man','App\Http\Controllers\Admin\AdminOrder@checkDeliveryman')->name('checkDeliveryman');

    Route::get('orders', 'App\Http\Controllers\Admin\AdminOrder@orders')->name('orders');
    Route::post('approve_or_reject', 'App\Http\Controllers\Admin\AdminOrder@approveOrReject')->name('approveOrReject');
    Route::post('progress_order', 'App\Http\Controllers\Admin\AdminOrder@progressOrder')->name('progressOrder');
    Route::post('cancel_order', 'App\Http\Controllers\Admin\AdminOrder@cancelOrder')->name('cancelOrder');
    Route::post('cancel_individual_order', 'App\Http\Controllers\Admin\AdminOrder@cancelIndividualOrder')->name('cancelIndividualOrder');
    Route::get('view_order/{id}', 'App\Http\Controllers\Admin\AdminOrder@display');

    Route::get('/orders/order_details/{order_id}','App\Http\Controllers\Admin\AdminOrder@orderDetails');

    Route::get('orders_history', 'App\Http\Controllers\Admin\AdminOrder@order_history')->name('orders_history');

    Route::get('/filter_manage_orders','App\Http\Controllers\Admin\AdminOrder@filter');

    Route::post('/assign_delivery_man','App\Http\Controllers\Admin\AdminOrder@assignDeliveryman')->name('assignDeliveryman');

    Route::post('/orderfilter','App\Http\Controllers\Admin\AdminOrder@orderfilter')->name('orderfilter');
    //Orders End

     //Delete Routes

     Route::post('/seller/delete','App\Http\Controllers\Admin\AdminSeller@deleteSeller')->name('deleteAdminSeller');
     Route::post('/delivery/delete','App\Http\Controllers\Admin\AdminDelivery@deleteDelivery')->name('deleteAdminDelivery');
     Route::post('/banner/delete','App\Http\Controllers\Admin\AdminBanner@deleteBanner')->name('deleteAdminBanner');
     Route::post('/city/delete','App\Http\Controllers\Admin\AdminCity@deleteCity')->name('deleteAdminCity');
     Route::post('/area/delete','App\Http\Controllers\Admin\AdminArea@deleteArea')->name('deleteAdminArea');
     Route::post('/areabanner/delete','App\Http\Controllers\Admin\AdminAreaBanner@deleteAreaBanner')->name('deleteAdminAreaBanner');
     Route::post('/maincategory/delete','App\Http\Controllers\Admin\AdminMainCategory@deleteMainCategory')->name('deleteAdminMainCategory');
    Route::post('/category/delete','App\Http\Controllers\Admin\AdminCategory@deleteCategory')->name('deleteAdminCategory');
    Route::post('/subcategory/delete','App\Http\Controllers\Admin\AdminSubCategory@deleteSubCategory')->name('deleteAdminSubCategory');
    Route::post('/subsubcategory/delete','App\Http\Controllers\Admin\AdminSubSubCategory@deleteSubSubCategory')->name('deleteAdminSubSubCategory');
    Route::post('/products/delete','App\Http\Controllers\Admin\AdminProducts@deleteProduct')->name('deleteAdminProduct');
    Route::post('/brand/delete','App\Http\Controllers\Admin\AdminBrand@deleteBrand')->name('deleteAdminBrand');
    Route::post('/plan/delete','App\Http\Controllers\Admin\AdminPlan@deletePlan')->name('deleteAdminPlan');
    Route::post('/pages/delete','App\Http\Controllers\Admin\AdminPages@deletePage')->name('deleteAdminPage');
    Route::post('/contactus/delete','App\Http\Controllers\Admin\AdminContactus@deleteContact')->name('deleteAdminContact');
    Route::post('/offer/delete','App\Http\Controllers\Admin\AdminOffer@deleteOffer')->name('deleteAdminOffer');
    Route::post('/settings/delete','App\Http\Controllers\Admin\AdminSettings@deleteSetting')->name('deleteAdminSetting');
    Route::post('/measurement/delete','App\Http\Controllers\Admin\AdminMeasurement@deleteMeasurement')->name('deleteAdminMeasurement');
    Route::post('/faq/delete','App\Http\Controllers\Admin\AdminFaq@deleteFaq')->name('deleteAdminFaq');


    //Filter

    Route::get('/filter_seller','App\Http\Controllers\Admin\AdminSeller@filter');
    Route::get('/filter_delivery','App\Http\Controllers\Admin\AdminDelivery@filter');
    Route::get('/filter_banner','App\Http\Controllers\Admin\AdminBanner@filter');
    Route::get('/filter_city','App\Http\Controllers\Admin\AdminCity@filter');
    Route::get('/filter_area','App\Http\Controllers\Admin\AdminArea@filter');
    Route::get('/filter_areabanner','App\Http\Controllers\Admin\AdminAreaBanner@filter');
    Route::get('/filter_maincategory/','App\Http\Controllers\Admin\AdminMainCategory@filter');
    Route::get('/filter_category','App\Http\Controllers\Admin\AdminCategory@filter');
    Route::get('/filter_subcategory','App\Http\Controllers\Admin\AdminSubCategory@filter');
    Route::get('/filter_products','App\Http\Controllers\Admin\AdminProducts@filter');
    Route::get('/filter_brand','App\Http\Controllers\Admin\AdminBrand@filter');
    Route::get('/filter_plan','App\Http\Controllers\Admin\AdminPlan@filter');
    Route::get('/filter_pages','App\Http\Controllers\Admin\AdminPages@filter');
    Route::get('/filter_contactus','App\Http\Controllers\Admin\AdminContactus@filter');
    Route::get('/filter_offer','App\Http\Controllers\Admin\AdminOffer@filter');
    Route::get('/filter_measurement','App\Http\Controllers\Admin\AdminMeasurement@filter');
    Route::get('/filter_faq','App\Http\Controllers\Admin\AdminFaq@filter');

    //Exports

     Route::get('/export_customers','App\Http\Controllers\Admin\AdminCustomer@export');
     Route::get('/export_sellers','App\Http\Controllers\Admin\AdminSeller@export');

});

Route::group(['prefix'=>'superadmin','middleware'=>'superadmin'], function(){

    Route::resource('/','App\Http\Controllers\Superadmin\SuperadminDashboard');
    Route::resource('/dashboard','App\Http\Controllers\Superadmin\SuperadminDashboard');
    Route::resource('/data_analytics','App\Http\Controllers\Superadmin\SuperadminDataAnalytics');
    Route::resource('/admindata','App\Http\Controllers\Superadmin\SuperadminAdmin');
    Route::get('/inactive_admin','App\Http\Controllers\Superadmin\SuperadminAdmin@inactiveData')->name('inactiveData');
    Route::get('/active_admin','App\Http\Controllers\Superadmin\SuperadminAdmin@activeData')->name('activeData');
    Route::resource('/seller','App\Http\Controllers\Superadmin\SuperadminSeller');
    Route::get('/inactive_seller','App\Http\Controllers\Superadmin\SuperadminSeller@inactiveData')->name('inactiveSeller');
    Route::get('/active_seller','App\Http\Controllers\Superadmin\SuperadminSeller@activeData')->name('activeSeller');



    Route::resource('/delivery','App\Http\Controllers\Superadmin\SuperadminDelivery');
    Route::get('/inactive_delivery','App\Http\Controllers\Superadmin\SuperadminDelivery@inactiveData')->name('inactiveDelivery');
    Route::get('/active_delivery','App\Http\Controllers\Superadmin\SuperadminDelivery@activeData')->name('activeDelivery');
    Route::get('/delivery_city/city_dropdown','App\Http\Controllers\Superadmin\SuperadminDelivery@city_dropdown');
    Route::get('/delivery_city/area_dropdown','App\Http\Controllers\Superadmin\SuperadminDelivery@area_dropdown');
    Route::get('/delivery_city/assigncaregiver','App\Http\Controllers\Superadmin\SuperadminDelivery@assigncaregiver');

    Route::resource('/banner','App\Http\Controllers\Superadmin\SuperadminBanner');
    Route::get('/inactive_banner','App\Http\Controllers\Superadmin\SuperadminBanner@inactiveData')->name('inactiveBanner');
    Route::get('/active_banner','App\Http\Controllers\Superadmin\SuperadminBanner@activeData')->name('activeBanner');
    Route::resource('/areabanner','App\Http\Controllers\Superadmin\SuperadminAreaBanner');
    Route::get('/inactive_area_banner','App\Http\Controllers\Superadmin\SuperadminAreaBanner@inactiveData')->name('inactiveAreaBanner');
    Route::get('/active_area_banner','App\Http\Controllers\Superadmin\SuperadminAreaBanner@activeData')->name('activeAreaBanner');
    Route::resource('/area','App\Http\Controllers\Superadmin\SuperadminArea');
    Route::resource('/zone','App\Http\Controllers\Superadmin\SuperadminZone');
    Route::get('/inactive_area','App\Http\Controllers\Superadmin\SuperadminArea@inactiveData')->name('inactiveArea');
    Route::get('/active_area','App\Http\Controllers\Superadmin\SuperadminArea@activeData')->name('activeArea');
    Route::get('/inactive_zone','App\Http\Controllers\Superadmin\SuperadminZone@inactiveData')->name('inactiveZone');
    Route::get('/active_zone','App\Http\Controllers\Superadmin\SuperadminZone@activeData')->name('activeZone');
    Route::resource('/city','App\Http\Controllers\Superadmin\SuperadminCity');

    //City 

    Route::get('/city','App\Http\Controllers\Superadmin\SuperadminCity@create');
    Route::post('/city_store','App\Http\Controllers\Superadmin\SuperadminCity@store');
    Route::get('/city_index','App\Http\Controllers\Superadmin\SuperadminCity@index');
    Route::get('/city_edit/{id}','App\Http\Controllers\Superadmin\SuperadminCity@edit');
    Route::post('/city_update','App\Http\Controllers\Superadmin\SuperadminCity@update');
    Route::get('/inactive_city','App\Http\Controllers\Superadmin\SuperadminCity@inactiveData')->name('inactiveCity');
    Route::get('/active_city','App\Http\Controllers\Superadmin\SuperadminCity@activeData')->name('activeCity');

    // City End

    Route::resource('/category','App\Http\Controllers\Superadmin\SuperadminCategory');
    Route::get('/inactive_category','App\Http\Controllers\Superadmin\SuperadminCategory@inactiveData')->name('inactiveCategory');
    Route::get('/active_category','App\Http\Controllers\Superadmin\SuperadminCategory@activeData')->name('activeCategory');
    Route::resource('/brand','App\Http\Controllers\Superadmin\SuperadminBrand');
    Route::get('/inactive_brand','App\Http\Controllers\Superadmin\SuperadminBrand@inactiveData')->name('inactiveBrand');
    Route::get('/active_brand','App\Http\Controllers\Superadmin\SuperadminBrand@activeData')->name('activeBrand');
    Route::resource('/subcategory','App\Http\Controllers\Superadmin\SuperadminSubCategory');
    Route::get('/inactive_subcategory','App\Http\Controllers\Superadmin\SuperadminSubCategory@inactiveData')->name('inactiveSubCategory');
    Route::get('/active_subcategory','App\Http\Controllers\Superadmin\SuperadminSubCategory@activeData')->name('activeSubCategory');

    // Plan

    Route::get('/plan_list','App\Http\Controllers\Superadmin\SuperadminPlan@list');
    Route::get('/plan_form/{id?}','App\Http\Controllers\Superadmin\SuperadminPlan@form');
    Route::post('/save_plan','App\Http\Controllers\Superadmin\SuperadminPlan@save');
    
    Route::get('/membership_user_list','App\Http\Controllers\Superadmin\SuperadminPlan@membership_user_list');

    //End Plan

    Route::get('/inactive_plan','App\Http\Controllers\Superadmin\SuperadminPlan@inactiveData')->name('inactivePlan');
    Route::get('/active_plan','App\Http\Controllers\Superadmin\SuperadminPlan@activeData')->name('activePlan');
    Route::resource('/contactus','App\Http\Controllers\Superadmin\SuperadminContactus');
    Route::get('/inactive_contactus','App\Http\Controllers\Superadmin\SuperadminContactus@inactiveData')->name('inactiveContactUs');
    Route::get('/active_contactus','App\Http\Controllers\Superadmin\SuperadminContactus@activeData')->name('activeContactUs');

    // offer

    Route::get('/offer','App\Http\Controllers\Superadmin\SuperadminOffer@list');
    Route::get('/offer_form/{id?}','App\Http\Controllers\Superadmin\SuperadminOffer@form');
    Route::post('/offer_save','App\Http\Controllers\Superadmin\SuperadminOffer@save')->name('saveOffer');
    Route::get('/inactive_offer','App\Http\Controllers\Superadmin\SuperadminOffer@inactiveData')->name('inactiveOffer');
    Route::get('/active_offer','App\Http\Controllers\Superadmin\SuperadminOffer@activeData')->name('activeOffer');


    Route::post('/form/action','App\Http\Controllers\Superadmin\SuperadminOffer@action')->name('form/action');

    Route::get('/search','App\Http\Controllers\Superadmin\SuperadminOffer@search');

    // End Offer


    Route::resource('/settings','App\Http\Controllers\Superadmin\SuperadminSettings');
    Route::resource('/pages','App\Http\Controllers\Superadmin\SuperadminPages');
    Route::get('/inactive_pages','App\Http\Controllers\Superadmin\SuperadminPages@inactiveData')->name('inactivePages');
    Route::get('/active_pages','App\Http\Controllers\Superadmin\SuperadminPages@activeData')->name('activePages');
    Route::resource('/faq','App\Http\Controllers\Superadmin\SuperadminFaq');
    Route::get('/inactive_faq','App\Http\Controllers\Superadmin\SuperadminFaq@inactiveData')->name('inactiveFaq');
    Route::get('/active_faq','App\Http\Controllers\Superadmin\SuperadminFaq@activeData')->name('activeFaq');


    
	Route::get('products/remove_images', 'App\Http\Controllers\Superadmin\SuperadminProducts@remove_images');
	Route::get('products/get_subcategory', 'App\Http\Controllers\Superadmin\SuperadminProducts@get_subcategory');
    Route::get('products/get_subsubcategory', 'App\Http\Controllers\Superadmin\SuperadminProducts@get_subsubcategory');
	Route::get('products/get_brand', 'App\Http\Controllers\Superadmin\SuperadminProducts@get_brand');
	Route::get('products/uploadview', 'App\Http\Controllers\Superadmin\SuperadminProducts@uploadview');
	Route::post('products/uploadexcel', 'App\Http\Controllers\Superadmin\SuperadminProducts@uploadexcel');
    Route::resource('/products','App\Http\Controllers\Superadmin\SuperadminProducts');
    Route::get('/inactive_products','App\Http\Controllers\Superadmin\SuperadminProducts@inactiveData')->name('inactiveProducts');
    Route::get('/active_products','App\Http\Controllers\Superadmin\SuperadminProducts@activeData')->name('activeProducts');
    Route::resource('/maincategory','App\Http\Controllers\Superadmin\SuperadminMainCategory');
    Route::get('/inactive_main_category','App\Http\Controllers\Superadmin\SuperadminMainCategory@inactiveData')->name('inactiveMainCategory');
    Route::get('/active_main_category','App\Http\Controllers\Superadmin\SuperadminMainCategory@activeData')->name('activeMainCategory');
    Route::resource('/measurement','App\Http\Controllers\Superadmin\SuperadminMeasurement');
    Route::get('/inactive_measurement','App\Http\Controllers\Superadmin\SuperadminMeasurement@inactiveData')->name('inactiveMeasurement');
    Route::get('/active_measurement','App\Http\Controllers\Superadmin\SuperadminMeasurement@activeData')->name('activeMeasurement');

    //Customers
     
    Route::get('customers', 'App\Http\Controllers\Superadmin\SuperadminCustomer@list');
    Route::get('/filter_customer','App\Http\Controllers\Superadmin\SuperadminCustomer@filter');
    Route::get('/inactive_customer','App\Http\Controllers\Superadmin\SuperadminCustomer@inactiveData')->name('inactiveCustomer');
    Route::get('/active_customer','App\Http\Controllers\Superadmin\SuperadminCustomer@activeData')->name('activeCustomer');

    //Customers End

    Route::get('store_reviews', 'App\Http\Controllers\Superadmin\SuperadminReviews@store_reviews');
    Route::get('change_review_status', 'App\Http\Controllers\Superadmin\SuperadminReviews@change_review_status');
    Route::get('change_all_review_status', 'App\Http\Controllers\Superadmin\SuperadminReviews@change_all_review_status');
    Route::get('product_reviews', 'App\Http\Controllers\Superadmin\SuperadminReviews@product_reviews');
    Route::get('change_product_review_status', 'App\Http\Controllers\Superadmin\SuperadminReviews@change_product_review_status');
    Route::get('change_all_product_review_status', 'App\Http\Controllers\Superadmin\SuperadminReviews@change_all_product_review_status');

    //Orders

    Route::post('/approve_order','App\Http\Controllers\Superadmin\SuperadminOrder@approveOrder')->name('approveOrder');
    Route::post('/proceed_order','App\Http\Controllers\Superadmin\SuperadminOrder@proceedOrder')->name('proceedOrder');
    Route::post('/out_for_delivery_order','App\Http\Controllers\Superadmin\SuperadminOrder@outfordeliveryOrder')->name('outfordeliveryOrder');
     Route::post('/complete_order','App\Http\Controllers\Superadmin\SuperadminOrder@completeOrder')->name('completeOrder');
    Route::post('/return_order','App\Http\Controllers\Superadmin\SuperadminOrder@returnOrder')->name('returnOrder');
    Route::post('/assign_check_delivery_man','App\Http\Controllers\Superadmin\SuperadminOrder@checkDeliveryman')->name('checkDeliveryman');

    Route::get('orders', 'App\Http\Controllers\Superadmin\SuperadminOrder@orders')->name('orders');
    Route::get('assignedorders', 'App\Http\Controllers\Superadmin\SuperadminOrder@assignedorders')->name('assignedorders');
    Route::get('deliveredorders', 'App\Http\Controllers\Superadmin\SuperadminOrder@deliveredorders')->name('deliveredorders');
    Route::get('pendingorders', 'App\Http\Controllers\Superadmin\SuperadminOrder@pendingorders')->name('pendingorders');

    Route::get('delivery_man', 'App\Http\Controllers\Superadmin\SuperadminOrder@delivery_man')->name('delivery_man');
    
    Route::post('approve_or_reject', 'App\Http\Controllers\Superadmin\SuperadminOrder@approveOrReject')->name('approveOrReject');
    Route::post('progress_order', 'App\Http\Controllers\Superadmin\SuperadminOrder@progressOrder')->name('progressOrder');
    Route::post('cancel_order', 'App\Http\Controllers\Superadmin\SuperadminOrder@cancelOrder')->name('cancelOrder');
    Route::post('cancel_individual_order', 'App\Http\Controllers\Superadmin\SuperadminOrder@cancelIndividualOrder')->name('cancelIndividualOrder');
    Route::get('view_order/{id}', 'App\Http\Controllers\Superadmin\SuperadminOrder@display');
    Route::get('view_order_store/{id}/{store_id}', 'App\Http\Controllers\Superadmin\SuperadminOrder@storebaseddisplay');
    Route::get('/orders/order_details/{order_id}','App\Http\Controllers\Superadmin\SuperadminOrder@orderDetails');
    Route::get('orders_history', 'App\Http\Controllers\Superadmin\SuperadminOrder@order_history')->name('orders_history');
    Route::get('/filter_manage_orders','App\Http\Controllers\Superadmin\SuperadminOrder@filter');
    Route::post('/assign_delivery_man','App\Http\Controllers\Superadmin\SuperadminOrder@assignDeliveryman')->name('assignDeliveryman');
    Route::post('/orderfilter','App\Http\Controllers\Superadmin\SuperadminOrder@orderfilter')->name('orderfilter');

    Route::get('waiting_for_approval_order', 'App\Http\Controllers\Superadmin\SuperadminOrder@waiting_for_approval_order')->name('waiting_for_approval_order');

    Route::get('approve_and_reject_order', 'App\Http\Controllers\Superadmin\SuperadminOrder@approve_and_reject_order')->name('approve_and_reject_order');

    Route::get('ready_to_pickup_and_delivery', 'App\Http\Controllers\Superadmin\SuperadminOrder@ready_to_pickup_and_delivery')->name('ready_to_pickup_and_delivery');

    Route::get('complete_and_return_order', 'App\Http\Controllers\Superadmin\SuperadminOrder@complete_and_return_order')->name('complete_and_return_order');


    //Orders End

    //Order Limit

    Route::get('orders_limit_list','App\Http\Controllers\Superadmin\SuperadminOrder@list');
    Route::get('/limit_form_edit/{id}','App\Http\Controllers\Superadmin\SuperadminOrder@edit');
    Route::post('/limit_form_edit','App\Http\Controllers\Superadmin\SuperadminOrder@update');
    Route::get('orders_limit_form/{id?}','App\Http\Controllers\Superadmin\SuperadminOrder@form');
    Route::post('save_orders_limit', 'App\Http\Controllers\Superadmin\SuperadminOrder@save');
    Route::post('/orders_limit/delete','App\Http\Controllers\Superadmin\SuperadminOrder@deleteOrderlimit')->name('deleteOrderlimit');

    // Order Limit End
    
    //OrderPayment Start

    Route::get('order_earning','App\Http\Controllers\Superadmin\SuperadminOrderPayment@order_earning');

    Route::get('view_order_earnings/{id}', 'App\Http\Controllers\Superadmin\SuperadminOrderPayment@order_earning_display');

    Route::get('/order_earning_list','App\Http\Controllers\Superadmin\SuperadminOrderPayment@export_order_earning_list');


    Route::get('order_payments','App\Http\Controllers\Superadmin\SuperadminOrderPayment@orders_payment');

    Route::get('view_order_payments/{id}', 'App\Http\Controllers\Superadmin\SuperadminOrderPayment@display');

    Route::get('/inactive_order_payments','App\Http\Controllers\Superadmin\SuperadminOrderPayment@inactiveDataSeller')->name('inactiveOrderPayments');
    Route::get('/active_order_payments','App\Http\Controllers\Superadmin\SuperadminOrderPayment@activeDataSeller')->name('activeOrderPayments');
    
    Route::get('delivery_boy_payments','App\Http\Controllers\Superadmin\SuperadminOrderPayment@delivery_boy_payment');

    Route::get('/inactive_delivery_boy_payment','App\Http\Controllers\Superadmin\SuperadminOrderPayment@inactiveDataDeliveryBoy')->name('inactiveDeliveryBoy');
    Route::get('/active_delivery_boy_payment','App\Http\Controllers\Superadmin\SuperadminOrderPayment@activeDataDeliveryBoy')->name('activeDeliveryBoy');

    Route::get('return_payments','App\Http\Controllers\Superadmin\SuperadminOrderPayment@return_payment');

    Route::get('/inactive_return_payments','App\Http\Controllers\Superadmin\SuperadminOrderPayment@inactiveDataReturnPayment')->name('inactiveReturnPayments');
    Route::get('/active_return_payments','App\Http\Controllers\Superadmin\SuperadminOrderPayment@activeDataReturnPayment')->name('activeReturnPayments');


    //OrderPayment End

    //Cancellation Reasons

    Route::get('/cancel_reason','App\Http\Controllers\Superadmin\SuperadminCancelReason@list');
    Route::get('/cancel_reason_form/{id?}','App\Http\Controllers\Superadmin\SuperadminCancelReason@form');
    Route::post('/cancel_reason_save','App\Http\Controllers\Superadmin\SuperadminCancelReason@save')->name('saveCancel_reason');
    Route::get('/inactive_cancel_reason','App\Http\Controllers\Superadmin\SuperadminCancelReason@inactiveData')->name('inactiveCancel_reason');
    Route::get('/active_cancel_reason','App\Http\Controllers\Superadmin\SuperadminCancelReason@activeData')->name('activeCancel_reason');
    Route::get('/filter_cancel_reason','App\Http\Controllers\Superadmin\SuperadminCancelReason@filter');
    Route::post('/cancel_reason/delete','App\Http\Controllers\Superadmin\SuperadminCancelReason@deleteCancelReason')->name('deleteCancelReason');

    //End Cancellation Reasons


    //Sathish Create Color Module


    // Route::get('/color/changestatus','App\Http\Controllers\Superadmin\SuperadminColor@changestatus');

    // Route::post('/color/delete','App\Http\Controllers\Superadmin\SuperadminColor@deleteColor')->name('deleteColor');
    // // Route::get('/export_color','App\Http\Controllers\Superadmin\SuperadminColor@export')->name('exportColor');
    // Route::resource('/color','App\Http\Controllers\Superadmin\SuperadminColor');

    // Sathish Create End Color Module



    // Start Product Color and Product size Module
    
    Route::get('/productColor',[\App\Http\Controllers\Superadmin\ProductColorController::class, 'index'])->name('productColor');
    Route::post('/productColor/create',[\App\Http\Controllers\Superadmin\ProductColorController::class, 'create'])->name('productColor.create');
    Route::post('/productColor/edit',[\App\Http\Controllers\Superadmin\ProductColorController::class, 'edit'])->name('productColor.edit');
    Route::post('/productColor/store',[\App\Http\Controllers\Superadmin\ProductColorController::class, 'store'])->name('productColor.store');
    Route::post('/productColor/update',[\App\Http\Controllers\Superadmin\ProductColorController::class, 'update'])->name('productColor.update');
    Route::post('/productColor/delete',[\App\Http\Controllers\Superadmin\ProductColorController::class, 'delete'])->name('productColor.delete');


    Route::get('/productSize',[\App\Http\Controllers\Superadmin\ProductSizeController::class, 'index'])->name('productSize');
    Route::post('/productSize/create',[\App\Http\Controllers\Superadmin\ProductSizeController::class, 'create'])->name('productSize.create');
    Route::post('/productSize/edit',[\App\Http\Controllers\Superadmin\ProductSizeController::class, 'edit'])->name('productSize.edit');
    Route::post('/productSize/update',[\App\Http\Controllers\Superadmin\ProductSizeController::class, 'update'])->name('productColor.update');
    Route::post('/productSize/delete',[\App\Http\Controllers\Superadmin\ProductSizeController::class, 'delete'])->name('productSize.delete');

    // End Product Color and Product size Module

    Route::get('notification', 'App\Http\Controllers\Superadmin\SuperadminNotification@list');
    Route::post('send_notification', 'App\Http\Controllers\Superadmin\SuperadminNotification@send')->name('sendNotification');

    Route::get('/notification_list','App\Http\Controllers\Superadmin\SuperadminNotification@export_notification_list');

    Route::get('/subsubcategory', 'App\Http\Controllers\Superadmin\SuperadminSubSubCategory@list');
    Route::get('/subsubcategory/form/{id?}', 'App\Http\Controllers\Superadmin\SuperadminSubSubCategory@form');
    Route::get('/load_subcategory', 'App\Http\Controllers\Superadmin\SuperadminSubSubCategory@getSubCategory');
    Route::post('/subsubcategory/save', 'App\Http\Controllers\Superadmin\SuperadminSubSubCategory@save');
    Route::post('/subsubcategory/delete','App\Http\Controllers\Superadmin\SuperadminSubSubCategory@delete')->name('deleteSubSubCategory');
    Route::get('/inactive_subsubcategory','App\Http\Controllers\Superadmin\SuperadminSubSubCategory@inactiveData')->name('inactiveSubSubCategory');
    Route::get('/active_subsubcategory','App\Http\Controllers\Superadmin\SuperadminSubSubCategory@activeData')->name('activeSubSubCategory');
    Route::get('/filter_subsubcategory','App\Http\Controllers\Superadmin\SuperadminSubSubCategory@filter');


    Route::get('log_history', 'App\Http\Controllers\Superadmin\SuperadminActivityLog@list');
    Route::get('filter_log', 'App\Http\Controllers\Superadmin\SuperadminActivityLog@filter');
    Route::get('export_log', 'App\Http\Controllers\Superadmin\SuperadminActivityLog@export');


    // Delivery Fee

    Route::get('/delivery_info','App\Http\Controllers\Superadmin\SuperadminDeliveryInfo@create');
    Route::post('/delivery_info_store','App\Http\Controllers\Superadmin\SuperadminDeliveryInfo@store');
    Route::get('/delivery_info_index','App\Http\Controllers\Superadmin\SuperadminDeliveryInfo@index');
    Route::get('/delivery_info_edit/{id}','App\Http\Controllers\Superadmin\SuperadminDeliveryInfo@edit');
    Route::post('/delivery_info_update','App\Http\Controllers\Superadmin\SuperadminDeliveryInfo@update');
    Route::post('/delivery_info/delete','App\Http\Controllers\Superadmin\SuperadminDeliveryInfo@deleteDeliveryInfo')->name('deleteDeliveryInfo');

    // Delivery Fee End

     //Delete Routes

    Route::post('/admindata/delete','App\Http\Controllers\Superadmin\SuperadminAdmin@deleteAdmin')->name('deleteAdmin');
    Route::post('/seller/delete','App\Http\Controllers\Superadmin\SuperadminSeller@deleteSeller')->name('deleteSeller');
    Route::post('/delivery/delete','App\Http\Controllers\Superadmin\SuperadminDelivery@deleteDelivery')->name('deleteDelivery');
    Route::post('/banner/delete','App\Http\Controllers\Superadmin\SuperadminBanner@deleteBanner')->name('deleteBanner');
    Route::post('/city/delete','App\Http\Controllers\Superadmin\SuperadminCity@deleteCity')->name('deleteCity');
    Route::post('/area/delete','App\Http\Controllers\Superadmin\SuperadminArea@deleteArea')->name('deleteArea');
    Route::post('/areabanner/delete','App\Http\Controllers\Superadmin\SuperadminAreaBanner@deleteAreaBanner')->name('deleteAreaBanner');
    Route::post('/maincategory/delete','App\Http\Controllers\Superadmin\SuperadminMainCategory@deleteMainCategory')->name('deleteMainCategory');
    Route::post('/category/delete','App\Http\Controllers\Superadmin\SuperadminCategory@deleteCategory')->name('deleteCategory');
    Route::post('/subcategory/delete','App\Http\Controllers\Superadmin\SuperadminSubCategory@deleteSubCategory')->name('deleteSubCategory');
    Route::post('/products/delete','App\Http\Controllers\Superadmin\SuperadminProducts@deleteProduct')->name('deleteProduct');
    Route::post('/brand/delete','App\Http\Controllers\Superadmin\SuperadminBrand@deleteBrand')->name('deleteBrand');
    Route::post('/plan/delete','App\Http\Controllers\Superadmin\SuperadminPlan@deletePlan')->name('deletePlan');
    Route::post('/pages/delete','App\Http\Controllers\Superadmin\SuperadminPages@deletePage')->name('deletePage');
    Route::post('/contactus/delete','App\Http\Controllers\Superadmin\SuperadminContactus@deleteContact')->name('deleteContact');
    Route::post('/offer/delete','App\Http\Controllers\Superadmin\SuperadminOffer@deleteOffer')->name('deleteOffer');
    Route::post('/settings/delete','App\Http\Controllers\Superadmin\SuperadminSettings@deleteSetting')->name('deleteSetting');
    Route::post('/measurement/delete','App\Http\Controllers\Superadmin\SuperadminMeasurement@deleteMeasurement')->name('deleteMeasurement');
    Route::post('/faq/delete','App\Http\Controllers\Superadmin\SuperadminFaq@deleteFaq')->name('deleteFaq');
    Route::post('/zone/delete','App\Http\Controllers\Superadmin\SuperadminZone@deleteZone')->name('deleteZone');


    //Filter

    Route::get('/filter_seller','App\Http\Controllers\Superadmin\SuperadminSeller@filter');
    Route::get('/filter_delivery','App\Http\Controllers\Superadmin\SuperadminDelivery@filter');
    Route::get('/filter_banner','App\Http\Controllers\Superadmin\SuperadminBanner@filter');
    Route::get('/filter_city','App\Http\Controllers\Superadmin\SuperadminCity@filter');
    Route::get('/filter_area','App\Http\Controllers\Superadmin\SuperadminArea@filter');
    Route::get('/filter_zone','App\Http\Controllers\Superadmin\SuperadminZone@filter');
    Route::get('/filter_areabanner','App\Http\Controllers\Superadmin\SuperadminAreaBanner@filter');
    Route::get('/filter_maincategory/','App\Http\Controllers\Superadmin\SuperadminMainCategory@filter');
    Route::get('/filter_category','App\Http\Controllers\Superadmin\SuperadminCategory@filter');
    Route::get('/filter_subcategory','App\Http\Controllers\Superadmin\SuperadminSubCategory@filter');
    Route::get('/filter_products','App\Http\Controllers\Superadmin\SuperadminProducts@filter');
    Route::get('/filter_brand','App\Http\Controllers\Superadmin\SuperadminBrand@filter');
    Route::get('/filter_plan','App\Http\Controllers\Superadmin\SuperadminPlan@filter');
    Route::get('/filter_pages','App\Http\Controllers\Superadmin\SuperadminPages@filter');
    Route::get('/filter_contactus','App\Http\Controllers\Superadmin\SuperadminContactus@filter');
    Route::get('/filter_offer','App\Http\Controllers\Superadmin\SuperadminOffer@filter');
    Route::get('/filter_measurement','App\Http\Controllers\Superadmin\SuperadminMeasurement@filter');
    Route::get('/filter_faq','App\Http\Controllers\Superadmin\SuperadminFaq@filter');

    //Exports

    Route::get('/export_top_products_order','App\Http\Controllers\Superadmin\SuperadminDataAnalytics@export_top_products_order');

    Route::get('/area_based_customer','App\Http\Controllers\Superadmin\SuperadminDataAnalytics@export_area_based_customer');
    
    Route::get('/store_depend_product_price_list','App\Http\Controllers\Superadmin\SuperadminDataAnalytics@export_store_depend_product_price_list');

    Route::get('/customer_orders_total','App\Http\Controllers\Superadmin\SuperadminDataAnalytics@export_customer_orders_total');

    Route::get('/export_orders','App\Http\Controllers\Superadmin\SuperadminOrder@export');

    Route::get('/export_customers','App\Http\Controllers\Superadmin\SuperadminCustomer@export');
    Route::get('/export_sellers','App\Http\Controllers\Superadmin\SuperadminSeller@export');

    //Seller Tags

    Route::get('/seller_tags','App\Http\Controllers\Superadmin\SuperadminSellerTags@list');
    Route::get('/filter_seller_tags','App\Http\Controllers\Superadmin\SuperadminSellerTags@filter');

    // Roles

    Route::get('/role_list','App\Http\Controllers\Superadmin\SuperadminRole@list');
    Route::get('/role_form/{id?}','App\Http\Controllers\Superadmin\SuperadminRole@form');
    Route::post('/role_save','App\Http\Controllers\Superadmin\SuperadminRole@save')->name('saveRole');
    Route::post('/role_delete','App\Http\Controllers\Superadmin\SuperadminRole@delete')->name('deleteRole');

    // Delivery Settings
    Route::get('/cashinhand','App\Http\Controllers\Superadmin\SuperadminDeliverySetting@dboycashinhandview');
    Route::get('/delivery_settings_list','App\Http\Controllers\Superadmin\SuperadminDeliverySetting@list');
    Route::get('/delivery_settings_form/{id?}','App\Http\Controllers\Superadmin\SuperadminDeliverySetting@form');
    Route::post('/delivery_settings_save','App\Http\Controllers\Superadmin\SuperadminDeliverySetting@save')->name('saveDeliverySettings');
    Route::post('/savedboycashinhandview','App\Http\Controllers\Superadmin\SuperadminDeliverySetting@savedboycashinhandview')->name('savedboycashinhandview');
    Route::post('/delivery_settings_delete','App\Http\Controllers\Superadmin\SuperadminDeliverySetting@delete')->name('deleteDeliverySettings');

});

Route::group(['prefix'=>'seller','middleware'=>'seller'], function(){


    Route::resource('/','App\Http\Controllers\Seller\SellerDashboard');
    Route::resource('/dashboard','App\Http\Controllers\Seller\SellerDashboard');
	Route::get('product/get_subcategory', 'App\Http\Controllers\seller\SellerProducts@get_subcategory');
	Route::get('product/remove_images', 'App\Http\Controllers\Seller\SellerProducts@remove_images');
	Route::get('product/uploadview', 'App\Http\Controllers\Seller\SellerProducts@uploadview');
	Route::get('product/get_brand', 'App\Http\Controllers\Seller\SellerProducts@get_brand');
	Route::post('product/uploadexcel', 'App\Http\Controllers\Seller\SellerProducts@uploadexcel');
    Route::resource('/setting','App\Http\Controllers\Seller\SellerSetting');
    Route::post('/save_setting','App\Http\Controllers\Seller\SellerSetting@saveSetting')->name('saveSetting');

    Route::resource('/product','App\Http\Controllers\Seller\SellerProducts');

    Route::get('/orders', 'App\Http\Controllers\Seller\SellerOrder@orders');
    Route::post('approve_or_reject', 'App\Http\Controllers\Seller\SellerOrder@approveOrReject')->name('approveOrReject');
    Route::post('progress_order', 'App\Http\Controllers\Seller\SellerOrder@progressOrder')->name('progressOrder');

    Route::get('/tags/list', 'App\Http\Controllers\Seller\SellerTags@list');
    Route::get('/tags/form/{id?}', 'App\Http\Controllers\Seller\SellerTags@form');
    Route::post('/tags/save', 'App\Http\Controllers\Seller\SellerTags@save')->name('saveTag');
    Route::post('/tags/delete', 'App\Http\Controllers\Seller\SellerTags@delete')->name('deleteTag');

     //delete routes

     Route::post('/product/delete','App\Http\Controllers\Seller\SellerProducts@deleteProduct')->name('deleteProduct');
     Route::post('/setting/delete','App\Http\Controllers\Seller\SellerSetting@deleteSetting')->name('deleteSetting');

     Route::get('/filter_products','App\Http\Controllers\Seller\SellerProducts@filter');

});


Route::post('/superadminlogin', 'App\Http\Controllers\ResetPasswordController@redirectTo');

Route::get('/', 'App\Http\Controllers\WebController@mainpage');
Route::get('/custlogin', 'App\Http\Controllers\WebController@login');
Route::get('/custregister', 'App\Http\Controllers\WebController@register');
Route::post('/submitregister', 'App\Http\Controllers\WebController@submitregister');
Route::post('/checkotp', 'App\Http\Controllers\WebController@checkotp');
Route::post('/loginsubmit', 'App\Http\Controllers\WebController@loginsubmit');
Route::post('/checksigninotp', 'App\Http\Controllers\WebController@checksigninotp');
Route::get('/store/{type}', 'App\Http\Controllers\WebController@storetype');
Route::get('/store/{type}/{id}', 'App\Http\Controllers\WebController@getproduct');
Route::get('/store/{type}/{id}/{catid}/{subid}', 'App\Http\Controllers\WebController@getsubcategory');
Route::get('/store/{type}/{id}/{catid}/{subid}/{sort}', 'App\Http\Controllers\WebController@pricesort');
Route::get('/addcart/{sid}/{productid}', 'App\Http\Controllers\WebController@addtocart');
Route::get('/sellerlogin', 'App\Http\Controllers\HomeController@SellerLogin');
Route::get('/superadminlogin', 'App\Http\Controllers\HomeController@SuperadminLogin');
Route::get('/adminlogin', 'App\Http\Controllers\HomeController@adminLogin');
Route::get('/logout', 'App\Http\Controllers\HomeController@getLogout');
Route::get('/customerlogout', 'App\Http\Controllers\HomeController@customerlogout');
Route::get('/sellerlogout', 'App\Http\Controllers\HomeController@sellerlogout');
Route::get('/adminlogout', 'App\Http\Controllers\HomeController@adminlogout');
Route::post('/superadminlogin', 'App\Http\Controllers\Auth\LoginController@SuperadminLogin');
Route::post('/adminlogin', 'App\Http\Controllers\Auth\LoginController@adminLogin');
Route::post('/sellerlogin', 'App\Http\Controllers\Auth\LoginController@SellerLogin');

Route::get('/profile', 'App\Http\Controllers\UserController@profile');
Route::post('/profile', 'App\Http\Controllers\UserController@update_profile_image');

Route::get('/profile_detail','App\Http\Controllers\UserController@data');
Route::post('/profile_detail_update','App\Http\Controllers\UserController@update');

Route::get('/change-password', 'App\Http\Controllers\ChangePasswordController@index');
Route::post('/change-password', 'App\Http\Controllers\ChangePasswordController@store')->name('change.password');


Route::get('/customer_address', 'App\Http\Controllers\WebController@customerAddress')->name('customerAddress');
Route::get('/setaddress', 'App\Http\Controllers\WebController@setAddress');
Route::get('/edit_address/{id?}', 'App\Http\Controllers\WebController@editAddress')->name('editAddress');
Route::post('/save_customer_address', 'App\Http\Controllers\WebController@saveCustomerAddress')->name('saveCustomerAddress');
Route::post('/delete_customer_address', 'App\Http\Controllers\WebController@deleteCustomerAddress')->name('deleteCustomerAddress');

Route::get('/addlist/{sid}/{productid}', 'App\Http\Controllers\WebController@addtolist');
Route::get('/addlist/view', 'App\Http\Controllers\WebController@addToListView')->name('addToListView');

Route::get('/offer', 'App\Http\Controllers\WebController@offer');

Route::get('storage/{filename}', function ($filename){
    $path = base_path('public/admin/img/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});


Auth::routes();
