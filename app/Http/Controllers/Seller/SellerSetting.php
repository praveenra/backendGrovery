<?php	
		
	namespace App\Http\Controllers\Seller;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\User;
    use App\Models\Seller;	
	use App\Models\City;
	use App\Models\StoreSettings;
	use App\Http\Requests\StoreSettings\Addform;
		
	class SellerSetting extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Setting',
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
				
		public function index(Request $request){			

			$user_data=User::where('user_status','1')->where('user_type','2')->get();
			$user_list=array();
			foreach($user_data as $key=>$value){
				$user_list[$value->id]=$value->first_name.$value->last_name;	 
			}
			$sellerid=auth()->guard('seller')->user()->id;
            $this->data['senddata'] = StoreSettings::where('seller_id','=',$sellerid)->paginate();
            $this->data['message'] = 'No Settings Added';
            $this->data['user_list'] = $user_list;
            $this->data['add'] = 'setting.create';
			$this->data['edit'] = url('seller/setting'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('seller.setting.manage', $this->data);  
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
            $this->data['route'] = array('setting.store');
			$this->data['method'] = 'POST';
			return view('seller.setting.addedit', $this->data); 		
		}		
				
		/**			
			* Store a newly created resource in storage.			
			*			
			* @param  \Illuminate\Http\Request  $request			
			* @return \Illuminate\Http\Response			
		*/		
		public function store(Addform $request)		
		{			

			
            $insert_array = $request->except(['_token']);

			$insert_array['created_by']=auth()->guard('seller')->user()->id;
			$insert_array['updated_by']=auth()->guard('seller')->user()->id;
			//print_r($request->opening_day);exit;
			$insert_array['opening_day']=implode(",",$request->opening_day);
			try{
				$create_array = new StoreSettings;
				$create_array = $create_array->fill($insert_array);
				$create_array->save();

				$activity = new ActivityLog;
				$activity->user_id = Auth::guard('seller')->user()->id;
				$activity->user_type = 'Seller';
				$activity->module = 'Settings';
				$activity->activity = 'Settings Added';
				$activity->created_at = now();
	        	$activity->updated_at = now();
				$activity->save();

				return redirect('seller/setting')->with('success', 'Settings Added Successfully');
				
			}
			catch(\Illuminate\Database\QueryException $e){ 
				return redirect()->back()->withInput()->with('failure', $e->getMessage());
			}
			catch (Exception $e){
				report($e);
				return redirect()->back()->withInput()->with('failure', $e->getMessage());
			}
		}	

		public function saveSetting(Request $request)		
		{			
			if($request->id){
				$setting = StoreSettings::where('id',$request->id)->first();
				$setting->opening_day = $request->opening_day;
				$setting->opening_time = $request->opening_time;
				$setting->closing_time = $request->closing_time;
				$setting->save();
			}else{
				$data = $request->form_data;
				foreach ($data as $value) {
					$value['seller_id'] = auth()->guard('seller')->user()->id;
                	$value['created_by'] = auth()->guard('seller')->user()->id;
                	$value['updated_by'] = auth()->guard('seller')->user()->id;
                	$settings = StoreSettings::insert($value);
            	}
			}

            return redirect('seller/setting')->with('success', 'Settings Added Successfully');

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
			$this->data['route'] = array('setting.update',$id);
			$this->data['page_details'] = $this->page_details;
			return view('seller.setting.edit',$this->data);
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
			$rules=array(
				'seller_id'=>'required',
                'opening_time'=>'required',
                'closing_time'=>'required',
			);
			$messages = array(
				'seller_id.required' => 'Enter Seller Id',
				'opening_time.required' => 'Enter Opening Timing',        
				'closing_time.required' => 'Enter Closing Time',     
			);

            $user_data = $request->except('_token','_method');
			$user_data['opening_day']=implode(",",$request->opening_day);

			try{
				$_update_record = StoreSettings::find($id);
				$_update_record->fill($user_data);
                $_update_record->save();

                $activity = new ActivityLog;
				$activity->user_id = Auth::guard('seller')->user()->id;
				$activity->user_type = 'Seller';
				$activity->module = 'Settings';
				$activity->activity = 'Settings Updated';
				$activity->created_at = now();
	        	$activity->updated_at = now();
				$activity->save();

				return redirect('seller/setting')->with('success', 'Settings Updated Successfully');
			}
			catch(\Illuminate\Database\QueryException $e){ 
				return redirect()->back()->withInput()->with('failure', $e->getMessage());
			}
			catch (Exception $e){
				report($e);
				return redirect()->back()->withInput()->with('failure', $e->getMessage());
			}

		}		
				
		/**			
			* Remove the specified resource from storage.			
			*			
			* @param  int  $id			
			* @return \Illuminate\Http\Response			
		*/		
		public function deleteSetting(Request $request)		
		{			
			$setting = StoreSettings::find($request->delete_id);
			$setting->delete();

			$activity = new ActivityLog;
			$activity->user_id = Auth::guard('seller')->user()->id;
			$activity->user_type = 'Seller';
			$activity->module = 'Settings';
			$activity->activity = 'Settings Deleted';
			$activity->created_at = now();
        	$activity->updated_at = now();
			$activity->save();

			return redirect()->back()->with('success','Settings Deleted Successfully');	
		}
	}	
