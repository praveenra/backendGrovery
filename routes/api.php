
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('register','App\Http\Controllers\Api\UsersController@register');
Route::post('login','App\Http\Controllers\Api\UsersController@login');
Route::get('get_contact_us','App\Http\Controllers\Api\UsersController@getContactUs');
Route::post('deliveryidcheck','App\Http\Controllers\Api\UsersController@deliveryidcheck');
Route::post('otpverify','App\Http\Controllers\Api\UsersController@otpverify');
Route::post('cash-free-token','App\Http\Controllers\Api\UsersController@cashFreeToken');
Route::post('delivery-fee-calculation','App\Http\Controllers\Api\UsersController@deliveryFeeCalculation');
Route::post('delivery-fee-calculation_v1','App\Http\Controllers\Api\UsersController@deliveryFeeCalculation_v1');
Route::post('delivery-fee-calculation_v2','App\Http\Controllers\Api\UsersController@deliveryFeeCalculation_v2');

Route::get('store_search/{sd_name}', 'App\Http\Controllers\Api\CartController@store_search');

Route::get('main_category/{mc_name}', 'App\Http\Controllers\Api\CartController@main_category_search');

Route::get('product_search/{product_name}', 'App\Http\Controllers\Api\CartController@product_search');

Route::get('product_store_search/{sd_sname}', 'App\Http\Controllers\Api\CartController@product_store_search');

Route::post('get_cust_zones','App\Http\Controllers\Api\UsersController@getCustomerNearbyZones');

Route::post('get-zone-stores','App\Http\Controllers\Api\UsersController@getZoneStore');
Route::get('customerlist','App\Http\Controllers\Api\UsersController@customerlist');
Route::post('deviceid','App\Http\Controllers\Api\UsersController@deviceid');
Route::post('forgotpassword','App\Http\Controllers\Api\UsersController@forgotpassword');
Route::post('verifyotp','App\Http\Controllers\Api\UsersController@verifyotp');
Route::post('sendotp','App\Http\Controllers\Api\UsersController@sendotp');
Route::get('logout','App\Http\Controllers\Api\UsersController@logout');

Route::post('globalsearch', 'App\Http\Controllers\Api\CartController@globalsearch');
Route::post('storetimings', 'App\Http\Controllers\Api\CartController@storetimings');
Route::get('shop_information_v1', 'App\Http\Controllers\Api\CartController@shopInformationv1');
Route::get('get_city_list', 'App\Http\Controllers\Api\UsersController@getCityList');
Route::get('get_delivery_slots', 'App\Http\Controllers\Api\UsersController@getDeliverySlots');

Route::group(['middleware' => ['auth:api,customer-api']], function () {
	Route::get('maincategory','App\Http\Controllers\Api\CartController@maincategory');
	Route::get('store/maincategory','App\Http\Controllers\Api\CartController@store');
	Route::get('store_products', 'App\Http\Controllers\Api\CartController@storeProducts');
	Route::get('list', 'App\Http\Controllers\Api\CartController@list');
	Route::get('store_review', 'App\Http\Controllers\Api\CartController@storeReview');
	Route::get('shop_information', 'App\Http\Controllers\Api\CartController@shopInformation');
	Route::get('store_categories_offers', 'App\Http\Controllers\Api\CartController@offers');
	Route::get('product_view', 'App\Http\Controllers\Api\CartController@productView');
	Route::get('coupon', 'App\Http\Controllers\Api\CartController@coupon');
	Route::get('pages', 'App\Http\Controllers\Api\CartController@pages');
	Route::get('faq', 'App\Http\Controllers\Api\CartController@faq');
	Route::get('membership', 'App\Http\Controllers\Api\CartController@membership');
	Route::get('search', 'App\Http\Controllers\Api\CartController@search');

	Route::get('subcategories', 'App\Http\Controllers\Api\CartController@subcategories');
	Route::get('products', 'App\Http\Controllers\Api\CartController@products');
	Route::get('offer_subcategories', 'App\Http\Controllers\Api\CartController@offerSubcategories');
	Route::get('offer_products', 'App\Http\Controllers\Api\CartController@offerProducts');
	Route::get('get_subsubcategories', 'App\Http\Controllers\Api\CartController@get_subsubcategories');

	Route::get('store_categories_data', 'App\Http\Controllers\Api\CartController@storeCategoriesFirstData');
	Route::get('store_categories', 'App\Http\Controllers\Api\CartController@storeCategories');
	Route::get('store_sub_categories', 'App\Http\Controllers\Api\CartController@storeSubCategories');
	Route::get('store_sub_sub_categories', 'App\Http\Controllers\Api\CartController@storeSubSubCategories');
	Route::get('all_products', 'App\Http\Controllers\Api\CartController@allProducts');

	Route::get('get_measurement', 'App\Http\Controllers\Api\CartController@getMeasurement');
	Route::get('total_item', 'App\Http\Controllers\Api\CartController@totalItem');
	Route::get('store_products_filter', 'App\Http\Controllers\Api\CartController@storeProductsFilter');

	Route::get('offer_store_categories_data', 'App\Http\Controllers\Api\CartController@storeCategoriesFirstDataOffer');
	Route::get('offer_store_categories', 'App\Http\Controllers\Api\CartController@storeCategoriesOffer');
	Route::get('offer_store_sub_categories', 'App\Http\Controllers\Api\CartController@storeSubCategoriesOffer');
	Route::get('offer_store_sub_sub_categories', 'App\Http\Controllers\Api\CartController@storeSubSubCategoriesOffer');
	Route::get('offer_all_products', 'App\Http\Controllers\Api\CartController@allProductsOffer');
    Route::get('deliveryboyprofile','App\Http\Controllers\Api\UsersController@deliveryboyprofile');
    Route::get('deliveryboyorderdetails','App\Http\Controllers\Api\UsersController@deliveryboyorderdetails');
    Route::post('updateproductsreview','App\Http\Controllers\Api\UsersController@updateproductsreview');
	Route::post('getorderreviewlist','App\Http\Controllers\Api\UsersController@getorderreviewlist');
	Route::post('getorderreviewlist_v1','App\Http\Controllers\Api\UsersController@getorderreviewlist_v1');
	Route::post('updatedutystatus','App\Http\Controllers\Api\UsersController@updatedutystatus');
	Route::post('generateordersellerotp','App\Http\Controllers\Api\UsersController@generateordersellerotp');
	Route::post('orderotpverify','App\Http\Controllers\Api\UsersController@orderotpverify');
	Route::get('groverysettings','App\Http\Controllers\Api\UsersController@groverysettings');
	Route::post('sellertimings','App\Http\Controllers\Api\UsersController@sellertimings');
	Route::get('arealists','App\Http\Controllers\Api\UsersController@arealists');
});


Route::group(['middleware' => ['auth:customer-api']], function () {
	Route::get('customer_details','App\Http\Controllers\Api\UsersController@customerDetails');
	Route::post('set_address', 'App\Http\Controllers\Api\UsersController@setAddress');
	Route::post('update_customer','App\Http\Controllers\Api\UsersController@updateCustomer');

	Route::get('customer_address','App\Http\Controllers\Api\UsersController@customerAddress');
	Route::post('add_customer_address','App\Http\Controllers\Api\UsersController@addCustomerAddress');
	Route::post('update_customer_address','App\Http\Controllers\Api\UsersController@updateCustomerAddress');
	Route::post('delete_customer_address','App\Http\Controllers\Api\UsersController@deleteCustomerAddress');

	Route::post('add_customer_review','App\Http\Controllers\Api\UsersController@addCustomerReview');
	Route::post('update_customer_review','App\Http\Controllers\Api\UsersController@updateCustomerReview');
	Route::post('delete_customer_review','App\Http\Controllers\Api\UsersController@deleteCustomerReview');

	Route::post('add_product_review','App\Http\Controllers\Api\UsersController@addProductReview');
	Route::post('update_product_review','App\Http\Controllers\Api\UsersController@updateProductReview');
	Route::post('delete_product_review','App\Http\Controllers\Api\UsersController@deleteProductReview');

	Route::post('add_to_list','App\Http\Controllers\Api\UsersController@addToList');
	Route::get('get_add_to_list','App\Http\Controllers\Api\UsersController@addToListView');
	Route::get('get_add_to_list_detailed','App\Http\Controllers\Api\UsersController@addToListViewDetail');
	Route::post('change_list_quantity','App\Http\Controllers\Api\UsersController@changeListQuantity');

	Route::post('add_all_to_cart','App\Http\Controllers\Api\UsersController@addAllToCart');
	Route::post('add_to_cart','App\Http\Controllers\Api\UsersController@addToCart');
	Route::post('add_to_cart_product','App\Http\Controllers\Api\UsersController@addToCartFromProduct');
	Route::post('change_cart_quantity','App\Http\Controllers\Api\UsersController@changeCartQuantity');
	Route::get('cart_list','App\Http\Controllers\Api\UsersController@cartList');

	Route::post('checkout','App\Http\Controllers\Api\UsersController@checkout');
	Route::post('payment','App\Http\Controllers\Api\UsersController@payment');
	Route::get('order_summary','App\Http\Controllers\Api\UsersController@orderSummary');

	Route::get('orders','App\Http\Controllers\Api\UsersController@orders');
	Route::get('track_order','App\Http\Controllers\Api\UsersController@trackOrder');
	Route::get('track_order_items','App\Http\Controllers\Api\UsersController@trackOrderItems');

	Route::post('reorder','App\Http\Controllers\Api\UsersController@reorder');

	Route::get('notifications','App\Http\Controllers\Api\UsersController@notifications');
	Route::post('read_notifications','App\Http\Controllers\Api\UsersController@readNotifications');

	Route::post('add_membership_users','App\Http\Controllers\Api\UsersController@addMembershipUsers');
	Route::get('membership_users_list','App\Http\Controllers\Api\UsersController@MembershipUsersList');

	Route::get('customer_membership_list','App\Http\Controllers\Api\UsersController@CustomerMembershipList');

	// Route::get('store_review','App\Http\Controllers\Api\UsersController@StoreReview');
	Route::get('product_review','App\Http\Controllers\Api\UsersController@ProductReview');

	Route::get('maincategory_must_store_details_list','App\Http\Controllers\Api\UsersController@MaincategoryMustStoreDetailsList');

	Route::post('update_profile_image','App\Http\Controllers\Api\UsersController@updateProfileImage');
	Route::post('add_profile_image','App\Http\Controllers\Api\UsersController@AddProfileImage');
	Route::get('get_profile_image','App\Http\Controllers\Api\UsersController@getProfileImage');
});