<?php	
		
	namespace App\Http\Controllers\Seller;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\Order;
	use App\Models\Notification;
	use App\Models\ActivityLog;
		
	class SellerOrder extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Orders',
            'page_auth'=> 'seller',
        );		
		/**  			
			* Contructor to aunthendicate user			
		*/		
		public function __construct(){			
			$this->middleware('seller');			
		}		
				
		/**			
			* Display a listing of the resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
				
		public function orders(Request $request){			

            $this->data['senddata'] = Order::select(
            							'orders.*',
            							'customer.name as customer',
            							'product.product_name as product',
            							'order_status.name as order_status_name'
            						)
            						->leftjoin('customer','customer.id','orders.customer_id')
            						->leftjoin('product','product.product_id','orders.product_id')
            						->leftjoin('order_status','order_status.id','orders.order_status')
            						->where('orders.store_id',auth()->guard('seller')->user()->id)
            						->paginate();
            $this->data['message'] = 'No Orders Available';
            $this->data['add'] = 'pages.create';
			$this->data['edit'] = url('superadmin/pages'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('seller.orders.manage', $this->data);  
		}	

		public function approveOrReject(Request $request){

			$order = Order::where('id',$request->approve_id)->first();
			$order_id = $order->order_id;
			$customer_id = $order->customer_id;

			if($request->order_status == 1){
				$order->order_status = 2;
			}else{
				$order->order_status = 5;
			}

			$order->save();
			
			if($request->order_status == 1){
				$notification = new Notification;
				$notification->message = "Order has been approved for Order ID -" . $order_id;
				$notification->customer_id = $customer_id;
				$notification->created_at = now();
				$notification->save();

				$activity = new ActivityLog;
	            $activity->user_id = Auth::guard('seller')->user()->id;
	            $activity->user_type = 'Seller';
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

				$activity = new ActivityLog;
	            $activity->user_id = Auth::guard('seller')->user()->id;
	            $activity->user_type = 'Seller';
				$activity->module = 'Order';
				$activity->activity = 'Order Rejected for Order ID -'. $order_id;
	            $activity->created_at = now();
	            $activity->updated_at = now();
	            $activity->save();
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
			$notification->message = "Order is ready for pickup for Order ID -" . $order_id;
			$notification->customer_id = $customer_id;
			$notification->created_at = now();
			$notification->save();

			$activity = new ActivityLog;
			$activity->user_id = Auth::guard('seller')->user()->id;
			$activity->user_type = 'Seller';
			$activity->module = 'Order';
			$activity->activity = 'Order Approved & Ready for Delivery for Order ID -'. $order_id;
			$activity->created_at = now();
	        $activity->updated_at = now();
			$activity->save();
			
			
			return redirect()->back()->with('success','Order Status Updated Successfully');
		}
		
	}	
