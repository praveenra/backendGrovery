<?php	
		
	namespace App\Http\Controllers\Superadmin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
    use App\Models\User;
    use App\Models\Seller;
    use App\Models\Customer;
    use App\Models\Order;
    use App\Models\Products;
    use App\Exports\TopProductsOrder;
    use App\Exports\StoreDependProductPriceListExport;
    use App\Exports\AreaBasedCustomer;
	use Maatwebsite\Excel\Facades\Excel;
    use DB;
		
	class SuperadminDashboard extends Controller	
	{		
		protected $datas = array();		
		/**  			
			* Contructor to aunthendicate user			
		*/		
			
				
		/**			
			* Display a listing of the resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
				
		public function index(Request $request){			

			$this->data['sellers_count'] = Seller::where('sd_status',1)->count(); 
			$this->data['customers_count'] = Customer::count(); 
			$this->data['orders_count'] = Order::count(); 
			$this->data['total_sales'] = Order::sum('total'); 
			$this->data['active_customers'] = Customer::where('status',1)->count(); 
			
			return view('superadmin.dashboard.manage',$this->data);			
		}	

		// public function export_top_products_order(Request $request){

		// 	return Excel::download(new TopProductsOrder(), 'top_products_order.csv');

		// }	

		// public function export_store_depend_product_price_list(Request $request){

		// 	return Excel::download(new StoreDependProductPriceListExport(), 'store_depend_product_price_list.csv');

		// }	

		// public function export_area_based_customer(Request $request){

		// 	return Excel::download(new AreaBasedCustomer(), 'area_based_customer.csv');

		// }
				
		/**			
			* Show the form for creating a new resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
		public function create()		
		{			
			//			
		}		
				
		/**			
			* Store a newly created resource in storage.			
			*			
			* @param  \Illuminate\Http\Request  $request			
			* @return \Illuminate\Http\Response			
		*/		
		public function store(Request $request)		
		{			
			//			
		}		
				
		/**			
			* Display the specified resource.			
			*			
			* @param  int  $id			
			* @return \Illuminate\Http\Response			
		*/		
		public function show($id)		
		{			
			//			
		}		
				
		/**			
			* Show the form for editing the specified resource.			
			*			
			* @param  int  $id			
			* @return \Illuminate\Http\Response			
		*/		
		public function edit($id)		
		{			
			//			
		}		
				
		/**			
			* Update the specified resource in storage.			
			*			
			* @param  \Illuminate\Http\Request  $request			
			* @param  int  $id			
			* @return \Illuminate\Http\Response			
		*/		
		public function update(Request $request, $id)		
		{			
			//			
		}		
				
		/**			
			* Remove the specified resource from storage.			
			*			
			* @param  int  $id			
			* @return \Illuminate\Http\Response			
		*/		
		public function destroy($id)		
		{			
			//			
		}		
	}	
