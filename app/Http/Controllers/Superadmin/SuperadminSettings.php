<?php	
		
	namespace App\Http\Controllers\Superadmin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\User;
    use App\Models\Seller;	
	use App\Models\City;
	use App\Models\StoreSettings;
	use App\Http\Requests\StoreSettings\Addform;
		
	class SuperadminSettings extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Settings',
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

            $this->data['senddata'] = StoreSettings::select('store_settings.*','seller_details.sd_sname')->leftjoin('seller_details','seller_details.sd_usid','store_settings.seller_id')->get();
            $this->data['message'] = 'No Settings Added';
            $this->data['add'] = 'settings.create';
			$this->data['edit'] = url('superadmin/settings'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('superadmin.settings.manage', $this->data);  
		}		
				
		/**			
			* Show the form for creating a new resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
		public function create()		
		{			
			$this->data['senddata'] = new StoreSettings;
			$this->data['code'] = "1";
			$this->data['seller_id'] = User::where('user_status','1')->where('user_type','2')->pluck('first_name','id')->all();   
			$this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('settings.store');
			$this->data['method'] = 'POST';
			return view('superadmin.settings.addedit', $this->data); 		
		}		
				
		/**			
			* Store a newly created resource in storage.			
			*			
			* @param  \Illuminate\Http\Request  $request			
			* @return \Illuminate\Http\Response			
		*/		
		public function store(Addform $request)		
		{			


			$create_array = new StoreSettings;
			$create_array->seller_id = $request->seller_id;
			
			$create_array->sunday_check = $request->sunday_check;
			$create_array->sunday_opening_time = $request->sunday_opening_time;
			$create_array->sunday_closing_time = $request->sunday_closing_time;

			$create_array->monday_check = $request->monday_check;
			$create_array->monday_opening_time = $request->monday_opening_time;
			$create_array->monday_closing_time = $request->monday_closing_time;

			$create_array->tuesday_check = $request->tuesday_check;
			$create_array->tuesday_opening_time = $request->tuesday_opening_time;
			$create_array->tuesday_closing_time = $request->tuesday_closing_time;

			$create_array->wednesday_check = $request->wednesday_check;
			$create_array->wednesday_opening_time = $request->wednesday_opening_time;
			$create_array->wednesday_closing_time = $request->wednesday_closing_time;

			$create_array->thursday_check = $request->thursday_check;
			$create_array->thursday_opening_time = $request->thursday_opening_time;
			$create_array->thursday_closing_time = $request->thursday_closing_time;

			$create_array->friday_check = $request->friday_check;
			$create_array->friday_opening_time = $request->friday_opening_time;
			$create_array->friday_closing_time = $request->friday_closing_time;

			$create_array->saturday_check = $request->saturday_check;
			$create_array->saturday_opening_time = $request->saturday_opening_time;
			$create_array->saturday_closing_time = $request->saturday_closing_time;

			$create_array->business = $request->business;

			$create_array->save();
		
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
			$this->data['senddata'] =  StoreSettings::find($id);
			$this->data['seller_id'] = User::where('user_status','1')->where('user_type','2')->pluck('first_name','id')->all();   
			$this->data['code'] = "2";			
			$this->data['message'] = 'Update Settings';        
            $this->data['method'] = 'PUT';
			$this->data['route'] = array('settings.update',$id);
			$this->data['page_details'] = $this->page_details;
			return view('superadmin.settings.addedit',$this->data);
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

			$_update_record = StoreSettings::find($id);
			$_update_record->seller_id = $request->seller_id;
			$_update_record->sunday_check = $request->sunday_check;
			$_update_record->sunday_opening_time = $request->sunday_opening_time;
			$_update_record->sunday_closing_time = $request->sunday_closing_time;
			$_update_record->monday_check = $request->monday_check;
			$_update_record->monday_opening_time = $request->monday_opening_time;
			$_update_record->monday_closing_time = $request->monday_closing_time;
			$_update_record->tuesday_check = $request->tuesday_check;
			$_update_record->tuesday_opening_time = $request->tuesday_opening_time;
			$_update_record->tuesday_closing_time = $request->tuesday_closing_time;
			$_update_record->wednesday_check = $request->wednesday_check;
			$_update_record->wednesday_opening_time = $request->wednesday_opening_time;
			$_update_record->wednesday_closing_time = $request->wednesday_closing_time;
			$_update_record->thursday_check = $request->thursday_check;
			$_update_record->thursday_opening_time = $request->thursday_opening_time;
			$_update_record->thursday_closing_time = $request->thursday_closing_time;
			$_update_record->friday_check = $request->friday_check;
			$_update_record->friday_opening_time = $request->friday_opening_time;
			$_update_record->friday_closing_time = $request->friday_closing_time;
			$_update_record->saturday_check = $request->saturday_check;
			$_update_record->saturday_opening_time = $request->saturday_opening_time;
			$_update_record->saturday_closing_time = $request->saturday_closing_time;
			$_update_record->business = $request->business;
			$_update_record->save();

		}		
				
		/**			
			* Remove the specified resource from storage.			
			*			
			* @param  int  $id			
			* @return \Illuminate\Http\Response			
		*/		
		public function deleteSetting(Request $request)		
		{			
			$user = StoreSettings::find($request->delete_id);
			$user->delete();
			return redirect()->back()->with('success','Settings Deleted Successfully');	
		}		
	}	
