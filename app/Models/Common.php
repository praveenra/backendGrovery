<?php
	
	namespace App\Models;
	use Carbon\Carbon;
	use App\Http\Models\Orders;
	use App\Http\Models\OrdersProducts;
	use App\Http\Models\ProductVariants;
	use Cart;
	use Mail;
	class Common
	{
		public function ImageUpload($file, $add_name=''){
			$imageName =  $add_name.time().$file->getClientOriginalName();
			$imageName = $this->clean($imageName);
			$destinationPath = './admin/images';
			$uploadSuccess = $file->move($destinationPath,$imageName);
			return $imageName;
		}
		
		public function getcutrrenttime(){
			$dates['created_at'] = Carbon::now();
			$dates['updated_at'] = Carbon::now();
			return $dates;
		}
		
		function clean($string) {
			$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
			return preg_replace('/[^a-zA-Z0-9_.]/', '-', $string);
		}
		
		public function createorder($shipping_id='', $billing_id='', $order_id=''){
			
			$cart_products = Cart::content();
			$product_variant = 0;
			$order_prefix="VINW";
			$order_count = Orders::count();
			
			$initial_order = 0;
			$orders=array();
			
			if(count($cart_products)){
				$created_order_id=0;
				foreach($cart_products as $key=>$cart_product){
					$product_variant = ProductVariants::where('pv_id',$cart_product->options->product_variant_id)->first(['pv_sku','pv_gst','pv_cgst','pv_igst']);
					if($initial_order==0){
						$_create_order = array(
                        'or_u_id'=>auth()->guard('user')->user()->id,
                        'or_up_id'=>auth()->guard('user')->user()->id,
                        'or_ct_id'=>$cart_product->options->category,
                        'or_or_id'=>0,
                        'or_sp_id'=>$shipping_id,
                        'or_bi_id'=>$billing_id,
                        'or_quantity'=>$cart_product->qty,
                        'or_invoice'=>0,
                        'or_amount'=>$order_count,
                        'or_status'=>9,
                        'or_discount'=>$cart_product->options->discount,
                        'or_trans_id'=>0,
                        'or_trans_date'=> Carbon::now(),
                        'or_trans_method'=>1,
                        'or_trans_type'=>1,
                        'or_trans_gateway'=>1,
                        'or_trans_message'=>'Creating Order',
                        'or_trans_status'=>'Creating Order',
                        'or_trans_response'=>'Creating Order',
						);
						
						$create_order = new Orders;
						$create_order = $create_order->create($_create_order);
						$created_order_id = $create_order->or_id;
						$orders[] = $create_order->or_id;
						
					}
					
					
					
					if($cart_product->options && $created_order_id){
						$create_order_products = array(
                        'op_or_id'=>$created_order_id,
                        'op_pr_id'=>$cart_product->options->product_id,
                        'op_pw_id'=>$cart_product->options->product_variant_id,
                        'op_sku'=>$product_variant->pv_sku,
                        'op_regular_price'=>$cart_product->options->product_regular_price,
                        'op_sale_price'=>$cart_product->options->product_sales_price,
						'op_offer_price'=>(($cart_product->options->product_offer_price)!=0) ? $cart_product->options->product_offer_price : 0,
                        'op_offer_per'=>(($cart_product->options->product_offer_percentage)!=0) ? $cart_product->options->product_offer_percentage : 0,
                        'op_stock'=>$cart_product->qty,
                        'op_gst'=>$product_variant->pv_gst,
                        'op_cgst'=>$product_variant->pv_cgst,
                        'op_igst'=>$product_variant->pv_igst,
                        'op_shipping_charge'=>0,
                        'op_status'=>1,
                        'created_by'=> auth()->guard('user')->user()->id,
                        'updated_by'=>1,
						);
						$_create_order_products = new OrdersProducts;
						$_create_order_products = $_create_order_products->create($create_order_products);
					}
					
					$initial_order+=1;
				}
				
				$order_prefix = $order_prefix.$created_order_id;
				Orders::whereIn('or_id',$orders)->update(array('or_invoice'=>$order_prefix));
			}
			
			return $order_prefix;
		}
		
		public function sendorderemail($order_details, $order_status='', $to_mail=''){
			
			if($order_status){
				
				Mail::send('email.orderstatus', ['details'=>$order_details,'status'=>$order_status], function ($message) use ($to_mail){
					$message->from('info@vinnwealth.in');
					if($to_mail){
						$message->to($to_mail);
					}
					else{
						$message->to('info@vinnwealth.in');
					}
					$message->subject('Reg : Order Status in Vinnwealth Shop');
				});
				
				
				}else{
				
				Mail::send('email.orderconfirmation', ['details'=>$order_details], function ($message) use ($to_mail){
					$message->from('info@vinnwealth.in');
					if($to_mail){
						$message->to($to_mail);
					}
					else{
						$message->to('info@vinnwealth.in');
					}
					$message->subject('Reg : Order Placed in Vinnwealth Shop');
				});
			}
		}
		
		public function Taxcalculation($order_details){
			
            
            $total_tax=0;
            $client_state=ContactSettings::where('cs_id',1)->first();
			$client_state_details=$client_state->cs_state;
			
			$finaltaxdata=array();
			foreach($order_details as $order_detail){
				
				
				
				
                $shipping_id=$order_detail->or_sp_id;
				$totalamount=$order_detail->or_amount;
				$user_state=Profile::where('pr_id',$shipping_id)->first();
				$user_state_details=$user_state->pr_state;
				foreach($order_detail['orderedproducts'] as $orderedproduct){
					
                    $taxdata=array();
                    $order_product_id=$orderedproduct->id;
                    $sgst=$orderedproduct->productvariant->pv_gst;
					$op_cgst=$orderedproduct->productvariant->pv_cgst;
					$op_igst=$orderedproduct->productvariant->pv_igst;
					
					if($user_state_details == $client_state_details){
						
						$igst_tax=0;
						
						$tax = (($totalamount) /  (100+$sgst+$op_cgst)) * ($sgst+$op_cgst);
						$cgst = round(($tax/2),3);
						$cgst = number_format($cgst, 2, '.', ''); 
						$sgst = round(($tax/2),3);
                        $sgst = number_format($sgst, 2, '.', '');
						
                        $total_tax += $cgst+$sgst;
						
                        OrdersProducts::where('id',$order_product_id)->update(array('op_gst'=>$sgst,'op_cgst'=>$cgst,'op_igst'=>0));
						
						}else{
						$igst_tax=1;
						$igst = (($totalamount)/  (100+$op_igst)) * $op_igst;
						$igst = round($igst,2);
                        $total_tax += $igst;
                        
                        OrdersProducts::where('id',$order_product_id)->update(array('op_igst'=>$igst,'op_gst'=>0,'op_cgst'=>0));
					}
				}
			}
            return $total_tax;
		}
		
		
		
	}
