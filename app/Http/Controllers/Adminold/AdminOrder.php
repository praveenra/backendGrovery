<?php	
		
	namespace App\Http\Controllers\Admin;	
		
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
	use DB;
	use Carbon\Carbon;


		
	class AdminOrder extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Orders',
            'page_auth'=> 'admin',
        );		
		/**  			
			* Contructor to aunthendicate user			
		*/		
		public function __construct(){			
			$this->middleware('admin');			
		}		
				
		/**			
			* Display a listing of the resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
				
		// public function orders(Request $request){			

  //           $this->data['senddata'] = Order::select(
  //           							'orders.*',
  //           							'customer.name as customer',
  //           							'product.product_name as product',
  //           							'order_status.name as order_status_name'
  //           						)
  //           						->leftjoin('customer','customer.id','orders.customer_id')
  //           						->leftjoin('product','product.product_id','orders.product_id')
  //           						->leftjoin('order_status','order_status.id','orders.order_status')
  //           						->get();
  //           $this->data['message'] = 'No Orders Available';
  //           $this->data['add'] = 'pages.create';
		// 	$this->data['edit'] = url('admin/pages'); 
  //           $this->data['page_details'] = $this->page_details;
  //           $this->data['route'] = array('page_details.index');
  //           return view('admin.orders.manage', $this->data);  
		// }	

		public function orders(Request $request){	
			
            $this->data['senddata'] = Order::select(
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
            						->groupby('order_id')
            						->get();

			$this->data['users'] = User::where('user_type',1)->get();

            $this->data['message'] = 'No Orders Available';
            $this->data['cancel_reasons'] = CancelReason::where('status',1)->get();
            return view('admin.orders.manage', $this->data);  
		}

		public function approveOrder(Request $request){

			$order = Order::where('order_id',$request->approve_id)->first();
			$order->order_status=$request->order_status;
			$order->save();
			
			return redirect()->back()->with('success','Order Status Updated Successfully');
		}

		public function checkDeliveryman(Request $request){

			$order = Order::where('order_id',$request->delivery_man)->first();
			
			return redirect()->back()->with('success','Please Assign Delivery Man');
		}

		public function proceedOrder(Request $request){

			$order = Order::where('order_id',$request->progress_id)->first();
			$order->order_status=$request->order_status;
			$order->save();

			return redirect()->back()->with('success','Order Status Updated Successfully');
		}

		public function outfordeliveryOrder(Request $request){

			$order = Order::where('order_id',$request->out_for_delivery_id)->first();
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

			$order = Order::where('order_id',$request->complete_id)->first();
			$order->order_status=$request->order_status;
			$order->save();

			return redirect()->back()->with('success','Return Successfully');
		}

		public function returnOrder(Request $request){

			$order = Order::where('order_id',$request->return_id)->first();
			$order->order_status=$request->order_status;
			$order->save();

			return redirect()->back()->with('success','Return Successfully');
		}

		public function assignDeliveryman(Request $request){

			$order = Order::where('order_id',$request->delivery_man_id)->first();
			$order->delivery_man = $request->delivery_partner;
			$order->save();

			return redirect()->back()->with('success','Delivery Man Assigned Successfully');
		}

		public function export(Request $request){

			return Excel::download(new OrdersExport(), 'orders.csv');

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

				$activity_log = new ActivityLog;
	            $activity_log->user_id = Auth::guard('admin')->user()->id;
	            $activity->user_type = 'Admin';
				$activity->module = 'Order';
				$activity->activity = 'Order Approved for Order ID -'. $order_id;
	            $activity->created_at = now();
	            $activity->updated_at = now();
	            $activity->save();
				
			}else{

				$notification = new Notification;
				$notification->message = "Order has been rejected for Order ID -" . $order_id;
				$notification->customer_id = $customer_id;
				$notification->created_at = now();
				$notification->save();

				$activity_log = new ActivityLog;
	            $activity_log->user_id = Auth::guard('admin')->user()->id;
	            $activity->user_type = 'Admin';
				$activity->module = 'Order';
				$activity->activity = 'Order Rejected for Order ID -'. $order_id;
	            $activity->created_at = now();
	            $activity->updated_at = now();
	            $activity->save();
				
			}
			
			return redirect()->back()->with('success','Order Status Updated Successfully');
		}

		// public function approveOrReject(Request $request){

		// 	$order = Order::where('id',$request->approve_id)->first();
		// 	$order_id = $order->order_id;
		// 	$customer_id = $order->customer_id;

		// 	if($request->order_status == 1){
		// 		$order->order_status = 2;
		// 		Mail::send('email.order_approved',
		// 			['customer' => $customer, 'order' => $order],
		// 			function($message) use ($customer,$order){
		// 				$message->to($customer->email);
		// 				$message->subject("Order Has Been Approved");
		// 			}
		// 		);
		// 	}else{
		// 		$order->order_status = 5;
		// 		Mail::send('email.order_cancelled',
		// 			['customer' => $customer, 'order' => $order],
		// 			function($message) use ($customer,$order){
		// 				$message->to($customer->email);
		// 				$message->subject("Order Has Been Rejected");
		// 			}
		// 		);
		// 	}

		// 	$order->save();

		// 	$customer = customer::where('id',$customer_id)->first();
			
		// 	if($request->order_status == 1){

		// 		$notification = new Notification;
		// 		$notification->message = "Order has been approved for Order ID -" . $order_id;
		// 		$notification->customer_id = $customer_id;
		// 		$notification->created_at = now();
		// 		$notification->save();

		// 		$activity_log = new ActivityLog;
	 //            $activity_log->user_id = Auth::guard('admin')->user()->id;
	 //            $activity->user_type = 'Admin';
		// 		$activity->module = 'Order';
		// 		$activity->activity = 'Order Approved for Order ID -'. $order_id;
	 //            $activity->created_at = now();
	 //            $activity->updated_at = now();
	 //            $activity->save();
				
		// 	}else{

		// 		$notification = new Notification;
		// 		$notification->message = "Order has been rejected for Order ID -". $order_id;
		// 		$notification->customer_id = $customer_id;
		// 		$notification->created_at = now();
		// 		$notification->save();

		// 		$activity_log = new ActivityLog;
	 //            $activity_log->user_id = Auth::guard('admin')->user()->id;
	 //            $activity->user_type = 'Admin';
		// 		$activity->module = 'Order';
		// 		$activity->activity = 'Order Rejected for Order ID -'. $order_id;
	 //            $activity->created_at = now();
	 //            $activity->updated_at = now();
	 //            $activity->save();

				
		// 	}
			
		// 	return redirect()->back()->with('success','Order Status Updated Successfully');
		// }


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

			$activity = new ActivityLog;
			$activity->user_id = Auth::guard('admin')->user()->id;
			$activity->user_type = 'Admin';
			$activity->module = 'Order';
			$activity->activity = 'Order Approved & Ready for Delivery for Order ID -'. $order_id;
			$activity->created_at = now();
	        $activity->updated_at = now();
			$activity->save();
			
			
			return redirect()->back()->with('success','Order Status Updated Successfully');
		}


		// public function ProgressOrder(Request $request){

		// 	$order = Order::where('id',$request->progress_id)->first();
		// 	$order->order_status = 3;
		// 	$order->save();
			
		// 	$order_id = $order->order_id;
		// 	$customer_id = $order->customer_id;

		// 	$notification = new Notification;
		// 	$notification->message = "Order has been approved for Order ID -" . $order_id;
		// 	$notification->customer_id = $customer_id;
		// 	$notification->created_at = now();
		// 	$notification->save();

		// 	$activity = new ActivityLog;
		// 	$activity->user_id = Auth::guard('admin')->user()->id;
		// 	$activity->user_type = 'Admin';
		// 	$activity->module = 'Order';
		// 	$activity->activity = 'Order Approved & Ready for Delivery for Order ID -'. $order_id;
		// 	$activity->created_at = now();
	 //        $activity->updated_at = now();
		// 	$activity->save();
			
			
		// 	return redirect()->back()->with('success','Order Status Updated Successfully');
		// }
		
		public function cancelOrder(Request $request){

			$order = Order::where('order_id',$request->id)->update(['order_status' => 5, 'cancel_reason' => $request->reason, 'comment' => $request->comment]);
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

			$order = Order::where('id',$request->c_id)->first();
			$order->order_status = 5;
			$order->cancel_reason = $request->reason;
			$order->comment = $request->comment;
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

	}	
