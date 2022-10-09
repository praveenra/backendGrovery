<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\SuperadminController;	
use App\Models\Common;
use App\Models\User;
use App\Models\Settings;
use App\Models\Seller;	
use App\Models\Deliveryinfo;
use App\Models\Deliveryfee;
use App\Models\Deliveryzone;
use App\Models\Area;
use App\Http\Requests\Deliveryinfo\Addform;

class SuperadminDeliveryInfo extends Controller
{
	    protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Delivery Fee',
            'page_auth'=> 'superadmin',
        );	

        public function index(Request $request){			

            $this->data['senddata'] = Deliveryinfo::paginate();
            $this->data['message'] = 'No Deliveryinfo Added';
            $this->data['add'] = 'delivery_info.create';
			$this->data['edit'] = url('superadmin/delivery_info'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');

            return view('superadmin.delivery_info.manage', $this->data);  
		}	


		public function filter(Request $request){

            $this->data['senddata'] = Deliveryinfo::where('vehicle_name',$request->vehicle_name)->get();
            $this->data['message'] = 'No Deliveryinfo Added';
            $this->data['add'] = 'delivery_info.create';
			$this->data['edit'] = url('superadmin/delivery_info'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');

            return view('superadmin/delivery_info/manage_ajax', $this->data);  
			
		}

		public function create()		
		{	

			$this->data['area'] = Area::where('area_status',1)->get();
			$this->data['area2'] = Area::where('area_status',1)->get();
			
			return view('superadmin/delivery_info/add', $this->data);		
		}	

		public function store(Request $request)		
		{			
			// dd($request->all());
  
	       //Deliveryinfo::create($request->all());

	       $deliveryinfo = new Deliveryinfo;

	       $deliveryinfo->city_name                = $request->city_name;
	       $deliveryinfo->delivery_type            = $request->delivery_type;
	       $deliveryinfo->vehicle_name             = $request->vehicle_name;
	       $deliveryinfo->buisness                 = $request->buisness;
			

	       $deliveryinfo->use_distance_calculation = $request->use_distance_calculation;
	       if($request->use_distance_calculation != 'on'){

	       	   $deliveryinfo->base_price_distance     = $request->base_price_distance;
		       $deliveryinfo->base_price               = $request->base_price;
		       $deliveryinfo->price_per_unit_distance  = $request->price_per_unit_distance;
		       $deliveryinfo->price_per_unit_time      = $request->price_per_unit_time;
		       $deliveryinfo->service_tax              = $request->service_tax;
		       $deliveryinfo->min_fare                 = $request->min_fare;			
			}

	       $deliveryinfo->profit_mode 	= $request->profit_mode;
	       $deliveryinfo->profit_value  = $request->profit_value;      

	       // $deliveryinfo->select_zone1  = $request->select_zone1;
	       // $deliveryinfo->select_zone2  = $request->select_zone2;
	       // $deliveryinfo->amount        = $request->amount;

	       $deliveryinfo->save();
	       // dd($deliveryinfo->id);
	       if($deliveryinfo->use_distance_calculation == 'on'){
		       	foreach ($request->addMoreInputFields as $value) {
		       		$value['delivery_id'] = $deliveryinfo->id;
	            	$delivery = Deliveryfee::insert($value);
	       	    }
       		}


	       	foreach ($request->addMoreInputFields as $value) {
	       		$value['delivery_zone_id'] = $deliveryinfo->id;
            	$delivery = Deliveryzone::insert($value);
       	    }
       		

	      return redirect('superadmin/delivery_info_index')->with('success','Delivery Info added successfully');

		}

		public function edit($id)
	    {
	    	$this->data['area'] = Area::where('area_status',1)->get();
	    	$this->data['area2'] = Area::where('area_status',1)->get();
	        $this->data['deliveryinfo']=Deliveryinfo::where('id',$id)->first();
	        $this->data['delivery_fees'] = Deliveryfee::where('delivery_id',$id)->get();
	        $this->data['count'] = Deliveryfee::where('delivery_id',$id)->count();
	        return view('superadmin/delivery_info/edit',$this->data);

	    }

	    public function update(Request $request)
	    {

	        $deliveryinfo=Deliveryinfo::where('id',$request->id)->first();

	        $deliveryinfo->city_name      = $request->city_name;
	        $deliveryinfo->delivery_type  = $request->delivery_type;
	        $deliveryinfo->vehicle_name   = $request->vehicle_name;
	        $deliveryinfo->buisness       = $request->buisness;

	        $deliveryinfo->use_distance_calculation = $request->use_distance_calculation;
	        if($request->use_distance_calculation != 'on'){

	       	   $deliveryinfo->base_price_distance      = $request->base_price_distance;
		       $deliveryinfo->base_price               = $request->base_price;
		       $deliveryinfo->price_per_unit_distance  = $request->price_per_unit_distance;
		       $deliveryinfo->price_per_unit_time      = $request->price_per_unit_time;
		       $deliveryinfo->service_tax              = $request->service_tax;
		       $deliveryinfo->min_fare                 = $request->min_fare;
			 
			 }

	        $deliveryinfo->profit_mode 		   = $request->profit_mode;
	        $deliveryinfo->profit_value        = $request->profit_value;      

	        // $deliveryinfo->select_zone1        = $request->select_zone1;
	        // $deliveryinfo->select_zone2        = $request->select_zone2;
	        // $deliveryinfo->amount              = $request->amount;

	        $deliveryinfo->save();
	       // dd($deliveryinfo->id);
	        if($deliveryinfo->use_distance_calculation == 'on'){
	        $deliveryfee=Deliveryfee::where('delivery_id',$request->id)->delete();
	        	
		       	foreach ($request->addMoreInputFields as $value) {
		       		$value['delivery_id'] = $deliveryinfo->id;
	            	$delivery = Deliveryfee::insert($value);
	       	    }
       		 }

	       	foreach ($request->addMoreInputFields as $value) {
	       		$deliveryzone=Deliveryzone::where('delivery_id',$request->id)->delete();
	       		$value['delivery_zone_id'] = $deliveryinfo->id;
            	$delivery = Deliveryzone::insert($value);
       	    }
       		
	        return redirect('superadmin/delivery_info_index')->with('success','Delivery Info updated successfully');
	    }	


	    public function deleteDeliveryInfo(Request $request)		
		{			
			$user = Deliveryinfo::find($request->delete_id);

			if($user->use_distance_calculation == 'on'){
				$deliveryfee=Deliveryfee::where('delivery_id',$request->delete_id)->delete();
			}

			$user->delete();
			
			return redirect()->back()->with('success','Deliveryinfo Deleted Successfully');	
		}


}
