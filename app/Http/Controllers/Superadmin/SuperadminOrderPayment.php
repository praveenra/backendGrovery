<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderPayment;
use App\Models\Order;
use App\Models\User;
use App\Exports\OrderEarningListExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
class SuperadminOrderPayment extends Controller
{

	protected $data = array();
        protected $page_details =array(
            'page_name'=> 'ManageOrderPayment',
            'page_auth'=> 'superadmin',
        );	

    public function order_earning(Request $request){			
   
      $orderdetails=Order::select('orders.id as ord_id','orders.*','customer.*','seller_details.*','product.*','delivery_info.*','main_category.*','orders.total as total_amount','customer.name as cust_name')
	        ->leftjoin('seller_details','seller_details.sd_id','orders.store_id')
			->leftjoin('customer','customer.id','orders.customer_id')
			->leftjoin('product','product.product_id','orders.product_id')
			->leftjoin('delivery_info','delivery_info.id','orders.delivery')
	        ->leftjoin('main_category', 'main_category.mc_id', '=', 'seller_details.main_category')
			->get();


  		foreach($orderdetails as $admin_earning){
		$totalamount1=$admin_earning->total || 0;
		// $profitvalue1=$admin_earning->profit_value;
		$admincommission1=$admin_earning->mc_commision || 0;

        $admin_earning['admin_amount']= $totalamount1 * ($admincommission1 / 100);

		}


		$admin_amount=0;
  		foreach($orderdetails as $admin_earning){
		$totalamount1=$admin_earning->total || 0;
		// $profitvalue1=$admin_earning->profit_value;
		$admincommission1=$admin_earning->mc_commision || 0;
        $admin_amount += $totalamount1 * ($admincommission1 / 100) || 0;

		}
       $admin_earning['admin_amount']=$admin_amount || 0;
 		$this->data['admin_amount_total']=$admin_amount || 0;


		foreach($orderdetails as $delivery_man){
			$totalamount2=$delivery_man->total || 0;
			$profitvalue2=$delivery_man->profit_value || 0;
			$admincommision2=$delivery_man->mc_commision || 0;

            $delivery_man['delivery_man_amount']= $totalamount2  * ($profitvalue2 / 100) || 0;
		}


		$delivery_man_amount=0;
 		foreach($orderdetails as $delivery_man){
			$totalamount2=$delivery_man->total || 0;
			$profitvalue2=$delivery_man->profit_value || 0;
			// $admincommision2=$delivery_man->mc_commision;

			$delivery_man_amount += $totalamount2  * ($profitvalue2 / 100) || 0;

            
		}
		$delivery_man['delivery_man_amount']= $delivery_man_amount || 0;
		$this->data['delivery_man_amount_total']=$delivery_man_amount || 0;


		foreach($orderdetails as $store_earning){
			$totalamount3=$store_earning->total || 0;
			$profitvalue3=$store_earning->profit_value || 0;
			$admincommision3=$store_earning->mc_commision || 0;

			$store_earning['percentage1']= $totalamount3  * ($admincommision3 / 100) || 0;
			$store_earning['percentage2']= $totalamount3  * ($profitvalue3 / 100) || 0;
            $store_earning['store_amount']= $totalamount3 - $store_earning['percentage1'] - $store_earning['percentage2'] || 0;

		}


		$store_amount=0;
		foreach($orderdetails as $store_earning){
			$totalamount3=$store_earning->total || 0;
			$profitvalue3=$store_earning->profit_value || 0;
			$admincommision3=$store_earning->mc_commision || 0;

			$store_amount += $totalamount3 - ($totalamount3  * ($admincommision3 / 100)) - ($totalamount3  * ($profitvalue3 / 100)) ||0 ;

		}
        $store_earning['store_amount']= $store_amount || 0;
        $this->data['store_amount_total']=$store_amount || 0;


        $this->data['complete_count'] =Order::where('order_status','=', 4)->count();

        $this->data['return_count'] =Order::where('order_status','=', 6)->count();

        $this->data['order_completed_count'] =$this->data['complete_count'] + $this->data['return_count'] ;

        $this->data['cancel_count'] =Order::where('order_status','=', 5)->count();

        $this->data['total_amount'] =Order::sum('total');

		$this->data['orders_payment'] = $orderdetails;

        $this->data['message'] = 'No Orders Available';
// echo "<pre>"; print_r($this->data); exit;
        return view('superadmin/payment/order_earning', $this->data);  
	}

	public function order_earning_display($id)
    {
	    $this->data['orders_earning_details_display'] = Order::select('orders.*','customer.*','seller_details.*','product.*','delivery_info.*','main_category.*')
	        ->leftjoin('seller_details','seller_details.sd_id','orders.store_id')
			->leftjoin('customer','customer.id','orders.customer_id')
			->leftjoin('product','product.product_id','orders.product_id')
			->leftjoin('delivery_info','delivery_info.id','orders.delivery')
			->leftjoin('main_category', 'main_category.mc_id', '=', 'seller_details.main_category')
			->where('orders.id',$id)
			->first();

			$totalamount=$this->data['orders_earning_details_display']->total;
			$profitvalue=$this->data['orders_earning_details_display']->profit_value;
			$admincommission=$this->data['orders_earning_details_display']->mc_commision;

		$this->data['final_calculated_amount_display'] = ($totalamount - (($totalamount * $profitvalue)/100));

		$this->data['admin_amount']= $totalamount  * ($admincommission / 100);

		$this->data['delivery_man_amount']= $totalamount  * ($profitvalue / 100);

        $this->data['store_amount']= $totalamount - $this->data['admin_amount'] -$this->data['delivery_man_amount'];

        return response()->json($this->data);

    }

    public function export_order_earning_list(Request $request){

        return Excel::download(new OrderEarningListExport(), 'order_earning_list.csv');

    }

    public function orders_payment(Request $request){			
   
          $orderdetails=Order::select('orders.id as ord_id','orders.*','customer.*','seller_details.*','product.*','delivery_info.*','orders.total as total_amount')
		        ->leftjoin('seller_details','seller_details.sd_id','orders.store_id')
				->leftjoin('customer','customer.id','orders.customer_id')
				->leftjoin('product','product.product_id','orders.product_id')
				->leftjoin('delivery_info','delivery_info.id','orders.delivery')
				->get();

           // $finalvalue=array();
			foreach($orderdetails as $orderdetail){
				//$processarray=array();
				$totalamount=$orderdetail->total || 0;
				$profitvalue=$orderdetail->profit_value || 0;

                $orderdetail['final_calculated_amount']=($totalamount - (($totalamount * $profitvalue)/100)) || 0;

               // array_push($finalvalue,$processarray);

			}

			 // $finalvalue=array();
			foreach($orderdetails as $orderdetail){
				//$processarray=array();
				$totalamount=$orderdetail->total || 0;
				$profitvalue=$orderdetail->profit_value || 0;

                $orderdetail['delivery_man_amount']=$totalamount - ($totalamount - (($totalamount * $profitvalue)/100)) || 0;

               // array_push($finalvalue,$processarray);

			}
									
        $this->data['payment_count'] =Order::where('seller_payment_status','=','1')->count();

        $this->data['total_amount'] =Order::sum('total');

		$this->data['orders_payment'] = $orderdetails;
		
        $this->data['message'] = 'No Orders Available';
        return view('superadmin/payment/manage_order_payment', $this->data);  
	}


	public function display($id)
    {
	    $this->data['orders_payment_details_display'] = Order::select('orders.*','customer.*','seller_details.*','product.*','delivery_info.*')
	        ->leftjoin('seller_details','seller_details.sd_id','orders.store_id')
			->leftjoin('customer','customer.id','orders.customer_id')
			->leftjoin('product','product.product_id','orders.product_id')
			->leftjoin('delivery_info','delivery_info.id','orders.delivery')
			->where('orders.id',$id)
			->first();

			$totalamount=$this->data['orders_payment_details_display']->total;
			$profitvalue=$this->data['orders_payment_details_display']->profit_value;

		$this->data['final_calculated_amount_display'] = ($totalamount - (($totalamount * $profitvalue)/100));

        return response()->json($this->data);

    }

	// public function inactiveDataSeller(Request $request){

	// 	$change_status = Order::where('id',$request->id)->first();

 //       // 	  echo "<pre>";
	//       // print_r($request->id);
	//       // exit;

	// 	$change_status->seller_payment_status = 0;
	// 	$change_status->save();
	// }

	public function activeDataSeller(Request $request){
	
		$change_status = Order::where('id',$request->id)->first();

		// echo "<pre>";
	 //      print_r($request->id);
	 //      exit;
	      
		$change_status->seller_payment_status = 1;
		$change_status->save();
	}

	public function delivery_boy_payment(Request $request){			

		$delivery_boy=User::select('orders.id as ord_id','users.*','bank_details.*')
				->where('users.user_type','=',1)
				->leftjoin('bank_details','bank_details.user_id','users.id')
				->leftjoin('orders','orders.id','users.id')
				->get();

		$this->data['delivery_boy_payment'] = $delivery_boy;

        $this->data['message'] = 'No Orders Available';
        return view('superadmin/payment/delivery_boy_payment', $this->data);  
	}

	public function inactiveDataDeliveryBoy(Request $request){


		$change_status = User::select('users.*','orders.*','orders.id as ord_id')
		->where('id',$request->id)
		->leftjoin('orders','orders.id','users.id')
		->first();

       // 	  echo "<pre>";
	      // print_r($request->id);
	      // exit;

		$change_status->delivery_boy_payment_status = 0;
		$change_status->save();
	}

	public function activeDataDeliveryBoy(Request $request){
		
		$change_status = User::select('users.*','orders.*','orders.id as ord_id')
		->where('id',$request->id)
		->leftjoin('orders','orders.id','users.id')
		->first();

		// echo "<pre>";
	 //      print_r($request->id);
	 //      exit;
	      
		$change_status->delivery_boy_payment_status = 1;
		$change_status->save();
	}

	public function return_payment(Request $request){			

		$refundable=Order::select('orders.id as ord_id','orders.*','customer.*','seller_details.*')
				->where('orders.order_status','=',6)
				->leftjoin('seller_details','seller_details.sd_id','orders.store_id')
				->leftjoin('customer','customer.id','orders.customer_id')
				->get();

				 // $finalvalue=array();
				foreach($refundable as $orderdetail){
					//$processarray=array();
					$totalamount=$orderdetail->total;
					$profitvalue=$orderdetail->profit_value;

                    $orderdetail['final_calculated_amount']=($totalamount - (($totalamount * $profitvalue)/100));

                   // array_push($finalvalue,$processarray);

				}

		$this->data['return_status'] = $refundable;

        $this->data['message'] = 'No Orders Available';
        return view('superadmin/payment/return', $this->data);  
	}

	// public function inactiveDataReturnPayment(Request $request){

	// 	$change_status = Order::where('id',$request->id)->first();

	//        // echo "<pre>";
	//       // print_r($request->id);
	//       // exit;

	// 	$change_status->return_payment_status = 0;
	// 	$change_status->save();
	// }

	public function activeDataReturnPayment(Request $request){
	
		$change_status = Order::where('id',$request->id)->first();

		// echo "<pre>";
	 	// print_r($request->id);
	 	// exit;
	      
		$change_status->return_payment_status = 1;
		$change_status->save();
	}



}
