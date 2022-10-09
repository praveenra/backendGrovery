<?php

    namespace App\Http\Controllers\Api;

    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use App\Models\Common;
    use App\Models\Customer;
    use App\Models\CustomerAddress;
    use App\Models\Review;
    use App\Models\ProductReview;
    use App\Models\deviceid;
    use App\Models\Products;
    use App\Models\AddToList;
    use App\Models\Addtocart;
    use App\Models\Checkout;
    use App\Models\Order;
    use App\Models\Notification;
    use App\Models\ProductQuantity;
    use App\Models\Seller;
    use App\Models\Maincategory;
    use App\Models\MembershipUser;
    use App\Models\User;
    use PeterPetrus\Auth\PassportToken;
    use App\Models\Banner;
    use App\Models\City;
    use App\Models\BankDetail;
    use App\Models\Settings;
	use App\Models\Zone;
    use App\Models\OrderStatus;
    use App\Models\OrderReview;
    use App\Models\dutystatus;
    use App\Models\Orderotp;
    use App\Models\Category;
    use App\Models\DeliverySetting;
    use App\Models\Area;
    use App\Models\Deliveryinfo;
    use App\Models\StoresDeliveryTime;
    use App\Models\AreaBanner;
use Carbon\Carbon;
    use DB;
    use Auth;
    use Mail;
    use Input;

    class UsersController extends Controller
    {

        public function customerlist()
        {
           $customer=Customer::all();
           return response()->json([
                'status' => true,
                'data' => $customer,
                'message' => ''
            ]);
        }

        // Add Device ID

      public function deviceid(Request $request)
        {
            $deviceid=$request->deviceid;
            $deviceid1=new deviceid;
            $deviceid1->deviceid=$deviceid;
            $deviceid1->save();
            $accessToken =$deviceid1->createToken('deviceid')->accessToken;
            $id=$deviceid1->id;
            $deviceiddata=deviceid::where('id',$id)->update(['token'=>$accessToken]);
            $banner_list=Banner::where('banner_status',1)->where('default_image',0)->first();
            if($banner_list){
                $banner_image=$banner_list->banner_image;
            }else{
                $banner_image='';
            }
            return response()->json(['status'=>true,
                'deviceid'=>$deviceid,
                'token'=>$accessToken,
                'data'=>$deviceiddata,
                'banner'=>$banner_image,
                'message'=>'Token generated successfully'
            ]);
        }

        // Register

        public function register(Request $request)
        {
             $check_exists = Customer::where('email', $request->email)->first();
             $check_Phonenumber_exists = Customer::where('phone_no', $request->phone_no)->first();
            if($check_exists){
                $data = (object) [];
                return response()->json([
                    'status' => false,
                    'data' => $data,
                    'message' => 'The email has already exists'
                ]);
            }

            if($check_Phonenumber_exists){
                $data = (object) [];
                return response()->json([
                    'status' => false,
                    'data' => $data,
                    'message' => 'The phone number has already exists'
                ]);
            }

            $generate_otp = mt_rand(1000,9999);
            $user = new Customer;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->status = 1;
            $user->otp = $generate_otp;
            $user->phone_no = $request->phone_no;
            $user->fcm_id=$request->fcm_id;



            if($user->save()){

                Mail::send('email.customer_registration',
                    ['user' => $user],
                    function($message) use ($user){
                        $message->to($user->email);
                        $message->subject("Welcome to Grovery");
                    }
                );

                $sendotp = [
                    'generate_otp' => $generate_otp
                ];
             //   \Mail::to($request->email)->send(new \App\Mail\VerificationMail($sendotp));
                $data['token'] = $user->createToken('Grovery')->accessToken;
                return response()->json([
                    'status' => true,
                    'data' => $user,
                    'token_data' => $data,
                    'message' => 'Account created successfully. Kindly check your email for otp'
                ]);

                $notification = new Notification;
                $notification->customer_id = $user->id;
                $notification->message = 'Welcome to Grovery';
                $notification->title = 'Register';
                $notification->created_at = now();
                $notification->save();


            }
            else{
                $data = (object) [];
                return response()->json([
                    'status' => false,
                    'data' => $data,
                    'message' => 'User Registration Failed'
                ]);
            }
        }

        // Send Otp to registered Phone Number

        public function sendotp(Request $request)
        {
            $phone_no = $request->phone_no;
            if(!empty($phone_no))
            {
                $generate_otp = mt_rand(1000,9999);
                $user = Customer::where('phone_no', $phone_no)->first();
                $user->otp = $generate_otp;

                if($user->save()){
                    $sendotp = [
                        'generate_otp' => $generate_otp
                    ];
                   // \Mail::to($email)->send(new \App\Mail\VerificationMail($sendotp));

                    return response()->json([
                        'status' => true,
                        'otp' => $generate_otp,
                        'message' => 'Kindly check your message for otp'
                    ]);
                }
            }
            else{
                return response()->json([
                    'status' => false,
                    'message' => 'Phone no is required'
                ]);
            }
        }


        // Verify Otp which is sent to registered Phone Number

        public function verifyotp(Request $request)
        {

            $user1=Customer::where('otp','=',$request->otp)->where('phone_no','=',$request->phone_no)->first();
            $count=Customer::where('otp','=',$request->otp)->where('phone_no','=',$request->phone_no)->count();
            //print_r($user);exit;
            if($count==1)
            {
                \Auth::login($user1);
                $user = Auth::user();

                $verified = Customer::where('phone_no','=',$request->phone_no)->update(['verified' => 1]);

                $data['token'] = $user->createToken('Grovery')->accessToken;  //dd($data);
                return response()->json([
                'status' =>true,
                'loggedin_user' => $user1,
                'data' => $data,
                'message' => ''
                ]);
            }
            else
            {
                return response()->json([
                'status' =>'false',
                'message' =>'otp does not match'
                ]);
            }
        }

        public function login(Request $request)
        {
            $mobile_no=$request->mobile_no;
            $fcm_id=$request->fcm_id;

            $user1=Customer::where('phone_no','=',$mobile_no)->first();
            $count=Customer::where('phone_no','=',$mobile_no)->count();
            //print_r($user);exit;
            if($count==1)
            {
                $user2=Customer::where('phone_no','=',$mobile_no)->where('verified',1)->first();
                               $banner_list=Banner::where('banner_status',1)->where('default_image',0)->first();
                if($banner_list){
                    $user2['banner']=$banner_list->banner_image;
                }else{
                    $user2['banner']='';
                }

                $verified_count=Customer::where('phone_no','=',$mobile_no)->where('verified',1)->count();

                if($verified_count == 1){
                    \Auth::login($user2);
                    $user = Auth::user();

                    $data['token'] = $user->createToken('Grovery')->accessToken;  //dd($data);
                    return response()->json([
                        'status' =>true,
                        'loggedin_user' => $user2,
                        'data' => $data,
                        'message' => ''
                    ]);
                }else{
                    return response()->json([
                        'status' =>false,
                        'message' => 'VerifyOTP'
                    ]);
                }
            }
            else{
                return response()->json([
                    'status' => false,
                    'message' => 'Mobile Number is invalid'
                ]);
                return response()->json(['error'=>'Unauthorised'], 401);
            }
        }

        //User Profile

        public function customerDetails(Request $request)
        {

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    if($id!=""){
                        $customer = Customer::where('id',$id)->first();
                        return response()->json([
                            'status' => true,
                            'data' => $customer
                        ]);
                    }
                    else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }
                }
            }
        }

        //Update Profile

        public function updateCustomer(Request $request)
        {

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    if($id!=""){
                      $dateFormat=$request->dob;
                       $dob = Carbon::parse($dateFormat)->format('d-m-Y');

                        $updateCustomer = Customer::find($id);
                        $updateCustomer->name = $request->name;
                        $updateCustomer->phone_no = $request->phone_no;
                        $updateCustomer->email = $request->email;
                        //$updateCustomer->dob = $request->dob;
                          $updateCustomer->dob = $dob;
                        $updateCustomer->save();

                        return response()->json([
                            'status' => true,
                            'data' => $updateCustomer,
                            'message' => 'Customer Updated'
                        ]);
                    }else{
                         return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }
                }
            }
        }

        // User Address List

        public function customerAddress(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    if($id!=""){
                     $address = CustomerAddress::select('customer_addresses.*','customer.name','area.area_id','area.area_name')->leftjoin('customer','customer.id','customer_addresses.customer_id')->leftjoin('area','area.area_id','customer_addresses.area')->where('customer_addresses.customer_id',$id)->get();

                        return response()->json([
                            'status' => true,
                            'data' => $address,
                            'message' => 'Customer Address List'
                        ]);
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }
                }
            }
        }

        // Set Default Address

        public function setAddress(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    $address_id = $request->address_id;
                    if($id!=""){
                        $count = CustomerAddress::where('customer_id',$id)->where('id',$address_id)->count();

                        if($count == 0){
                            return response()->json([
                                'status'=>false,
                                'message'=>'Address does not exist'
                            ]);
                        }else{
                            $address = CustomerAddress::where('customer_id',$id)->update(['select' => 0]);
                            $update_address = CustomerAddress::where('customer_id',$id)->where('id',$address_id)->first();
                            $update_address->select = 1;
                            $update_address->save();

                            return response()->json([
                                'status' => true,
                                'message' => 'Default address is set'
                            ]);
                        }

                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }
                }
            }
        }

        // Add Customer Address
            public function addCustomerAddress(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    if($id!=""){
                        $customer_address = new CustomerAddress;
                        $customer_address->customer_id = $id;
                        $customer_address->address = $request->address;
                        $customer_address->landmark = $request->landmark;
                        $customer_address->address_type = $request->address_type;
                        $customer_address->mobile_no = $request->mobile_no;
                        $customer_address->area = $request->areaid;
                        $customer_address->save();
                        $customer_address = CustomerAddress::where('id',$customer_address->id)->with('area')->first();
                        return response()->json([
                            'status' => true,
                            'data' => $customer_address,
                            'message' => 'Customer Address Added'
                        ]);
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }
                }
            }
        }


        // Update Customer Address

        public function updateCustomerAddress(Request $request)
        {

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    $address_id = $request->id;
                    if($id!=""){
                        $count=CustomerAddress::where('id',$address_id)->where('customer_id',$id)->count();
                        if($count==0)
                        {
                            return response()->json([
                                'status'=>false,
                                'message'=>'Address Does Not Exist'
                            ]);
                        }else{

                            $customer_address = CustomerAddress::where('id',$address_id)->with('area')->first();
                            $customer_address->customer_id = $id;
                            $customer_address->address = $request->address;
                            $customer_address->landmark = $request->landmark;
                            $customer_address->address_type = $request->address_type;
                            $customer_address->mobile_no = $request->mobile_no;
                            $customer_address->area = $request->areaid;
                            $customer_address->save();
                            $customer_address = CustomerAddress::where('id',$address_id)->with('area')->first();
                            return response()->json([
                                'status' => true,
                                'data' => $customer_address,
                                'message' => 'Customer Address Updated'
                            ]);
                        }
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }
                }
            }
        }


        //Delete Customer Address

        public function deleteCustomerAddress(Request $request)
        {

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    $address_id = $request->id;
                    if($id!=""){
                        $count=CustomerAddress::where('id',$address_id)->where('customer_id',$id)->count();
                        if($count==0)
                        {
                             return response()->json([
                                'status'=>false,
                                'message'=>'Address Does Not Exist'
                            ]);
                        }else{
                            $customer_address = CustomerAddress::where('id',$address_id)->where('customer_id',$id)->delete();
                            return response()->json([
                                'status' => true,
                                'message' => 'Customer Address Deleted'
                            ]);
                        }
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }
                }
            }
        }

        // Add Store Review

        public function addCustomerReview(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    $seller_id = $request->sid;
                    $add_review = $request->review;
                    $rating = $request->rating;
                    if($id!=""){
                        $review = new Review;
                        $review->store_id = $seller_id;
                        $review->customer_id = $id;
                        $review->review = $add_review;
                        $review->rating = $rating;
                        $review->created_at = now();
                        $review->updated_at = NULL;
                        $review->save();

                        return response()->json([
                            'status' => true,
                            'message' => 'Review added for store'
                        ]);

                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }
                }
            }
        }

        // Update Store Review

        public function updateCustomerReview(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    $review_id = $request->id;
                    $seller_id = $request->sid;
                    $add_review = $request->review;
                    $rating = $request->rating;
                    if($id!=""){
                        $count = Review::where('id',$review_id)->where('customer_id',$id)->count();
                        if($count == 0){
                            return response()->json([
                                'status'=>false,
                                'message'=>'Review Does not Exist'
                            ]);
                        }else{
                            $review = Review::where('id',$review_id)->where('customer_id',$id)->first();
                            $review->store_id = $seller_id;
                            $review->customer_id = $id;
                            $review->review = $add_review;
                            $review->rating = $rating;
                            $review->updated_at = now();
                            $review->save();

                            return response()->json([
                                'status' => true,
                                'message' => 'Review Updated'
                            ]);
                        }
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }
                }
            }
        }

        //Delete Store Review

        public function deleteCustomerReview(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    $review_id = $request->id;
                    if($id!=""){
                        $count = Review::where('id',$review_id)->where('customer_id',$id)->count();
                        if($count == 0){
                            return response()->json([
                                'status'=>false,
                                'message'=>'Review Does not Exist'
                            ]);
                        }else{
                            $review = Review::where('id',$review_id)->where('customer_id',$id)->delete();

                            return response()->json([
                                'status' => true,
                                'message' => 'Review Deleted'
                            ]);

                        }
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }
               }
            }
        }

        // Add Product Review

        public function addProductReview(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    $product_id = $request->product_id;
                    $add_review = $request->review;
                    $rating = $request->rating;
                    if($id!=""){
                        $review = new ProductReview;
                        $review->product_id = $product_id;
                        $review->customer_id = $id;
                        $review->review = $add_review;
                        $review->rating = $rating;
                        $review->created_at = now();
                        $review->updated_at = NULL;
                        $review->save();

                        return response()->json([
                            'status' => true,
                            'message' => 'Review added for Product'
                        ]);

                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }
                }
            }
        }

        // Update Product Review

        public function updateProductReview(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    $review_id = $request->id;
                    $product_id = $request->product_id;
                    $add_review = $request->review;
                    $rating = $request->rating;
                    if($id!=""){
                        $count = ProductReview::where('id',$review_id)->where('customer_id',$id)->count();
                        if($count == 0){
                            return response()->json([
                                'status'=>false,
                                'message'=>'Review Does not Exist'
                            ]);
                        }else{
                            $review = ProductReview::where('id',$review_id)->where('customer_id',$id)->first();
                            $review->product_id = $product_id;
                            $review->customer_id = $id;
                            $review->review = $add_review;
                            $review->rating = $rating;
                            $review->updated_at = now();
                            $review->save();

                            return response()->json([
                                'status' => true,
                                'message' => 'Review Updated'
                            ]);
                        }
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }
                }
            }
        }

        // Delete Product Review

        public function deleteProductReview(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    $review_id = $request->id;
                    if($id!=""){
                        $count = ProductReview::where('id',$review_id)->where('customer_id',$id)->count();
                        if($count == 0){
                            return response()->json([
                                'status'=>false,
                                'message'=>'Review Does not Exist'
                            ]);
                        }else{
                            $review = ProductReview::where('id',$review_id)->where('customer_id',$id)->delete();

                            return response()->json([
                                'status' => true,
                                'message' => 'Review Deleted'
                            ]);

                        }
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }
               }
            }
        }

        // Add Product to List

        public function addToList(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    $store_id = $request->store_id;
                    $product_id = $request->product_id;
                    $product_quantity_id = $request->product_quantity_id;
                    if($id!=""){
                        $count = Products::where('product_id',$product_id)->where('seller_id',$store_id)->count();
                        if($count == 0){
                            return response()->json([
                                'status'=>false,
                                'message'=>'Product Does not Exist'
                            ]);
                        }else{

                            $product_quantity = ProductQuantity::where('id',$product_quantity_id)->pluck('quantity')->first();
                            $check_quantity = $product_quantity - 1;
                            if($check_quantity < 0){
                                return response()->json([
                                    'status'=>false,
                                    'message'=>'Product is out of stock',
                                ]);
                            }else{

                                $category_id = Products::where('product_id',$product_id)->pluck('product_category_id')->first();

                                $check_product = AddToList::where('product_id',$product_id)->where('customer_id',$id)->where('product_quantity_id',$product_quantity_id)->where('status',0)->count();

                                if($check_product == 0){

                                    $add_to_list = new AddToList;
                                    $add_to_list->store_id = $store_id;
                                    $add_to_list->customer_id = $id;
                                    $add_to_list->product_id = $product_id;
                                    $add_to_list->category_id = $category_id;
                                    $add_to_list->product_quantity_id = $product_quantity_id;
                                    $add_to_list->quantity = 1;
                                    $add_to_list->status = 0;
                                    $add_to_list->save();

                                    return response()->json([
                                        'status' => true,
                                        'message' => 'Product Added to List'
                                    ]);

                                }else{

                                    $add_list_quantity = AddToList::where('status',0)->where('product_id',$product_id)->where('customer_id',$id)->where('product_quantity_id',$product_quantity_id)->pluck('quantity')->first();
                                    $add_list = AddToList::where('status',0)->where('product_id',$product_id)->where('product_quantity_id',$product_quantity_id)->where('customer_id',$id)->first();
                                    $add_list->quantity = $add_list_quantity + 1;
                                    $add_list->save();

                                    return response()->json([
                                        'status' => true,
                                        'message' => 'Product Added to List'
                                    ]);

                                }

                            }


                        }
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }
                }
            }
        }

        // Added Main Categories in Add List

        public function addToListView(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    if($id!=""){
                        $count = AddToList::where('customer_id',$id)->count();
                        if($count == 0){
                            return response()->json([
                                'status'=>false,
                                'message'=>'No Products found in list'
                            ]);
                        }else{

                            // Add List Categories

                            $add_to_list_categories_count = AddToList::select('main_category.*')->leftjoin('seller_details','seller_details.sd_usid','add_to_list.store_id')->leftjoin('main_category','main_category.mc_id','seller_details.main_category')->where('add_to_list.status',0)->where('customer_id', $id)->count();

                            if($add_to_list_categories_count != 0){
                                $add_to_list_categories = AddToList::select('main_category.*')->leftjoin('seller_details','seller_details.sd_usid','add_to_list.store_id')->leftjoin('main_category','main_category.mc_id','seller_details.main_category')->where('add_to_list.status',0)->where('customer_id', $id)->groupBy('main_category.mc_id')->get();

                                return response()->json([
                                    'status' => true,
                                    'main_categories' => $add_to_list_categories,
                                    'message' => 'Added List'
                                ]);

                            }else{
                                return response()->json([
                                    'status' => false,
                                    'message' => 'No Categories Found'
                                ]);
                            }
                        }
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }
                }
            }
        }

        // Added Product List in Add List

        public function addToListViewDetail(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    $main_id = $request->main_id;
                    if($id!=""){
                        $count = AddToList::where('customer_id',$id)->count();
                        if($count == 0){
                            return response()->json([
                                'status'=>false,
                                'message'=>'No Products found in list'
                            ]);
                        }else{

                           $sellers_count = Seller::where('main_category',$main_id)->count();
                           if($sellers_count != 0){
                                $sellers = AddToList::select(
                                    'seller_details.*',
                                    'main_category.mc_name'
                                )
                                ->leftjoin('seller_details','seller_details.sd_usid','add_to_list.store_id')
                                ->leftjoin('main_category','main_category.mc_id','seller_details.main_category')
                                ->where('seller_details.main_category',$main_id)
                                ->where('add_to_list.customer_id',$id)
                                ->where('add_to_list.status',0)
                                ->groupBy('seller_details.sd_usid')
                                ->get();

                                $result = [];
                                foreach ($sellers as $value) {

                                    $list_products = AddToList::select('add_to_list.id as list_id','product.*','add_to_list.quantity','product_quantity.measurement','product_quantity.id as pro_quantity_id')->leftjoin('product','product.product_id','add_to_list.product_id')->leftjoin('product_quantity','product_quantity.id','add_to_list.product_quantity_id')->where('add_to_list.customer_id',$id)->where('store_id',$value->sd_usid)->where('add_to_list.status',0)->get();

                                    $new_product = [];
                                    foreach ($list_products as $key => $data) {

                                        $product_quantity = ProductQuantity::where('id',$data->pro_quantity_id)->first();
                                        $new_product[] = [
                                            'product_id' => $data['product_id'],
                                            'product_name' => $data['product_name'],
                                            'main_image' => $data['main_image'],
                                            'product_tax' => $data['product_tax'],
                                            'product_price' => $product_quantity['price'],
                                            'product_offer' => $product_quantity['offer'],
                                            'product_sales_price' => $product_quantity['sales_price'],
                                            'quantity' => $data['quantity'],
                                            'measurement' => $data['measurement'],
                                            'product_quantity_id' => $data['pro_quantity_id'],
                                            'list_id' => $data['list_id'],
                                        ];
                                    }

                                    $data = [
                                        "sd_id" => $value->sd_id,
                                        "sd_usid" => $value->sd_usid,
                                        "sd_sname" => $value->sd_sname,
                                        "main_category" => $value->main_category,
                                        "main_category_name" => $value->mc_name,
                                        "sd_snumber" => $value->sd_snumber,
                                        "sd_sadminshare" => $value->sd_sadminshare,
                                        "sd_scityid" => $value->sd_scityid,
                                        "sd_sdeliverykm" => $value->sd_sdeliverykm,
                                        "sd_spincode" => $value->sd_spincode,
                                        "sd_address" => $value->sd_address,
                                        "store_image" => $value->store_image,
                                        "store_logo" => $value->store_logo,
                                        "sd_status" => $value->sd_status,
                                        "created_by" => $value->created_by,
                                        "updated_by" => $value->updated_by,
                                        "products" => $new_product
                                    ];

                                    $result[] = $data;

                                }

                                return response()->json([
                                    'status'=>true,
                                    'data'=> $result,
                                    'message'=> 'Add List Stores & Product'
                                ]);
                            }else{
                                return response()->json([
                                    'status'=>false,
                                    'message'=> 'No stores found'
                                ]);
                            }
                        }
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }
                }
            }
        }

        public function addToCart(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    $store_id = $request->store_id;
                    $product_id = $request->product_id;
                    $product_quantity_id = $request->product_quantity_id;
                    $product_count = $request->quantity;
                    if($id!=""){
                        $count = Products::where('product_id',$product_id)->count();
                        if($count == 0){
                            return response()->json([
                                'status'=>false,
                                'message'=>'Product Does not Exist'
                            ]);
                        }else{

                            $product_quantity = ProductQuantity::where('id',$product_quantity_id)->pluck('quantity')->first();
                            $check_quantity = $product_quantity - $product_count;
                            if($check_quantity <= 0){
                                return response()->json([
                                    'status'=>false,
                                    'message'=>'Product is out of stock',
                                ]);
                            }else{
                                $check_product = Addtocart::where('product_id',$product_id)->where('customer_id',$id)->where('status',0)->count();
                                $product_price = ProductQuantity::where('product_id',$product_id)->where('id',$product_quantity_id)->pluck('sales_price')->first();
                                $total_price = $product_count * $product_price;


                                if($check_product == 0){
                                    $add_to_cart = new Addtocart;
                                    $add_to_cart->store_id = $store_id;
                                    $add_to_cart->customer_id = $id;
                                    $add_to_cart->product_id = $product_id;
                                    $add_to_cart->product_quantity_id = $product_quantity_id;
                                    $add_to_cart->product_count = $product_count;
                                    $add_to_cart->total_price = $total_price;
                                    $add_to_cart->status = 0;
                                    $add_to_cart->save();

                                }else{

                                    $old_product_count =  Addtocart::where('product_id',$product_id)->where('customer_id',$id)->where('product_quantity_id',$product_quantity_id)->where('status',0)->pluck('product_count')->first();
                                    $old_total_price =  Addtocart::where('product_id',$product_id)->where('customer_id',$id)->where('product_quantity_id',$product_quantity_id)->where('status',0)->pluck('total_price')->first();
                                    $add_to_cart = Addtocart::where('product_id',$product_id)->where('customer_id',$id)->where('product_quantity_id',$product_quantity_id)->where('status',0)->first();
                                    if($add_to_cart){
                                    $add_to_cart->product_count = $old_product_count + $product_count;
                                    $add_to_cart->total_price = $old_total_price + $total_price;
                                    $add_to_cart->save();
                                    }

                                }


                                    $update_list = AddToList::where('product_id',$product_id)->where('product_quantity_id',$product_quantity_id)->where('customer_id',$id)->where('status',1)->first();
                                  if($update_list){
                                    $update_list->status = 1;
                                    $update_list->save();
                                  }


                                return response()->json([
                                    'status' => true,
                                    'message' => 'Product Added to Cart'
                                ]);
                            }
                        }
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }
                }
            }
        }

        public function addAllToCart(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    $list_ids = $request->list_ids;
                    if($id!=""){
                        $list_id = explode(',', $list_ids);
                        foreach ($list_id as $value) {
                            $list_data = AddToList::where('id',$value)->first();

                            $store_id = $list_data->store_id;
                            $product_id = $list_data->product_id;
                            $product_quantity_id = $list_data->product_quantity_id;
                            // $product_count = $list_data->quantity;

                            $product_quantity = ProductQuantity::where('id',$product_quantity_id)->first();
                            $check_quantity = $product_quantity - $product_count;
                            if($check_quantity < 0){
                                return response()->json([
                                    'status'=>false,
                                    'message'=>'Product is out of stock',
                                ]);
                            }else{
                                $check_product = Addtocart::where('product_id',$product_id)->where('customer_id',$id)->where('status',0)->count();
                                $product_price = ProductQuantity::where('product_id',$product_id)->where('id',$product_quantity_id)->pluck('sales_price')->first();
                                $total_price = $product_count * $product_price;


                                if($check_product == 0){
                                    $add_to_cart = new Addtocart;
                                    $add_to_cart->store_id = $store_id;
                                    $add_to_cart->customer_id = $id;
                                    $add_to_cart->product_id = $product_id;
                                    $add_to_cart->product_quantity_id = $product_quantity_id;
                                    $add_to_cart->product_count = $product_count;
                                    $add_to_cart->total_price = $total_price;
                                    $add_to_cart->status = 0;
                                    $add_to_cart->save();

                                }else{

                                    $old_product_count =  Addtocart::where('product_id',$product_id)->where('customer_id',$id)->where('product_quantity_id',$product_quantity_id)->where('status',0)->pluck('product_count')->first();
                                    $old_total_price =  Addtocart::where('product_id',$product_id)->where('customer_id',$id)->where('product_quantity_id',$product_quantity_id)->where('status',0)->pluck('total_price')->first();
                                    $add_to_cart = Addtocart::where('product_id',$product_id)->where('customer_id',$id)->where('product_quantity_id',$product_quantity_id)->where('status',0)->first();
                                    $add_to_cart->product_count = $old_product_count + $product_count;
                                    $add_to_cart->total_price = $old_total_price + $total_price;
                                    $add_to_cart->save();
                                }

                                $update_list = AddToList::where('id',$value)->where('status',0)->update(['status' => 1]);
                            }
                        }

                        return response()->json([
                            'status' => true,
                            'message' => 'Product Added to Cart'
                        ]);
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }
                }
            }
        }

        public function changeCartQuantity(Request $request)
        {
            $cart_id=$request->cart_id;
            $quantity=$request->quantity;
            $quantity_key = $request->quantity_key;

            $count = Addtocart::where('id',$cart_id)->where('status',0)->count();
            if($count==0)
            {
                return response()->json([
                    'status'=>false,
                    'message'=>'Cart ID does not exist'
                ]);
            }
            else
            {
                $product_id = Addtocart::where('id',$cart_id)->where('status',0)->first();

                if($quantity_key == 'increment'){
                    $quantity_count = $quantity + 1;
                }else if($quantity_key == 'decrement'){
                    $quantity_count = $quantity - 1;
                }

                $productdata = Products::select('product.*','product_quantity.*')
                ->leftjoin('product_quantity','product_quantity.product_id','product.product_id')
                ->where('product_quantity.product_id',$product_id->product_id)
                ->where('product_quantity.id',$product_id->product_quantity_id)
                ->first();

                $price = $productdata->sales_price;
                $total_price = $price * $quantity_count;

                $cart = Addtocart::where('id',$cart_id)->update(['product_count' => $quantity_count,'total_price' => $total_price]);

                return response()->json([
                    'status'=>true,
                    'quantity'=>$quantity_count,
                    'message'=>'Quantity Updated successfully'
                ]);
            }
        }

        public function changeListQuantity(Request $request)
        {
            $list_id=$request->list_id;
            $quantity=$request->quantity;
            $quantity_key=$request->quantity_key;

            $count = AddToList::where('id',$list_id)->where('status',0)->count();
            if($count==0)
            {
                return response()->json([
                'status'=>false,
                'message'=>'Add List ID does not exist'
                ]);
            }
            else
            {
                $add_list_quantity = AddToList::where('id',$list_id)->first();

                if($quantity_key == 'increment'){
                    $quanity_count = $quantity + 1;
                }else if($quantity_key == 'decrement'){
                    $quanity_count = $quantity - 1;
                }

                $update_quantity = AddToList::where('id',$list_id)->where('status',0)->update(['quantity' => $quanity_count]);

                return response()->json([
                    'status'=>true,
                    'quantity'=>$quanity_count,
                    'message'=>'Quantity Updated successfully'
                ]);
            }
        }

        public function cartList(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    if($id!=""){
                        $count = Addtocart::where('customer_id',$id)->where('status',0)->count();
                        if($count == 0){
                            return response()->json([
                                'status'=>false,
                                'message'=>'Cart Is Empty'
                            ]);
                        }else{
                            $sellers = Addtocart::select('seller_details.*','main_category.mc_name')->leftjoin('seller_details','seller_details.sd_usid','add_tocart.store_id')->leftjoin('main_category','main_category.mc_id','seller_details.main_category')->where('add_tocart.status',0)->where('add_tocart.customer_id',$id)->groupBy('add_tocart.store_id')->get();
                            $result = [];
                            foreach ($sellers as $key => $value) {

                                $list_products = Addtocart::select('add_tocart.id as cart_id','product.*','add_tocart.*','product_quantity.measurement','product_quantity.id as pro_quantity_id')->leftjoin('product','product.product_id','add_tocart.product_id')->leftjoin('product_quantity','product_quantity.id','add_tocart.product_quantity_id')->where('add_tocart.customer_id',$id)->where('store_id',$value->sd_usid)->where('add_tocart.status',0)->get();

                                $new_product = [];
                                foreach ($list_products as $key => $data) {

                                    $product_quantity = ProductQuantity::where('id',$data->pro_quantity_id)->first();
                                    $new_product[] = [
                                        'product_id' => $data['product_id'],
                                        'product_name' => $data['product_name'],
                                        'main_image' => $data['main_image'],
                                        'product_tax' => $data['product_tax'],
                                        'product_quantity_id' => $product_quantity['id'],
                                        'product_price' => $product_quantity['price'],
                                        'product_offer' => $product_quantity['offer'],
                                        'product_sales_price' => $product_quantity['sales_price'],
                                        'measurement' => $data['measurement'],
                                        'quantity' => $data['product_count'],
                                        'cart_id' => $data['cart_id'],
                                    ];
                                }

                                $data = [
                                        "sd_id" => $value->sd_id,
                                        "sd_usid" => $value->sd_usid,
                                        "sd_sname" => $value->sd_sname,
                                        "main_category" => $value->main_category,
                                        "main_category_name" => $value->mc_name,
                                        "sd_snumber" => $value->sd_snumber,
                                        "sd_sadminshare" => $value->sd_sadminshare,
                                        "sd_scityid" => $value->sd_scityid,
                                        "sd_sdeliverykm" => $value->sd_sdeliverykm,
                                        "sd_spincode" => $value->sd_spincode,
                                        "sd_address" => $value->sd_address,
                                        "store_image" => $value->store_image,
                                        "store_logo" => $value->store_logo,
                                        "sd_status" => $value->sd_status,
                                        "created_by" => $value->created_by,
                                        "updated_by" => $value->updated_by,
                                        "products" => $new_product
                                    ];

                                $result[] = $data;


                            }

                            $store_price = Addtocart::select('seller_details.*')->leftjoin('seller_details','seller_details.sd_usid','add_tocart.store_id')->where('customer_id',$id)->where('add_tocart.status',0)->groupBy('add_tocart.store_id')->get();

                            $pr = [];
                            foreach ($store_price as $sprice) {

                                $list_price = Addtocart::where('store_id',$sprice->sd_usid)->where('customer_id',$id)->where('add_tocart.status',0)->sum('total_price');

                                $store_total = [
                                    "sd_usid" => $sprice->sd_usid,
                                    "sd_sname" => $sprice->sd_sname,
                                    "sub_total" => $list_price,
                                ];

                                $pr[] = $store_total;

                            }

                            $total_cart_price = Addtocart::where('customer_id', $id)->where('customer_id',$id)->where('status',0)->sum('total_price');

                            return response()->json([
                                'status'=>true,
                                'data'=> $result,
                                'sub_total' => $pr,
                                'total_cart_price' => $total_cart_price,
                                'message'=> 'Cart List'
                            ]);

                        }
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }
                }
            }
        }

        public function addToCartFromProduct(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    $store_id = $request->store_id;
                    $product_id = $request->product_id;
                    $product_quantity_id = $request->product_quantity_id;
                    $product_count = $request->quantity;

                    if($id!=""){
                        $count = Products::where('product_id',$product_id)->count();
                        if($count == 0){
                            return response()->json([
                                'status'=>false,
                                'message'=>'Product Does not Exist'
                            ]);
                        }else{

                            $product_quantity = ProductQuantity::where('id',$product_quantity_id)->pluck('quantity')->first();
                            $check_quantity = $product_quantity - $product_count;
                            if($check_quantity <= 0){
                                return response()->json([
                                    'status'=>false,
                                    'message'=>'Product is out of stock',
                                ]);
                            }else{
                                $check_product = Addtocart::where('product_id',$product_id)->where('customer_id',$id)->where('status',0)->count();
                                $product_price = ProductQuantity::where('product_id',$product_id)->where('id',$product_quantity_id)->pluck('sales_price')->first();
                                $total_price = $product_count * $product_price;


                                if($check_product == 0){
                                    $add_to_cart = new Addtocart;
                                    $add_to_cart->store_id = $store_id;
                                    $add_to_cart->customer_id = $id;
                                    $add_to_cart->product_id = $product_id;
                                    $add_to_cart->product_quantity_id = $product_quantity_id;
                                    $add_to_cart->product_count = $product_count;
                                    $add_to_cart->total_price = $total_price;
                                    $add_to_cart->status = 0;
                                    $add_to_cart->save();

                                }else{

                                    $old_product_count =  Addtocart::where('product_id',$product_id)->where('customer_id',$id)->where('product_quantity_id',$product_quantity_id)->where('status',0)->pluck('product_count')->first();
                                    $old_total_price =  Addtocart::where('product_id',$product_id)->where('customer_id',$id)->where('product_quantity_id',$product_quantity_id)->where('status',0)->pluck('total_price')->first();
                                    $add_to_cart = Addtocart::where('product_id',$product_id)->where('customer_id',$id)->where('product_quantity_id',$product_quantity_id)->where('status',0)->first();
                                    $add_to_cart->product_count = $old_product_count + $product_count;
                                    $add_to_cart->total_price = $old_total_price + $total_price;
                                    $add_to_cart->save();
                                }

                                return response()->json([
                                    'status' => true,
                                    'message' => 'Product Added to Cart'
                                ]);
                            }
                        }
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }
                }
            }
        }

        public function checkout(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);
            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id = $token1->user_id;
                    $product_id = $request->product_id;
                    $product_quantity_id = $request->product_quantity_id;
                    $cart_id = $request->cart_id;
                    $store_id = $request->store_id;
                    $total = $request->total;

                    $checkout=new Checkout;
                    $checkout->product_id = $product_id;
                    $checkout->product_quantity_id = $product_quantity_id;
                    $checkout->store_id = $store_id;
                    $checkout->customer_id = $id;
                    $checkout->total = $total;
                    $checkout->save();

                    return response()->json([
                        'status'=>true,
                        'checkoutid'=>$checkout->id,
                        'message'=>'Checkout successful'
                    ]);
                }
            }
            else
            {
                return response()->json([
               'status'=>false,
               'message'=>'Invalid Token'
               ]);
            }
        }


        public function orderSummary(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);
            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id = $token1->user_id;


                    $count = CustomerAddress::where('customer_addresses.customer_id',$id)->where('select',1)->count();
                    if($count == 0){

                        return response()->json([
                           'status'=>false,
                           'message'=>'Delivery Address is not available'
                        ]);

                    }else{
                        $delivery_address = CustomerAddress::where('customer_addresses.customer_id',$id)->where('select',1)->first();

                        return response()->json([
                            'status'=>true,
                            'delivery_address'=>$delivery_address,
                        ]);
                    }
                }
            }
            else
            {
                return response()->json([
                   'status'=>false,
                   'message'=>'Invalid Token'
                ]);
            }

        }

       /* public function payment(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    if($id!=""){
                        if($request->payment_type=='Cash'){

                            $checkout=Checkout::find($request->checkout_id);
                            $checkout->payment_type = $request->payment_type;
                            $checkout->payment_status = 'pending';
                            $checkout->save();

                            $cart = Addtocart::where('customer_id',$id)->where('status',0)->get();

                            $address_id = CustomerAddress::where('customer_id',$id)->where('select',1)->pluck('id')->first();


                            foreach ($cart as $key => $data) {

                                $order = new Order;
                                $order->order_id = $request->checkout_id;
                                $order->product_id = $data->product_id;
                                $order->product_quantity_id = $data->product_quantity_id;
                                $order->store_id = $data->store_id;
                                $order->customer_id = $data->customer_id;
                                $order->address_id = $address_id;
                                $order->quantity = $data->product_count;
                                $order->total = $data->total_price;
                                $order->payment_type = 'POD';
                                $order->order_status = 1;
                                $order->order_area = $request->area;
                                $order->save();

                                $quantity = $order->quantity;
                                $product_quantity_id = $order->product_quantity_id;
                                $old_quantity = ProductQuantity::where('id',$product_quantity_id)->pluck('quantity')->first();
                                $new_quantity = $old_quantity - $quantity;
                                $update_quantity = ProductQuantity::where('id',$product_quantity_id)->update(['quantity' => $new_quantity]);

                                $customer = Customer::where('id',$order->customer_id)->first();

                                Mail::send('email.order_placed',
                                    ['customer' => $customer, 'order' => $order],
                                    function($message) use ($customer){
                                        $message->to($customer->email);
                                        $message->subject("Order has been Placed");
                                    }
                                );

                                $notification = new Notification;
                                $notification->customer_id = $id;
                                $notification->message = 'Order has been placed. Order ID -'. $order->order_id;
                                $notification->created_at = now();
                                $notification->save();

                                $update_cart = Addtocart::where('id',$data->id)->update(['status' => 1]);

                            }

                            return response()->json([
                               'status'=>true,
                               'message'=>'Order has been placed'
                            ]);
                        }
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }
                }
            }
        } */


        public function cashFreeToken(Request $request){
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'x-client-id: '.config('app.cash_free_client_id');
            $headers[] = 'x-client-secret: '.config('app.cash_free_client_secret') ;
            $arrayToSend = array('orderId' => $request->order_id, 'orderAmount' => $request->order_amount,'orderCurrency'=>($request->order_currency)?:'INR');
			$json = json_encode($arrayToSend);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, config('app.cash_free_url')."POST");
            // SSL important
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

            $output = curl_exec($ch);
            curl_close($ch);
            $token_output = json_decode($output);
            if($token_output->subCode == 200){
                $response = response()->json([
                    'status'=>true,
                    'cftoken'=>json_decode($output),
                    'message'=>'Token generated'
                 ]);
            } else {
                $response = response()->json([
                    'status'=>false,
                    'message'=>$token_output
                 ]);
            }
            return $response;
        }

        public function deliveryFeeCalculation(Request $request){
            $user_lat = $request->lat;
			$user_lng = $request->lng;
			$unit = ($request->unit)?:'K';
            $store = Seller::where('sd_usid',$request->store_id)->select('sd_lat','sd_lng')->first();
            //dump($store);
            if($store->sd_lat){
                $store_lat = $store->sd_lat;
                $store_lng = $store->sd_lng;
                $distance = $this->distance($user_lat, $user_lng, $store_lat, $store_lng, $unit);
                //dump($distance);
                $delivery_fee = Deliveryinfo::first();
                if(($delivery_fee->business) != "off"){
                    $total_fee = $delivery_fee->base_price;
                    if($distance > $delivery_fee->base_price_distance){
                        $total_fee = $total_fee + ($delivery_fee->price_per_unit_distance * ($distance - $delivery_fee->base_price_distance));
                    }
                    if($delivery_fee->service_tax){
                        $total_fee = $total_fee + ($total_fee * ($delivery_fee->service_tax/100));
                    }
                    $total_fee = $total_fee + (int)($delivery_fee->min_fare)?:0;
                } else {
                    $total_fee = 0;
                }
                $response = response()->json([
                    'status'=>true,
                    'delivery_fee' => $total_fee,
                    'message'=>'delivery fee'
                 ]);
            }else{
                $response = response()->json([
                    'status'=>false,
                    'message'=>'Lat Long need to add for the store'
                 ]);
            }
            return $response;
        }

        public function payment(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    if($id!=""){
                        //if($request->payment_type=='Cash'){

                            $checkout=Checkout::find($request->checkout_id);
                            $checkout->payment_type = $request->payment_type;
                            $checkout->payment_status = $request->payment_status ? $request->payment_status : 'Pending' ;
                            $checkout->save();

                            $cart = Addtocart::where('customer_id',$id)->where('status',0)->get();

                            $address_id = CustomerAddress::where('customer_id',$id)->where('select',1)->pluck('id')->first();


                            foreach ($cart as $key => $data) {

                                $order = new Order;
                                $order->order_id = $request->checkout_id;
                                $order->product_id = $data->product_id;
                                $order->product_quantity_id = $data->product_quantity_id;
                                $order->store_id = $data->store_id;
                                $order->customer_id = $data->customer_id;
                                $order->address_id = $address_id;
                                $order->quantity = $data->product_count;
                                $order->total = $data->total_price;
                                $order->payment_type = 'POD';
                                $order->order_status = 1;
                                $order->order_area = $request->area;
                                $order->save();

                                $quantity = $order->quantity;
                                $product_quantity_id = $order->product_quantity_id;
                                $old_quantity = ProductQuantity::where('id',$product_quantity_id)->pluck('quantity')->first();
                                $new_quantity = $old_quantity - $quantity;
                                $update_quantity = ProductQuantity::where('id',$product_quantity_id)->update(['quantity' => $new_quantity]);

                                $customer = Customer::where('id',$order->customer_id)->first();

                                Mail::send('email.order_placed',
                                    ['customer' => $customer, 'order' => $order],
                                    function($message) use ($customer){
                                        $message->to($customer->email);
                                        $message->subject("Order has been Placed");
                                    }
                                );

                                $notification = new Notification;
                                $notification->customer_id = $id;
                                $notification->message = 'Order has been placed. Order ID -'. $order->order_id;
                                $notification->created_at = now();
                                $notification->save();

                                $update_cart = Addtocart::where('id',$data->id)->update(['status' => 1]);

                            }

                            foreach($request->selected_stores_deliv_time as $deliveryTime){
                                $storesDeliveryTime = new StoresDeliveryTime;
                                $storesDeliveryTime->checkout_id=$request->checkout_id;
                                $storesDeliveryTime->store_id = $deliveryTime['store_id'];
                                $storesDeliveryTime->delivery_time = $deliveryTime['delviery_timing_slot'];
                                $storesDeliveryTime->delivery_day = $deliveryTime['delivery_day'];
                                $storesDeliveryTime->save();

                            }

                            return response()->json([
                               'status'=>true,
                               'message'=>'Order has been placed'
                            ]);
                       // }
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }
                }
            }
        }


        public function orders(Request $request)
        {

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);
            if ($token1->valid) {
                if ($token1->existsValid()) {

                    $id=$token1->user_id;
                    $orders = Order::select(
                        'orders.*',
                        'product.product_name as product',
                        'product.main_image',
                        'seller_details.sd_sname as seller',
                        'order_status.name as order_status_name'
                    )
                    ->leftjoin('product','product.product_id','orders.product_id')
                    ->leftjoin('order_status','order_status.id','orders.order_status')
                    ->leftjoin('seller_details','seller_details.sd_usid','orders.store_id')
                    ->Where('orders.customer_id',$id)
                    ->orderBy('orders.id','DESC')
                    ->get();

               if($orders != '[]'){
                 return response()->json([
                    'status'=> true,
                    'data'=> $orders,
                    'message'=> 'Orders'
                    ]);
               }else{
                return response()->json([
                    'status'=> false,
                    'data'=> "[]",
                    'message'=> 'Orders'
                    ]);
               }
                }
            }
            else
            {
                return response()->json([
               'status'=>false,
               'message'=>'User Does not Exist'
               ]);
            }
        }

        public function trackOrder(Request $request)
        {

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);
            if ($token1->valid) {
                if ($token1->existsValid()) {

                    $id=$token1->user_id;
                    $order_id = $request->id;
                    $order = Order::select(
                        'orders.*',
                        'product.product_name as product',
                        'product.main_image',
                        'seller_details.sd_sname as seller',
                        'order_status.name as order_status_name',
                        'customer_addresses.*'
                    )
                    ->leftjoin('product','product.product_id','orders.product_id')
                    ->leftjoin('order_status','order_status.id','orders.order_status')
                    ->leftjoin('seller_details','seller_details.sd_usid','orders.store_id')
                    ->leftjoin('customer_addresses','customer_addresses.id','orders.address_id')
                    ->Where('orders.customer_id',$id)
                    ->Where('orders.id',$order_id)
                    ->first();

                return response()->json([
                   'status'=> true,
                   'data'=> $order,
                   ]);
                }
            }
            else
            {
                return response()->json([
               'status'=>false,
               'message'=>'User Does not Exist'
               ]);
            }
        }

        public function trackOrderItems(Request $request)
        {

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);
            if ($token1->valid) {
                if ($token1->existsValid()) {

                    $id=$token1->user_id;
                    $order_id = $request->id;
                    $items = Order::select(
                        'order_status.name as order_status_name',
                        'product.main_image',
                        'product.product_name as product',
                        'product_quantity.measurement as measurement',
                        'product_quantity.sales_price as price',
                        'orders.quantity as quantity',
                        'orders.total as subtotal'
                    )
                    ->leftjoin('product','product.product_id','orders.product_id')
                    ->leftjoin('product_quantity','product_quantity.id','orders.product_quantity_id')
                    ->leftjoin('order_status','order_status.id','orders.order_status')
                    ->Where('orders.customer_id',$id)
                    ->Where('orders.id',$order_id)
                    ->first();

                return response()->json([
                   'status'=> true,
                   'items'=> $items,
                   ]);
                }
            }
            else
            {
                return response()->json([
               'status'=>false,
               'message'=>'User Does not Exist'
               ]);
            }
        }

        public function reorder(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);
            if ($token1->valid) {
                if ($token1->existsValid()) {

                    $id=$token1->user_id;
                    $order_id = $request->order_id;

                    $order_data = Order::where('id',$order_id)->first();

                    $cart = new Addtocart;
                    $cart->store_id = $order_data->store_id;
                    $cart->customer_id = $id;
                    $cart->product_id = $order_data->product_id;
                    $cart->product_quantity_id = $order_data->product_quantity_id;
                    $cart->product_count = $order_data->quantity;
                    $cart->total_price = $order_data->total;
                    $cart->status = 0;
                    $cart->save();

                    $checkout = new Checkout;
                    $checkout->product_id = $order_data->product_id;
                    $checkout->product_quantity_id = $order_data->product_quantity_id;
                    $checkout->store_id = $order_data->store_id;
                    $checkout->customer_id = $id;
                    $checkout->total = $order_data->total;
                    $checkout->save();

                return response()->json([
                       'status'=> true,
                       'checkoutid'=>$checkout->id,
                       'message'=>'Checkout successful'
                   ]);
                }
            }
            else
            {
                return response()->json([
               'status'=>false,
               'message'=>'User Does not Exist'
               ]);
            }

        }

    // Logout
    public function logout()
    {
        $accessToken = Auth::user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $revoke = $accessToken->revoke();
        if($revoke){
            return response()->json([
                'status' => true,
                'message' => 'Successfully Logged Out'
            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => 'Logout Failed'
            ]);
        }
    }

        //Notification List

        public function notifications(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);
            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $user_id = $token1->user_id;
                    $count = Notification::where('customer_id',$user_id)->count();
                    $notifications_count = Notification::where('customer_id',$user_id)->where('read_status',0)->count();
                    if($count == 0)
                    {
                        return response()->json([
                            'status'=>false,
                            'message'=>'No Notifications Available'
                        ]);
                    }else{
                        $notifications = Notification::where('customer_id',$user_id)->get();
                        return response()->json([
                            'status'=>true,
                            'data'=>$notifications,
                            'message'=>'Notifications',
                            'notifications_count' => $notifications_count
                        ]);
                    }
                }
            }else{
                return response()->json([
                    'status'=>false,
                    'message'=>'User Does not Exist'
                ]);
            }
        }

        //Read Notification

        public function readNotifications(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);
            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $user_id = $token1->user_id;
                    $notification_id = $request->notification_id;
                    $notifications = Notification::where('id',$notification_id)->where('customer_id',$user_id)->where('read_status',0)->get();
                    $count = Notification::where('id',$notification_id)->where('customer_id',$user_id)->where('read_status',0)->count();
                    if($count == 0)
                    {
                        return response()->json([
                            'status'=>false,
                            'message'=>'No Notifications Available'
                        ]);
                    }else{
                        $notifications = Notification::where('id',$notification_id)->where('customer_id',$user_id)->get();
                        $notifications->read_status = 1;
                        $notifications->save();
                        return response()->json([
                            'status'=>true,
                            'data'=>$notifications,
                            'message'=>'Notifications read'
                        ]);
                    }
                }
            }else{
                return response()->json([
                    'status'=>false,
                    'message'=>'Invalid Token'
                ]);
            }
        }


        public function addMembershipUsers(Request $request){

            $mebership_user_lists  = MembershipUser::select('membership_users.*')
                ->get();

            $membership_users_new = new MembershipUser;
            $membership_users_new->membership_plan_id = $request->membership_plan_id;
            $membership_users_new->users_id = $request->users_id;
            $membership_users_new->plan_duration = $request->plan_duration;

            foreach ($mebership_user_lists as $mebership_user_list) {

                // echo "<pre>";
                // print_r($membership_users_new->membership_plan_id != $mebership_user_list->membership_plan_id && $membership_users_new->users_id != $mebership_user_list->users_id);
                // exit();

                if($membership_users_new->membership_plan_id != $mebership_user_list->membership_plan_id && $membership_users_new->users_id != $mebership_user_list->users_id){

                    $membership_users_new->save();

                    return response()->json([
                        'status' => true,
                        'data' => $membership_users_new,
                        'message' => 'MembershipUser Added'
                    ]);

                }else{
                    return response()->json([
                        'status'=>false,
                        'message'=>'Membership Already Exist'
                    ]);
                }

            }
        }

        public function MembershipUsersList(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    if($id!=""){
                        $mebership_user_list = MembershipUser::select('membership_users.*','membership_plan.*','customer.*')
                        ->leftjoin('membership_plan','membership_plan.id','membership_users.membership_plan_id')
                        ->leftjoin('customer','customer.id','membership_users.id')
                        ->get();

                        return response()->json([
                            'status' => true,
                            'data' => $mebership_user_list,
                            'message' => 'Membership User List'
                        ]);
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }
                }
            }
        }


        public function CustomerMembershipList(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    if($id!=""){
                        $customer_membership_list = Customer::select('customer.*','membership_users.*','membership_plan.*')
                        ->leftjoin('membership_users','membership_users.users_id','customer.id')
                        ->leftjoin('membership_plan','membership_plan.id','membership_users.membership_plan_id')
                        // ->where('plan_name','!=','')
                        ->get();

                        return response()->json([
                            'status' => true,
                            'data' => $customer_membership_list,
                            'message' => 'Customer Membership List'
                        ]);
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }
                }
            }
        }



        public function StoreReview(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    if($id!=""){
                        $store_review = Review::select('reviews.*')
                        ->get();
                     //   $store_review_count = Review::select('reviews.*')
                      //  ->count();
                      //  $store_review_average = Review::select('reviews.*')
                      //  ->avg('rating');

                        return response()->json([
                            'status' => true,
                          //  'store_review_count' => $store_review_count,
                          //  'store_review_average' => $store_review_average,
                            'data' => $store_review,
                            'message' => 'Store Reviews List',

                        ]);
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'Store Reviews Does not Exist'
                        ]);
                    }
                }
            }
        }

        public function ProductReview(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    if($id!=""){
                        $product_review = ProductReview::select('product_reviews.*')
                        ->get();
                        $product_review_count = ProductReview::select('product_reviews.*')
                        ->count();
                        $product_review_average = ProductReview::select('product_reviews.*')
                        ->avg('rating');


                        return response()->json([
                            'status' => true,
                            'store_review_count' => $product_review_count,
                            'store_review_average' => $product_review_average,
                            'data' => $product_review,
                            'message' => 'Product Reviews List',

                        ]);
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'Product Reviews Does not Exist'
                        ]);
                    }
                }
            }
        }

        public function MaincategoryMustStoreDetailsList(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    if($id!=""){

                         $maincategory_must_store_details_list = Seller::select('seller_details.*','main_category.*')
                        ->leftjoin('main_category','main_category.mc_id','seller_details.main_category')
                        // ->orderBy('main_category', 'ASC')
                        ->get();

                         // echo "<pre>";
                         //  print_r($maincategory_must_store_details_list);
                         //  exit();

                        return response()->json([
                            'status' => true,

                            'data' => $maincategory_must_store_details_list,
                            'message' => 'Maincategory Must Store Details List',

                        ]);
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'Maincategory Must Store Details Does not Exist'
                        ]);
                    }
                }
            }
        }

        public function updateProfileImage(Request $request){

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);

            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    if($id!=""){
                        $ProfileImage = User::find($request->id);
                        $ProfileImage->profile_image = $request->profile_image;
                        $ProfileImage->save();

                        return response()->json([
                            'status' => true,
                            'data' => $ProfileImage,
                            'message' => 'Profile Image Updated'
                        ]);
                    }else{
                         return response()->json([
                            'status'=>false,
                            'message'=>'Profile Image Does not Exist'
                        ]);
                    }
                }
            }
        }

        public function getProfileImage(Request $request)
        {

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);
            if ($token1->valid) {
                if ($token1->existsValid()) {

                    $id=$token1->user_id;

                    $ProfileImage=User::select('users.id','users.profile_image')->find($request->id);

                return response()->json([
                   'status'=> true,
                   'data'=> $ProfileImage,
                   ]);
                }
            }
            else
            {
                return response()->json([
               'status'=>false,
               'message'=>'User Does not Exist'
               ]);
            }
        }

        public function deliveryidcheck(Request $request){
            if($request->deliveryid){
                $usercheck=User::where('user_id',$request->deliveryid)->where('user_type',1)->where('user_status',1)->first();
                if($usercheck){
                    $otp=$this->generateotp();
                    $usercheck->update(['user_otp'=>$otp,'user_otp_verified'=>0]);
                    return response()->json([
                        'status'=>true,
                        'message'=>'Success',
                        'otp'=>$otp
                    ]);


                }else{
                    return response()->json([
                        'status'=>false,
                        'message'=>'Invalid Delivery Id'
                    ]);
                }

            }else{
                return response()->json([
                    'status'=>false,
                    'message'=>'Delivery Id missing'
                ]);
            }
        }

        public static function generateotp(){
            $numbers = "1234567890";
            $otp = substr(str_shuffle($numbers), 0, 4);
            if (!empty($otp)) {
                return $otp;

            }
            else {
                return false;
            }
        }

                public function otpverify(Request $request){
            if($request->deliveryid){
                if($request->otp){
                    $usercheck=User::where('user_id',$request->deliveryid)->where('user_type',1)->where('user_status',1)->first();
                    if($usercheck){
                        if($usercheck->user_otp == $request->otp){
                            $usercheck->update(['user_otp_verified'=>1]);
                            $dbcash= Settings::where('s_id',4)->first();
                            if($usercheck->city_id){
                                $citydetails=City::where('city_id',$usercheck->city_id)->where('city_status',1)->first();
                                $cityname=$citydetails->city_name;
                            }else{
                                $cityname='';
                            }
                            return response()->json([
                                'status'=>true,
                                'message'=>'Success',
                                'token'=>$usercheck->createToken('Grovery')->accessToken,
                                'type'=>'Bearer',
                                'deliveryboycashinhand'=>$dbcash->s_content,
                                'username'=>$usercheck->first_name,
                                'userid'=>$usercheck->user_id,
                                'address'=>$usercheck->address ? $usercheck->address : '',
                                'area'=>$usercheck->area ? $usercheck->area : '',
                                'city'=>$cityname,
                                'rating'=>0
                            ]);

                        }else{
                            return response()->json([
                                'status'=>false,
                                'message'=>'Invalid OTP'
                            ]);
                        }
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'Invalid Delivery Id'
                        ]);
                    }

                }else{
                    return response()->json([
                        'status'=>false,
                        'message'=>'OTP missing'
                    ]);
                }

            }else{
                return response()->json([
                    'status'=>false,
                    'message'=>'Delivery Id missing'
                ]);
            }



        }


        public function deliveryboyprofile(Request $request)
        {

            $token=$request->bearerToken();
            $token1 = new PassportToken($token);
            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    $usercheck=User::where('id',$id)->where('user_type',1)->where('user_status',1)->first();
                    if($usercheck){
                        if($usercheck->city_id){
                           $citydetails=City::where('city_id',$usercheck->city_id)->where('city_status',1)->first();
                            $userdetails=array(
                                'username'=>$usercheck->first_name,
                                'userid'=>$usercheck->user_id,
                                'address'=>$usercheck->address ? $usercheck->address : '',
                                'city'=>$citydetails->city_name,
                                'phone'=>$usercheck->mobile_number ? $usercheck->mobile_number : '',
                                'alternatephone'=>$usercheck->alternative_number ? $usercheck->alternative_number : '',
                                'aadharno'=>$usercheck->aadhar ? $usercheck->aadhar : '',
                                'drivinglic'=>$usercheck->driving_license_no ? $usercheck->driving_license_no : '',
                                'drivingno'=>$usercheck->driving_license_expiry ? date('d-m-Y', strtotime($usercheck->driving_license_expiry)) : '',
                                'cashinhand'=>0,
                                'aadharno'=>$usercheck->aadhar ? $usercheck->aadhar : '',
                            );
                        }else{
                            $userdetails=array(
                                'username'=>$usercheck->first_name,
                                'userid'=>$usercheck->user_id,
                                'address'=>$usercheck->address ? $usercheck->address : '',
                                'city'=>'',
                                'phone'=>$usercheck->mobile_number ? $usercheck->mobile_number : '',
                                'alternatephone'=>$usercheck->alternative_number ? $usercheck->alternative_number : '',
                                'aadharno'=>$usercheck->aadhar ? $usercheck->aadhar : '',
                                'drivinglicno'=>$usercheck->driving_license_no ? $usercheck->driving_license_no : '',
                                'drivinglicexpiry'=>$usercheck->driving_license_expiry ? date('d-m-Y', strtotime($usercheck->driving_license_expiry)) : '',
                                'cashinhand'=>0,
                                'aadharno'=>$usercheck->aadhar ? $usercheck->aadhar : '',
                            );
                        }
                        $bankdetails=BankDetail::where('user_id',$id)->first();
                        if($bankdetails){
                            $bankarray=array(
                                'bankname'=>$bankdetails->bank_name ? $bankdetails->bank_name : '' ,
                                'accnum'=>$bankdetails->acc_no ? $bankdetails->acc_no : '' ,
                                'ifsc'=>$bankdetails->ifsc ? $bankdetails->ifsc : '' ,
                                'panno'=>$bankdetails->pan ? $bankdetails->pan : '',
                                'maxdeposit'=>$bankdetails->max_deposit ? $bankdetails->max_deposit : '' ,
                            );

                        }else{
                            $bankarray=[];
                        }
                        return response()->json([
                            'status'=>true,
                            'message'=>'success',
                            'deliveryboydetails'=>$userdetails,
                            'bankdetails'=>$bankarray
                        ]);
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'User Does not Exist'
                        ]);
                    }


                }else{
                    return response()->json([
                        'status'=>false,
                        'message'=>'Invalid Token'
                        ]);
                }
            }
            else
            {
                return response()->json([
               'status'=>false,
               'message'=>'User Does not Exist'
               ]);
            }
        }

        public function deliveryboyorderdetails(Request $request)
        {
            $final_array2=array();
            $final_array1=array();
            $token=$request->bearerToken();
            $token1 = new PassportToken($token);
            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    $orders = Order::groupBy('order_id')->where('delivery_man',$id)->get(['id','order_id','customer_id','order_status']);
                    if($orders){
                        foreach($orders as $order){
                            $orderdetails = Order::where('order_id',$order->order_id)->get();
                            if($orderdetails){
                                foreach($orderdetails as $orderdetail){
                                    unset($senddata);
                                    $orderedproducts=Products::where('product_id',$orderdetail->product_id)->first();
                                    if($orderedproducts){
                                        $orderedproductscategory=Category::where('cat_id',$orderedproducts->product_category_id)->first();
                                        $orderedproductquantity=ProductQuantity::where('id',$orderdetail->product_quantity_id)->first();
                                        if($orderedproductquantity){

                                            $storedetails=Seller::where('sd_usid',$orderdetail->store_id)->first();
                                            if($storedetails->sd_scityid){
                                                $city=City::where('city_id',$storedetails->sd_scityid)->first();
                                                $cityname=$city->city_name;
                                            }else{
                                                $cityname='';
                                            }
                                            $senddata=array(
                                                'productId'=>$orderedproducts->product_id,
                                                'product'=>$orderedproducts->product_name,
                                                'productvariant'=>$orderedproductquantity->measurement,
                                                'productmrp'=>$orderedproductquantity->price,
                                                'productsalesprice'=>$orderedproductquantity->sales_price,
                                                'orderId'=>$orderdetail->order_id,
                                                'productquantity'=>$orderdetail->quantity,
                                                'producttotal'=>$orderdetail->total,
                                                'sellername'=>$storedetails->sd_sname,
                                                'selleraddress'=>$storedetails->sd_address,
                                                'sellercity'=>$cityname,
                                                'category'=>$orderedproductscategory->cat_name,
                                            );
                                        }
                                       array_push($final_array1,$senddata);
                                    }

                                    //unset($senddata);
                                }
                            }
                            $customer_details=Customer::where('id',$order->customer_id)->first();
                            $customer_address=CustomerAddress::where('customer_id',$order->customer_id)->first();
                            if($customer_address){
                                $landmark=$customer_address->landmark;
                                $address=$customer_address->address;
                            }else{
                                $landmark='';
                                $address='';
                            }
                            $order_status=OrderStatus::where('id',$order->order_status)->first();
                            $final_array=array(
                                'customername'=>$customer_details->name,
                                'CustomerAddress'=>$address,
                                'customerlandmark'=>$landmark,
                                'customerArea'=>$order->order_area,
                                'orderId'=>$order->order_id,
                                'order_status_name'=>$order_status->name,
                                'products'=>$final_array1 ? $final_array1 : []
                            );
                           // unset($final_array1);
                            array_push($final_array2,$final_array);

                            $final_array1=array();
                        }

                        return response()->json([
                            'status'=> true,
                            'message'=> 'success',
                            'data'=> $final_array2

                            ]);

                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'orders Not Available'
                            ]);
                    }



                }else{
                    return response()->json([
                        'status'=>false,
                        'message'=>'Invalid Token'
                        ]);
                }
            }
            else
            {
                return response()->json([
               'status'=>false,
               'message'=>'User Does not Exist'
               ]);
            }
        }

        public function updateproductsreview(Request $request){
            $token=$request->bearerToken();
            $token1 = new PassportToken($token);
            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    $update_array=array(
                        'or_order_id'=>$request->order_id,
                        'or_product_id'=>$request->product_id,
                        'or_status'=>$request->status,
                        'or_reason'=>$request->reason ? $request->reason : '',
                        'or_amount'=>$request->amount,
                        'or_date'=>date('Y-m-d'),
                        'or_created_by'=>$id
                    );
                    $create_order_review = new OrderReview;
                    $create_order_review = $create_order_review->create($update_array);
                    return response()->json([
                        'status'=>true,
                        'message'=>'success',
                        'order_review_id'=>$create_order_review->or_id
                    ]);


                }else{
                    return response()->json([
                        'status'=>false,
                        'message'=>'Invalid Token'
                    ]);
                }
            }
            else
            {
                return response()->json([
               'status'=>false,
               'message'=>'User Does not Exist'
               ]);
            }

        }

        public function getorderreviewlist(Request $request){
            $token=$request->bearerToken();
            $token1 = new PassportToken($token);
            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    $reviewlist=OrderReview::where('or_id',$request->order_review_id)->first();
                    $reviewlist['or_date']=date('d-m-Y', strtotime($reviewlist->or_date));
                    return response()->json([
                        'status'=>true,
                        'message'=>'success',
                        'data'=>$reviewlist
                    ]);


                }else{
                    return response()->json([
                        'status'=>false,
                        'message'=>'Invalid Token'
                    ]);
                }
            }
            else
            {
                return response()->json([
               'status'=>false,
               'message'=>'User Does not Exist'
               ]);
            }

        }

                public function updatedutystatus(Request $request){
            $token=$request->bearerToken();
            $token1 = new PassportToken($token);
            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    $update_array=array(
                        'ds_user_id'=>$id,
                        'ds_status'=>$request->status,
                        'ds_date'=>date('Y-m-d')
                    );
                    $create_order_review = new dutystatus;
                    $create_order_review = $create_order_review->create($update_array);
                    $usercheck=User::where('id',$id)->where('user_type',1)->where('user_status',1)->first();
                    $usercheck->update(['duty_status'=>$request->status]);
                    return response()->json([
                        'status'=>true,
                        'message'=>'success',
                    ]);


                }else{
                    return response()->json([
                        'status'=>false,
                        'message'=>'Invalid Token'
                    ]);
                }
            }
            else
            {
                return response()->json([
               'status'=>false,
               'message'=>'User Does not Exist'
               ]);
            }

        }

        public function generateordersellerotp(Request $request){
            $token=$request->bearerToken();
            $token1 = new PassportToken($token);
            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    $otp=$this->generateotp();
                    $update_array=array(
                        'odt_order_id'=>$request->orderid,
                        'odt_delivery_id'=>$id,
                        'odt_otp'=>$otp,
                        'odt_is_verify'=>0
                    );
                    $create_order_review = new Orderotp;
                    $create_order_review = $create_order_review->create($update_array);
                    return response()->json([
                        'status'=>true,
                        'message'=>'success',
                        'otp'=>$otp,
                        'otpverifyid'=>$create_order_review->odt_id
                    ]);


                }else{
                    return response()->json([
                        'status'=>false,
                        'message'=>'Invalid Token'
                    ]);
                }
            }
            else
            {
                return response()->json([
               'status'=>false,
               'message'=>'User Does not Exist'
               ]);
            }

        }

        public function orderotpverify(Request $request){
            $token=$request->bearerToken();
            $token1 = new PassportToken($token);
            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $id=$token1->user_id;
                    $otpverifydetails=Orderotp::where('odt_id',$request->otpverifyid)->first();
                    if($otpverifydetails->odt_otp == $request->otp){
                        $otpverifydetails->update(['odt_is_verify'=>1]);
                        return response()->json([
                            'status'=>true,
                            'message'=>'success',
                        ]);
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'Invalid OTP'
                        ]);

                    }

                }else{
                    return response()->json([
                        'status'=>false,
                        'message'=>'Invalid Token'
                    ]);
                }
            }
            else
            {
                return response()->json([
               'status'=>false,
               'message'=>'User Does not Exist'
               ]);
            }

        }
                        public function groverysettings(Request $request){
            $final_array=array();
            $token=$request->bearerToken();
            $token1 = new PassportToken($token);
            if ($token1->valid) {
                if ($token1->existsValid()) {
                    $user_id = $token1->user_id;
                    $storesettings=Seller::where('sd_status',1)->get(['sd_usid','sd_sname']);
                    foreach($storesettings as $storesetting){
                        $storesetting['store_id']=$storesetting->sd_usid;
                        $storesetting['store_name']=$storesetting->sd_sname;
                        $storesetting['store_timings']=DeliverySetting::get();
                       // unset()
                       unset($storesetting['sd_usid']);
                       unset($storesetting['sd_sname']);
                        array_push($final_array,$storesetting);
                    }
                    if($final_array){
                        return response()->json([
                            'status'=>true,
                            'message'=>'Success',
                            'data'=>$final_array
                        ]);
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'No data Found'
                        ]);
                    }
                }
            }else{
                return response()->json([
                    'status'=>false,
                    'message'=>'User Does not Exist'
                ]);
            }
        }

                public function sellertimings(Request $request){
            $final_array=array();
            $token=$request->bearerToken();
            $token1 = new PassportToken($token);
            if ($token1->valid) {
                if ($token1->existsValid()) {
                   // $user_id = $token1->user_id;
                   $csv = array_map('str_getcsv',explode(PHP_EOL, $request->storeids));
                   //print_r($csv);
                   //exit;
                   foreach ($csv as $csvs){
                    $storesettings=Seller::whereIn('sd_usid',$csvs)->get(['sd_usid','sd_sname','sunday_opening_time','sunday_closing_time','monday_opening_time','monday_closing_time','tuesday_opening_time','tuesday_closing_time','wednesday_opening_time','wednesday_closing_time','thursday_opening_time','thursday_closing_time','friday_opening_time','friday_closing_time','saturday_opening_time','saturday_closing_time']);
                   // array_push($final_array,$storesettings);
                   }

                    if($storesettings){
                        return response()->json([
                            'status'=>true,
                            'message'=>'Success',
                            'data'=>$storesettings
                        ]);
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'No data Found'
                        ]);
                    }
                }
            }else{
                return response()->json([
                    'status'=>false,
                    'message'=>'User Does not Exist'
                ]);
            }
        }
              public function arealists(Request $request){
            $final_array=array();
            $token=$request->bearerToken();
            $token1 = new PassportToken($token);
            if ($token1->valid) {
                if ($token1->existsValid()) {
                   $arealists=Area::where('area_status',1)->get(['area_id','area_name']);
                    if($arealists){
                        return response()->json([
                            'status'=>true,
                            'message'=>'Success',
                            'data'=>$arealists
                        ]);
                    }else{
                        return response()->json([
                            'status'=>false,
                            'message'=>'No data Found'
                        ]);
                    }
                }
            }else{
                return response()->json([
                    'status'=>false,
                    'message'=>'User Does not Exist'
                ]);
            }
        }

        public function getZoneStore(Request $request){
			$zones = Zone::all();
			$lat1 = $request->lat;
			$lon1 = $request->lng;
			$unit = ($request->unit)?:'K';
			$stores = [];
			foreach($zones as $zone){
				$lat2 = $zone->zone_lat;
				$lon2 = $zone->zone_lon;
				if($this->distance($lat1, $lon1, $lat2, $lon2, $unit) <= $zone->zone_radius)
				{
					$stores[] = $zone;
				}
			}
			if(count($stores)>0){
				$response = response()->json(['status'=>true,'data'=>$zone,'message'=>"stores in a zone"]);
			}else{
				$response = response()->json(['status'=>false,'message'=>"no stores found in a zone"]);
			}
			return $response;
		}


		public function distance($lat1, $lon1, $lat2, $lon2, $unit)
		{
		  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
			return 0;
		  }
		  else {
			$theta = $lon1 - $lon2;
			$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
			$dist = acos($dist);
			$dist = rad2deg($dist);
			$miles = $dist * 60 * 1.1515;
			$unit = strtoupper($unit);

			if ($unit == "K") {
			  return $miles * 1.609344;
			} else if ($unit == "N") {
				return $miles * 0.8684;
			} else {
				return  $miles;
			}
		  }
		}

    public function getCustomerNearbyZones(Request $request)
       {

           $zones = Zone::all();
           $lat1 = $request->lat;
           $lon1 = $request->lng;
           $unit = ($request->unit)?:'K'; //KM
           $main_id= $request->main_id;
           $data = [];

           $stores = [];
           foreach($zones as $zone){
               $lat2 = $zone->zone_lat;
               $lon2 = $zone->zone_lon;
               $distance = $this->distance($lat1, $lon1, $lat2, $lon2, $unit);

               $distance = (float)$distance;
               $zone_radius_int =  (int)$zone->zone_radius;
               $result = $distance <= $zone_radius_int;

               if($distance <= $zone_radius_int)
               {
                   //array_push($stores,$zone);





                   $stores = Seller::where('main_category','=',$main_id)->where('sd_zone_id','=',$zone->zone_id)->get();




                   foreach ($stores as $value) {
                       $store_review_count=Review::where('store_id',$value->sd_usid)->count();
                       $ratingnullcheck=Review::where('store_id',$value->sd_usid)->avg('rating');
                       if($ratingnullcheck != null){
                           $store_review_average=round(Review::where('store_id',$value->sd_usid)->avg('rating'));
                       }else{
                           $store_review_average=0;
                       }

                       $seller_data = [
                       "sd_id" => $value->sd_id,
                       "sd_usid" => $value->sd_usid,
                       "sd_sname" => $value->sd_sname,
                       "main_category" => $value->main_category,
                       "sd_snumber" => $value->sd_snumber,
                       "sd_sadminshare" => $value->sd_sadminshare,
                       "sd_scityid" => $value->sd_scityid,
                       "sd_sdeliverykm" => $value->sd_sdeliverykm,
                       "sd_spincode" => $value->sd_spincode,
                       "sd_address" => $value->sd_address,
                       "store_image" => $value->store_image,
                       "store_logo" => $value->store_logo,
                       "sd_status" => $value->sd_status,
                       "tag" => $value->tag,
                       "created_by" => $value->created_by,
                       "updated_by" => $value->updated_by,
                       "store_review_count"=> $store_review_count,
                       "store_review_average"=>$store_review_average,
                       "zone_name"=>$zone->zone_name,
                       "zone_id"=>$zone->zone_id,
                       ];

                       $data[] = $seller_data;
                   }
                   if($data != NULL)
                   {
                       $area_banners = AreaBanner::all();

                   }
                   elseif($data == NULL) {

                       $area_banners = AreaBanner::all();

                   }



               }

           }
           if(count($stores)>0){
               // $response = response()->json(['status'=>true,'data'=>$stores,'message'=>"stores in a zone"]);
               return response()->json([
               'status' => true,
               'store'=> $data,
               'area_banners'=>$area_banners
               ]);
           }else{
               $response = response()->json(['status'=>false,'message'=>"no stores found in the zone"]);
           }
           return $response;




       }

}
