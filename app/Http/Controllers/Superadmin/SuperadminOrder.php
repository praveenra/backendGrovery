<?php	
		
	namespace App\Http\Controllers\Superadmin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\Order;
	use App\Models\OrderStatus;
	use App\Models\Notification;
	use App\Models\OrderLimit;
	use App\Models\CancelReason;
	use App\Models\City;
	use App\Models\Area;
	use App\Models\User;
	use App\Models\Customer;
	use App\Exports\OrdersExport;
	use Maatwebsite\Excel\Facades\Excel;
	use Mail;
	use App\Models\Seller;	
	use DB;
	use Carbon\Carbon;
	use Auth;
		
	class SuperadminOrder extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Orders',
            'page_auth'=> 'superadmin',
        );		
		/**  			
			* Contructor to aunthendicate user			
		*/		
		
		/**			
			* Display a listing of the resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
				
		public function orders(Request $request){	
			
            $this->data['order_data'] = Order::select(
            							'orders.*','order_status.*','stores_deliv_times.*',
            							'customer.name as customer',
            							'order_status.name as order_status_name',
            							'seller_details.sd_sname as store_name',
            							'orders.store_id as store_id',
            							'orders.created_at as created_time',
            							'users.first_name as delivery_boy_name',
            							'orders.id as order_main_id'
            						)
            						->leftjoin('customer','customer.id','orders.customer_id')
            						->leftjoin('add_tocart','add_tocart.id','orders.order_id')
            						->leftjoin('seller_details','seller_details.sd_id','orders.store_id')
            						->leftjoin('order_status','order_status.id','orders.order_status')
            						->leftjoin('users','users.id','orders.delivery_man')
									->leftjoin('stores_deliv_times','stores_deliv_times.checkout_id','orders.order_id')
									->groupBy('orders.order_id')
									->groupBy('orders.store_id')
									->orderBy('orders.created_at', 'DESC')
            						->get();

			$this->data['users'] = User::where('user_type',1)->get();

            $this->data['message'] = 'No Orders Available';
            $this->data['cancel_reasons'] = CancelReason::where('status',1)->get();
            return view('superadmin.orders.manage', $this->data);  
		}

		public function waiting_for_approval_order(Request $request){	
			
            $this->data['wait_for_approve'] = Order::select(
            							'orders.*','order_status.*',
            							'customer.name as customer',
            							'order_status.name as order_status_name',
            							'seller_details.sd_sname as store_name',
            							'orders.created_at as created_time',
            							'users.first_name as delivery_boy_name',
            							'orders.id as order_main_id'
            						)
            						->leftjoin('customer','customer.id','orders.customer_id')
            						->leftjoin('add_tocart','add_tocart.id','orders.order_id')
            						->leftjoin('seller_details','seller_details.sd_id','orders.store_id')
            						->leftjoin('order_status','order_status.id','orders.order_status')
            						->leftjoin('users','users.id','orders.delivery_man')
            						->where('order_status','=',1)
            						->get();

			$this->data['users'] = User::where('user_type',1)->get();

            $this->data['message'] = 'No Orders Available';
            $this->data['cancel_reasons'] = CancelReason::where('status',1)->get();
            return view('superadmin.orders.waiting_for_approval_order', $this->data);  
		}


		public function pendingorders(Request $request){	
			
            $this->data['wait_for_approve'] = Order::select(
            							'orders.*','order_status.*',
            							'customer.name as customer',
            							'order_status.name as order_status_name',
            							'seller_details.sd_sname as store_name',
            							'orders.created_at as created_time',
            							'users.first_name as delivery_boy_name',
            							'orders.id as order_main_id'
            						)
            						->leftjoin('customer','customer.id','orders.customer_id')
            						->leftjoin('add_tocart','add_tocart.id','orders.order_id')
            						->leftjoin('seller_details','seller_details.sd_id','orders.store_id')
            						->leftjoin('order_status','order_status.id','orders.order_status')
            						->leftjoin('users','users.id','orders.delivery_man')
            						->where('order_status','=',1)
									->orWhere('order_status','=',2)
            						->get();

			$this->data['users'] = User::where('user_type',1)->get();

            $this->data['message'] = 'No Orders Available';
            $this->data['cancel_reasons'] = CancelReason::where('status',1)->get();
            return view('superadmin.orders.waiting_for_approval_order', $this->data);  
		}






		public function approve_and_reject_order(Request $request){	
			
            $this->data['wait_for_approve_reject'] = Order::select(
            							'orders.*','order_status.*',
            							'customer.name as customer',
            							'order_status.name as order_status_name',
            							'seller_details.sd_sname as store_name',
            							'orders.created_at as created_time',
            							'users.first_name as delivery_boy_name',
            							'orders.id as order_main_id'
            						)
            						->leftjoin('customer','customer.id','orders.customer_id')
            						->leftjoin('add_tocart','add_tocart.id','orders.order_id')
            						->leftjoin('seller_details','seller_details.sd_id','orders.store_id')
            						->leftjoin('order_status','order_status.id','orders.order_status')
            						->leftjoin('users','users.id','orders.delivery_man')
            						->where('order_status','=',2)
            						->orWhere('order_status','=',5)
            						->get();

			$this->data['users'] = User::where('user_type',1)->get();

            $this->data['message'] = 'No Orders Available';
            $this->data['cancel_reasons'] = CancelReason::where('status',1)->get();
            return view('superadmin.orders.approve_and_reject_order', $this->data);  
		}

		public function ready_to_pickup_and_delivery(Request $request){	
			
            $this->data['wait_for_approve_reject'] = Order::select(
            							'orders.*','order_status.*',
            							'customer.name as customer',
            							'order_status.name as order_status_name',
            							'seller_details.sd_sname as store_name',
            							'orders.created_at as created_time',
            							'users.first_name as delivery_boy_name',
            							'orders.id as order_main_id'
            						)
            						->leftjoin('customer','customer.id','orders.customer_id')
            						->leftjoin('add_tocart','add_tocart.id','orders.order_id')
            						->leftjoin('seller_details','seller_details.sd_id','orders.store_id')
            						->leftjoin('order_status','order_status.id','orders.order_status')
            						->leftjoin('users','users.id','orders.delivery_man')
            						->where('order_status','=',3)
            						->orWhere('order_status','=',7)
            						->get();

			$this->data['users'] = User::where('user_type',1)->get();

            $this->data['message'] = 'No Orders Available';
            $this->data['cancel_reasons'] = CancelReason::where('status',1)->get();
            return view('superadmin.orders.ready_to_pickup_and_delivery', $this->data);  
		}

		public function assignedorders(Request $request){	
			
            $this->data['wait_for_approve_reject'] = Order::select(
            							'orders.*','order_status.*',
            							'customer.name as customer',
            							'order_status.name as order_status_name',
            							'seller_details.sd_sname as store_name',
            							'orders.created_at as created_time',
            							'users.first_name as delivery_boy_name',
            							'orders.id as order_main_id'
            						)
            						->leftjoin('customer','customer.id','orders.customer_id')
            						->leftjoin('add_tocart','add_tocart.id','orders.order_id')
            						->leftjoin('seller_details','seller_details.sd_id','orders.store_id')
            						->leftjoin('order_status','order_status.id','orders.order_status')
            						->leftjoin('users','users.id','orders.delivery_man')
            						->where('order_status','=',3)
            						->orWhere('order_status','=',7)
            						->get();

			$this->data['users'] = User::where('user_type',1)->get();

            $this->data['message'] = 'No Orders Available';
            $this->data['cancel_reasons'] = CancelReason::where('status',1)->get();
            return view('superadmin.orders.ready_to_pickup_and_delivery', $this->data);  
		}


		public function deliveredorders(Request $request){	
			
            $this->data['wait_for_approve_reject'] = Order::select(
            							'orders.*','order_status.*',
            							'customer.name as customer',
            							'order_status.name as order_status_name',
            							'seller_details.sd_sname as store_name',
            							'orders.created_at as created_time',
            							'users.first_name as delivery_boy_name',
            							'orders.id as order_main_id'
            						)
            						->leftjoin('customer','customer.id','orders.customer_id')
            						->leftjoin('add_tocart','add_tocart.id','orders.order_id')
            						->leftjoin('seller_details','seller_details.sd_id','orders.store_id')
            						->leftjoin('order_status','order_status.id','orders.order_status')
            						->leftjoin('users','users.id','orders.delivery_man')
            						->where('order_status','=',4)
									->orWhere('order_status','=',6)
            						->get();

			$this->data['users'] = User::where('user_type',1)->get();

            $this->data['message'] = 'No Orders Available';
            $this->data['cancel_reasons'] = CancelReason::where('status',1)->get();
            return view('superadmin.orders.complete_and_return_order', $this->data);  
		}
		public function complete_and_return_order(Request $request){	
			
            $this->data['wait_for_approve_reject'] = Order::select(
            							'orders.*','order_status.*',
            							'customer.name as customer',
            							'order_status.name as order_status_name',
            							'seller_details.sd_sname as store_name',
            							'orders.created_at as created_time',
            							'users.first_name as delivery_boy_name',
            							'orders.id as order_main_id'
            						)
            						->leftjoin('customer','customer.id','orders.customer_id')
            						->leftjoin('add_tocart','add_tocart.id','orders.order_id')
            						->leftjoin('seller_details','seller_details.sd_id','orders.store_id')
            						->leftjoin('order_status','order_status.id','orders.order_status')
            						->leftjoin('users','users.id','orders.delivery_man')
            						->where('order_status','=',4)
            						->orWhere('order_status','=',6)
            						->get();

			$this->data['users'] = User::where('user_type',1)->get();

            $this->data['message'] = 'No Orders Available';
            $this->data['cancel_reasons'] = CancelReason::where('status',1)->get();
            return view('superadmin.orders.complete_and_return_order', $this->data);  
		}


		public function delivery_man(Request $request){	
			
            $this->data['delivery_man'] = Order::select(
            							'orders.*','order_status.*',
            							'customer.name as customer',
            							'order_status.name as order_status_name',
            							'seller_details.sd_sname as store_name',
            							'orders.created_at as created_time',
            							'users.first_name as delivery_boy_name',
            							'orders.id as order_main_id'
            						)
            						->leftjoin('customer','customer.id','orders.customer_id')
            						->leftjoin('add_tocart','add_tocart.id','orders.order_id')
            						->leftjoin('seller_details','seller_details.sd_id','orders.store_id')
            						->leftjoin('order_status','order_status.id','orders.order_status')
            						->leftjoin('users','users.id','orders.delivery_man')
            						->get();



			// $this->data['users'] = User::select('orders.*','users.*')
			// 							->leftjoin('orders', function($join)  {
			// 							$join->on('users.id', '=', 'orders.delivery_man')
			// 								 ->where('order_status', '!=', '1')
			// 								 ->where('order_status', '!=', '2')
			// 								 ->where('order_status', '!=', '4')
			// 								 ->where('order_status', '!=', '5')
			// 								 ->where('order_status', '!=', '6');
			// 						})
			// 						->whereNull('delivery_man')
			// 						->where('user_type',1)
			// 						->get();

            $myArr = User::select('orders.*','customer_addresses.*','users.address')
				           ->leftjoin('customer_addresses','orders.address_id','customer_addresses.id')
				           ->get();

						          echo "<pre>";
								  print_r($myArr);
								  exit();


            $this->data['users'] = User::select('orders.*','users.*','customer_addresses.*','users.address')
										->leftjoin('orders', function($join) use($myArr) {
										$join->on('users.id', '=', 'orders.delivery_man')
											 ->where('order_status', '!=', '1')
											 ->where('order_status', '!=', '2')
											 ->where('order_status', '!=', '4')
											 ->where('order_status', '!=', '5')
											 ->where('order_status', '!=', '6');
									})
									
									->whereNull('delivery_man')
									->where('user_type',1)
									->get();

						 		 //  echo "<pre>";
								  // print_r($this->data['users']);
								  // exit();

            $this->data['message'] = 'No Orders Available';
            $this->data['cancel_reasons'] = CancelReason::where('status',1)->get();
            return view('superadmin.orders.delivery_man', $this->data);  
		}

		public function approveOrder(Request $request){

			$order = Order::where('id',$request->approve_id)->first();

			$order->order_status=$request->order_status;
			$order->save();

			// foreach($order as $orders){
			//     $orders->order_status=$request->order_status;
			// 	$orders->save();
			// }
			
			return redirect()->back()->with('success','Order Status Updated Successfully');
		}

		public function proceedOrder(Request $request){

			$order = Order::where('id',$request->progress_id)->first();

			$order->order_status=$request->order_status;
			$order->save();

			// foreach($order as $orders){
			//     $orders->order_status=$request->order_status;
			// 	$orders->save();
			// }

			return redirect()->back()->with('success','Order Status Updated Successfully');
		}

		public function checkDeliveryman(Request $request){

			$order = Order::where('id',$request->delivery_man)->first();
			
			return redirect()->back()->with('success','Please Assign Delivery Man');
		}

		public function assignDeliveryman(Request $request){


			$order = Order::where('id',$request->delivery_man_id)->first();
			if ($order) {
				if ($order->order_status != 3) {
				   return redirect()->back()->with('warning','Please Change The Order Status Ready For Pickup');
					
				}
				else
				{
					$order->delivery_man=$request->delivery_partner;
					$order->save();

				}
				return redirect()->back()->with('success','Delivery Man Assigned Successfully');

			}
			else
			{
				return redirect()->back()->with('failure','Delivery Man Detail Not Available');
			}


			
			// $order = Order::where('id',$request->delivery_man_id)->first();

			// // echo '<pre>';
			// // print_r($order);
			// // exit();

			// $order->delivery_man=$request->delivery_partner;
			// $order->save();

			// // foreach($order as $orders){
			// //     $orders->delivery_man=$request->delivery_partner;
			// // 	$orders->save();
			// // }

			// return redirect()->back()->with('success','Delivery Man Assigned Successfully');
		}

		public function outfordeliveryOrder(Request $request){

			$order = Order::where('id',$request->out_for_delivery_id)->first();
			if ($order) {
				if ($order->delivery_man == '') {
					return redirect()->back()->with('warning','Please Assign Delivey Man');
					
				}
				else
				{
					$order->order_status=$request->order_status;
					$order->save();

				}
				return redirect()->back()->with('success','Status Updated Successfully');

			}
			else
			{
				return redirect()->back()->with('failure','Order Detail Not Available');
			}
			
		}

		public function completeOrder(Request $request){

			$order = Order::where('id',$request->complete_id)->first();

			$order->order_status=$request->order_status;
			$order->save();

			// foreach($order as $orders){
			//     $orders->order_status=$request->order_status;
			// 	$orders->save();
			// }

			return redirect()->back()->with('success','Return Successfully');
		}

		public function returnOrder(Request $request){

			$order = Order::where('id',$request->return_id)->first();

			$order->order_status=$request->order_status;
			$order->save();

			// foreach($order as $orders){
			//     $orders->order_status=$request->order_status;
			// 	$orders->save();
			// }

			return redirect()->back()->with('success','Return Successfully');
		}

		

		public function export(Request $request){

			return Excel::download(new OrdersExport(), 'orders.csv');

		}

		public function filter(Request $request){

	        if($request->from_date == '' && $request->to_date == '') {

	            $senddata = Order::select('add_tocart.created_at')
	            ->leftjoin('add_tocart','add_tocart.id','orders.order_id')
	            ->get();
	        }

	        if($request->from_date != '' && $request->to_date != '') {
	            $from = Carbon::parse($request->from_date)->toDateString();
	            $to =  Carbon::parse($request->to_date)->toDateString();

	            $senddata = Order::select('add_tocart.created_at as created_time')
	            ->leftjoin('add_tocart','add_tocart.id','orders.order_id')
	            ->whereBetween('date',[$from,$to])
	            ->get();

	        }

	        return view('expenses_make/manage_ajax',['senddata'=> $senddata]);

	    }

		public function display($id)
	    {

	        $this->data['basic_details'] = Order::select(
					'orders.*',
					DB::raw('DATE_FORMAT(add_tocart.created_at,"%D %b %Y %h:%i:%s %p") as date'),
					'customer.name as customer',
					'customer.phone_no as phone_no',
					'customer.email as email',
					'customer_addresses.address as address',
					'customer_addresses.address_type as address_type',
					'customer_addresses.landmark as landmark',
					'customer_addresses.mobile_no as mobile_no',
					'product.product_name as product',
					'product_quantity.measurement as measurement',
					'product_quantity.price as price',
					'order_status.name as order_status_name',
					'seller_details.*','stores_deliv_times.*',
				)
				->leftjoin('seller_details','seller_details.sd_usid','orders.store_id')
		        ->leftjoin('customer','customer.id','orders.customer_id')
		        ->leftjoin('customer_addresses','customer_addresses.id','orders.address_id')
				->leftjoin('product','product.product_id','orders.product_id')
				->leftjoin('product_quantity','product_quantity.product_id','orders.product_quantity_id')

				->leftjoin('order_status','order_status.id','orders.order_status')
				->leftjoin('add_tocart','add_tocart.id','orders.order_id')
				->leftjoin('stores_deliv_times','stores_deliv_times.checkout_id','orders.order_id')
				->where('orders.order_id',$id)
				->first();

			$this->data['order_details'] = Order::select(
					'orders.id as main_id',
					'orders.quantity as quan',
					'orders.total as tot',
					'product.product_name as product',
					'product_quantity.measurement as measurement',
					'product_quantity.price as price',
				)
				->leftjoin('product','product.product_id','orders.product_id')
				->leftjoin('product_quantity','product_quantity.id','orders.product_quantity_id')

				->where('orders.order_id',$id)
				->where('orders.order_status','!=',5)
				->get();

			$this->data['total_cart'] = Order::where('orders.order_id',$id)->sum('total');
			 $order_details=Order::where('order_id',$id)->first();
			//	 $areadetails=Area::where('area_name', 'like', '%' . $order_details->order_area . '%')->first();
			/*	if($areadetails){
			     	$zone_id=$areadetails->Zone_id ? $areadetails->Zone_id : 0;
			 	}else{
			     	$zone_id=0;
			 	}
			 	$this->data['delivery_boy_select'] =User::where('user_type',1)->where('zone_id',$zone_id)->get();
			 */
			$storedetails=Seller::where('sd_usid',$order_details->store_id)->first();
			if($storedetails){
			     $zone_id=$storedetails->sd_zone_id ? $storedetails->sd_zone_id : 0;
			 }else{
			     $zone_id=0;
			 }
			$this->data['delivery_boy_select'] =User::where('user_type',1)->where('zone_id',$zone_id )->get();
	        return response()->json($this->data);
	    }

		public function storebaseddisplay($id,$store_id)
	    {

	        $this->data['basic_details'] = Order::select(
					'orders.*',
					DB::raw('DATE_FORMAT(add_tocart.created_at,"%D %b %Y %h:%i:%s %p") as date'),
					'customer.name as customer',
					'customer.phone_no as phone_no',
					'customer.email as email',
					'customer_addresses.address as address',
					'customer_addresses.address_type as address_type',
					'customer_addresses.landmark as landmark',
					'customer_addresses.mobile_no as mobile_no',
					'product.product_name as product',
					'product_quantity.measurement as measurement',
					'product_quantity.price as price',
					'order_status.name as order_status_name',
					'seller_details.*','stores_deliv_times.*',
					'users.first_name as canceled_user',
				)
				->leftjoin('seller_details','seller_details.sd_usid','orders.store_id')
		        ->leftjoin('customer','customer.id','orders.customer_id')
		        ->leftjoin('customer_addresses','customer_addresses.id','orders.address_id')
				->leftjoin('product','product.product_id','orders.product_id')
				->leftjoin('product_quantity','product_quantity.product_id','orders.product_quantity_id')
				->leftjoin('users','users.id','orders.canceled_by')
				->leftjoin('order_status','order_status.id','orders.order_status')
				->leftjoin('add_tocart','add_tocart.id','orders.order_id')
				->leftjoin('stores_deliv_times','stores_deliv_times.checkout_id','orders.order_id')
				->where('orders.order_id',$id)
				->where('orders.store_id',$store_id)
				->first();

			$this->data['order_details'] = Order::select(
					'orders.id as main_id',
					'orders.quantity as quan',
					'orders.total as tot',
					'product.product_name as product',
					'product_quantity.measurement as measurement',
					'product_quantity.price as price',
				)
				->leftjoin('product','product.product_id','orders.product_id')
				->leftjoin('product_quantity','product_quantity.id','orders.product_quantity_id')

				->where('orders.order_id',$id)
				->where('orders.store_id',$store_id)
				// ->where('orders.order_status','!=',5)
				->get();
			$this->data['total_cart'] = Order::where('orders.order_id',$id)->where('orders.store_id',$store_id)->sum('total');
			 $order_details=Order::where('order_id',$id)->first();

			//	 $areadetails=Area::where('area_name', 'like', '%' . $order_details->order_area . '%')->first();
			/*	if($areadetails){
			     	$zone_id=$areadetails->Zone_id ? $areadetails->Zone_id : 0;
			 	}else{
			     	$zone_id=0;
			 	}
			 	$this->data['delivery_boy_select'] =User::where('user_type',1)->where('zone_id',$zone_id)->get();
			 */
			
			$storedetails=Seller::where('sd_usid',$order_details->store_id)->first();
			if($storedetails){
			     $zone_id=$storedetails->sd_zone_id ? $storedetails->sd_zone_id : 0;
			 }else{
			     $zone_id=0;
			 }
			$this->data['delivery_boy_select'] =User::where('user_type',1)->where('zone_id',$zone_id )->get();

			if(Auth::guard('superadmin')->user() != null){
				$this->data['user'] = Auth::guard('superadmin')->user();
			}elseif(Auth::guard('admin')->user() != null){
				$this->data['user'] = Auth::guard('admin')->user();
			}elseif(Auth::guard('seller')->user() != null){
				$this->data['user'] = Auth::guard('seller')->user();
			}

			// echo "<pre> ---=>";
			// print_r($this->data);
			// exit;

	        return response()->json($this->data);
	    }

	    public function orderDetails($order_id){

	    	$this->data['orders'] = Order::select(
				'orders.*',
				DB::raw('DATE_FORMAT(add_tocart.created_at,"%D %b %Y %h:%i:%s %p") as date'),
					'customer.name as customer',
					'customer.phone_no as phone_no',
					'customer.email as email',
					'customer_addresses.address as address',
					'customer_addresses.address_type as address_type',
					'customer_addresses.landmark as landmark',
					'customer_addresses.mobile_no as mobile_no',
					'product.product_name as product',
					'product_quantity.measurement as measurement',
					'product_quantity.price as price',
					'order_status.name as order_status_name',
					'seller_details.*'
			)
			->leftjoin('seller_details','seller_details.sd_usid','orders.store_id')
	        ->leftjoin('customer','customer.id','orders.customer_id')
	        ->leftjoin('customer_addresses','customer_addresses.id','orders.address_id')
			->leftjoin('product','product.product_id','orders.product_id')
			->leftjoin('product_quantity','product_quantity.product_id','orders.product_quantity_id')

			->leftjoin('order_status','order_status.id','orders.order_status')
			->leftjoin('add_tocart','add_tocart.id','orders.order_id')
			->where('orders.order_id',$id)
			->first();

			return response()->json($this->data);
		}	

		public function approveOrReject(Request $request){

			$order = Order::where('id',$request->approve_id)->first();
			$order_id = $order->order_id;
			$customer_id = $order->customer_id;

			if($request->order_status == 1){
				$order->order_status = 2;
				Mail::send('email.order_approved',
					['customer' => $customer, 'order' => $order],
					function($message) use ($customer,$order){
						$message->to($customer->email);
						$message->subject("Order Has Been Approved");
					}
				);
			}else{
				$order->order_status = 5;
				Mail::send('email.order_cancelled',
					['customer' => $customer, 'order' => $order],
					function($message) use ($customer,$order){
						$message->to($customer->email);
						$message->subject("Order Has Been Rejected");
					}
				);
			}

			$order->save();

			$customer = customer::where('id',$customer_id)->first();
			
			if($request->order_status == 1){

				$notification = new Notification;
				$notification->message = "Order has been approved for Order ID -" . $order_id;
				$notification->customer_id = $customer_id;
				$notification->created_at = now();
				$notification->save();
				
			}else{

				$notification = new Notification;
				$notification->message = "Order has been rejected for Order ID -" . $order_id;
				$notification->customer_id = $customer_id;
				$notification->created_at = now();
				$notification->save();

				
			}
			
			return redirect()->back()->with('success','Order Status Updated Successfully');
		}

		public function ProgressOrder(Request $request){

			$order = Order::where('id',$request->progress_id)->first();
			$order->order_status = 3;
			$order->save();
			
			$order_id = $order->order_id;
			$customer_id = $order->customer_id;

			$notification = new Notification;
			$notification->message = "Order has been approved for Order ID -" . $order_id;
			$notification->customer_id = $customer_id;
			$notification->created_at = now();
			$notification->save();
			
			
			return redirect()->back()->with('success','Order Status Updated Successfully');
		}

		public function cancelOrder(Request $request){
			echo "request->id =>",$request->id;
			echo "request->sd_id =>",$request->sd_id;
// exit;
			$order = Order::where('order_id',$request->id)->where('store_id',$request->sd_id)->update(['order_status' => 5, 'cancel_reason' => $request->reason, 'comment' => $request->comment, 'canceled_by' => $request->user_id]);
			// $order->cancel_reason = $request->return_reason;
			// $order->comment = $request->comment;			
			$customer_id = Order::where('order_id',$request->id)->pluck('customer_id')->first();

			$notification = new Notification;
			$notification->message = "Order has been cancelled for Order ID -" . $request->id;
			$notification->customer_id = $customer_id;
			$notification->created_at = now();
			$notification->save();
			
			return redirect()->back()->with('success','Order Status Updated Successfully');
		}

		public function cancelIndividualOrder(Request $request){
			echo "123"; exit;
			$order = Order::where('id',$request->c_id)->where('store_id',$request->c_sd_id)->first();
			$order->order_status = 5;
			$order->cancel_reason = $request->reason;
			$order->comment = $request->comment;
			$order->canceled_by = $request->user_id_c;
			$order->save();
			
			$customer_id = $order->customer_id;
			$order_id = $order->order_id;

			$notification = new Notification;
			$notification->message = "Order has been cancelled for Order ID -" . $order_id;
			$notification->customer_id = $customer_id;
			$notification->created_at = now();
			$notification->save();
			
			return redirect()->back()->with('success','Order Cancelled Successfully');
		}

	    public function list(){

	    	$this->data['limits'] = OrderLimit::get();
	    	return view('superadmin/orders/limit_manage',$this->data);
	    }

	    public function form($id = NULL){

	    	if($id){
	    		$this->data['limit'] = OrderLimit::where('id',$id)->first();
	    	}else{
	    		$this->data['limit'] = new OrderLimit;
	    	}

			$this->data['cities'] = City::where('city_name','!=',NULL)->get();

			$this->data['areas'] = Area::where('area_name','!=',NULL)->get();

			$this->data['zones'] = City::where('city_name','!=',NULL)->get();
			
			return view('superadmin/orders/limit_form',$this->data);
		}


		public function save(Request $request){
			
			// dd($request->all());

			$data = $request->form_data;

			foreach ($data as $value) {	

			$order_limit = OrderLimit::where('order_limit','!=',NULL)->insert($value);

			// if($request->check == 'on'){
			// 	$order_limit->city        = $request->city;
			// 	$order_limit->area        = $request->area;
			// 	$order_limit->zone        = $request->zone;
			// 	$order_limit->order_limit = $request->order_limit;
			// 	$order_limit->start_date  = $request->start_date;
			// 	$order_limit->end_date    = $request->end_date;
			// }else{
			// 	$order_limit->city        = NULL;
			// 	$order_limit->area        = NULL;
			// 	$order_limit->zone        = NULL;
			// 	$order_limit->order_limit = NULL;
			// 	$order_limit->start_date  = NULL;
			// 	$order_limit->end_date    = NULL;	
			// }

						
            }

			return redirect('superadmin/orders_limit_list');  
		}

		public function edit($id)
	    {
	        
	    	if($id){
	    		$this->data['limit'] = OrderLimit::where('id',$id)->first();
	    	}else{
	    		$this->data['limit'] = new OrderLimit;
	    	}

			$this->data['cities'] = City::where('city_name','!=',NULL)->get();

			$this->data['areas'] = Area::where('area_name','!=',NULL)->get();

			$this->data['zones'] = City::where('city_name','!=',NULL)->get();
			
			return view('superadmin/orders/limit_form',$this->data);

	    }

	    public function update(Request $request)
	    {

			$data = $request->form_data;

			foreach ($data as $value) {	

			$order_limit = OrderLimit::where('order_limit','!=',NULL)->insert($value);
						
            }

			return redirect('superadmin/orders_limit_list');  
	    }	

	    public function deleteOrderlimit(Request $request)		
		{			
			$user = OrderLimit::find($request->delete_id);
			$user->delete();
			return redirect()->back()->with('success','Order Limit Deleted Successfully');	
		}

		public function order_history()
		{
			return view('superadmin/orders/orders_history');
		}

			public function orderfilter(Request $request){

			if(($request->from_date != "") && ($request->to_date != "")){
				$finalfromdate=$request->from_date.' 00:00:00';
				$finaltodate=$request->to_date.' 23:59:59';
			//	$finalfromtimestamp=strtotime($finalfromdate);
			//	$finaltotimestamp=strtotime($finaltodate);
				  $this->data['order_data'] = Order::select(
					  'orders.*','order_status.*',
					  'customer.name as customer',
					  'order_status.name as order_status_name',
					  'seller_details.sd_sname as store_name',
					  'orders.created_at as created_time',
					  'users.first_name as delivery_boy_name',
	  
				  )
				  ->leftjoin('customer','customer.id','orders.customer_id')
				  ->leftjoin('add_tocart','add_tocart.id','orders.order_id')
				  ->leftjoin('seller_details','seller_details.sd_id','orders.store_id')
				  ->leftjoin('order_status','order_status.id','orders.order_status')
				  ->leftjoin('users','users.id','orders.delivery_man')
				  ->whereBetween('orders.created_at', [$finalfromdate, $finaltodate])
				  ->groupby('order_id')
				  ->get();

			}else{
				$finalfromdate=$request->from_date.' 00:00:00';
				$finaltodate=$request->to_date.' 23:59:59';
	  
				  $this->data['order_data'] = Order::select(
					  'orders.*','order_status.*',
					  'customer.name as customer',
					  'order_status.name as order_status_name',
					  'seller_details.sd_sname as store_name',
					  'add_tocart.created_at as created_time',
					  'users.first_name as delivery_boy_name',
	  
				  )
				  ->leftjoin('customer','customer.id','orders.customer_id')
				  ->leftjoin('add_tocart','add_tocart.id','orders.order_id')
				  ->leftjoin('seller_details','seller_details.sd_id','orders.store_id')
				  ->leftjoin('order_status','order_status.id','orders.order_status')
				  ->leftjoin('users','users.id','orders.delivery_man')
				 // ->whereBetween('orders.created_at', [$finalfromdate, $finaltodate])
				  ->groupby('order_id')
				  ->get();
			}



			$this->data['users'] = User::where('user_type',1)->get();

			$this->data['message'] = 'No Orders Available';
			$this->data['cancel_reasons'] = CancelReason::where('status',1)->get();

			return view('superadmin.orders.manage', $this->data);  
		}

		
	}	
