<?php	
		
	namespace App\Http\Controllers\Seller;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
    use App\Models\User;
    use App\Models\Order;
    use Auth;	
		
	class SellerDashboard extends Controller	
	{		
		protected $datas = array();		
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
				
		public function index(Request $request){
			$this->data['orders_count'] = Order::where('store_id',auth()->guard('seller')->user()->id)->count(); 
			$this->data['total_sales'] = Order::where('store_id',auth()->guard('seller')->user()->id)->sum('total'); 			

			return view('seller.dashboard.manage',$this->data);			
		}		
				
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
