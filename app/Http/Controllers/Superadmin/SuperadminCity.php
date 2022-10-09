<?php	
		
	namespace App\Http\Controllers\Superadmin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;
	use App\Http\Controllers\SuperadminController;	
    use App\Models\Common;
	use App\Models\User;
    use App\Models\Settings;
    use App\Models\Seller;	
	use App\Models\City;
	use App\Models\Area;
	use App\Http\Requests\City\Addform;
		
	class SuperadminCity extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'City',
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
				
		public function index(Request $request){			

            $this->data['senddata'] = City::paginate();
            $this->data['message'] = 'No City Added';

            return view('superadmin.city.manage', $this->data);  
		}	

		public function filter(Request $request){

			if($request->status == NULL){
            	$this->data['senddata'] = City::get();
			}else{
				$this->data['senddata'] = City::where('city_status',$request->status)->get();
			}
            $this->data['message'] = 'No City Added';

            return view('superadmin/city/manage_ajax', $this->data);  
			
		}			
				
		/**			
			* Show the form for creating a new resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
		public function create()		
		{			

			return view('superadmin/city/add');		
		}		
				
		/**			
			* Store a newly created resource in storage.			
			*			
			* @param  \Illuminate\Http\Request  $request			
			* @return \Illuminate\Http\Response			
		*/		
		public function store(Request $request)		
		{			
			// dd($request->all());
			
  
	       //City::create($request->all());

	       $city = new City;

	       $city->city_name             = $request->city_name;
	       $city->lat                   = $request->lat;
	       $city->long                  = $request->long;
	       $city->city_status           = $request->city_status;
	       $city->buisness              = $request->buisness;
	       $city->buisness_image        = $request->buisness_image;
	       $city->buisness_text         = $request->buisness_text;
	       $city->promo_available       = $request->promo_available;
	       $city->pay_by_cash           = $request->pay_by_cash;
	       $city->other_payment_method  = $request->other_payment_method;
	       $city->wallet_in_cash        = $request->wallet_in_cash;
	       $city->wallet_in_other       = $request->wallet_in_other;
	       $city->received_cash_payment = $request->received_cash_payment;
	       $city->min_amount            = $request->min_amount;
	       $city->radius                = $request->radius;
	       $city->use_radius            = $request->use_radius;
	       $city->area                  = $request->area;
	       $city->vertices              = $request->vertices;
	       $city->zone          	    = $request->zone;
	       $city->zone_name             = $request->zone_name;
	       $city->save();

	       return redirect('superadmin/city_index')->with('success', 'City Added Successfully');


		}		
				
		
		public function edit($id)
	    {
	        $city=City::where('city_id',$id)->first();
	        return view('superadmin/city/edit',compact('city'));

	    }


	    public function update(Request $request)
	    {
			$request->validate([
	        	'city_name' =>'required',
	        	'lat' =>'required',
	        	'long' =>'required',
	        	// 'time_zone' =>'required',
	        	'city_status' =>'required',

	        ]);
	  

	        $city=City::where('city_id',$request->id)->first();

	       $city->city_name             = $request->city_name;
	       $city->lat                   = $request->lat;
	       $city->long                  = $request->long;
	       $city->city_status           = $request->city_status;
		
		// if($request->buisness === null){$city->buisness = null;}
		if($request->buisness === 'on'){
			$city->buisness = 'on';
		}else{
			$city->buisness = null;
		}
	       
	       $city->buisness_image        = $request->buisness_image;
	       $city->buisness_text         = $request->buisness_text;
	       $city->promo_available       = $request->promo_available;
	       $city->pay_by_cash           = $request->pay_by_cash;
	       $city->other_payment_method  = $request->other_payment_method;
	       $city->wallet_in_cash        = $request->wallet_in_cash;
	       $city->wallet_in_other       = $request->wallet_in_other;
	       $city->received_cash_payment = $request->received_cash_payment;
	       $city->min_amount            = $request->min_amount;
	       $city->radius                = $request->radius;
	       $city->use_radius            = $request->use_radius;
	       $city->area                  = $request->area;
	       $city->vertices              = $request->vertices;
	       $city->zone          	    = $request->zone;
	       $city->zone_name             = $request->zone_name;
	       $city->save();
	       

	        return redirect('superadmin/city_index')->with('success','Detail updated successfully');
	    }	
						
				
		/**			
			* Remove the specified resource from storage.			
			*			
			* @param  int  $id			
			* @return \Illuminate\Http\Response			
		*/		
		public function deleteCity(Request $request)		
		{			
			$user = City::find($request->delete_id);
			$user->delete();
			return redirect()->back()->with('success','City Deleted Successfully');	
		}

		public function inactiveData(Request $request){

			$change_status = City::where('city_id',$request->id)->first();
			$change_status->city_status = 0;
			$change_status->save();
		}

		public function activeData(Request $request){
			
			$change_status = City::where('city_id',$request->id)->first();
			$change_status->city_status = 1;
			$change_status->save();
		}	

	}