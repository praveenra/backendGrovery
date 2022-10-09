<?php	
		
	namespace App\Http\Controllers\Superadmin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\User;
    use App\Models\Settings;
	use App\Models\Zone;
	use App\Http\Requests\Zone\Addform;
		
	class SuperadminZone extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Grovery Service Providing Zone',
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

            $this->data['senddata'] = Zone::paginate();
            $this->data['message'] = 'No Zone Added';
            $this->data['add'] = 'zone.create';
			$this->data['edit'] = url('superadmin/zone'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('superadmin.zone.manage', $this->data);  
		}	

		public function filter(Request $request){

            $this->data['senddata'] = Zone::where('zone_status',$request->status)->get();
            $this->data['message'] = 'No Zone Added';
            $this->data['add'] = 'zone.create';
			$this->data['edit'] = url('superadmin/zone'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');

            return view('superadmin.zone.manage_ajax', $this->data);  
			
		}		
				
		/**			
			* Show the form for creating a new resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
		public function create()		
		{			
			$this->data['senddata'] = new Zone;
			$this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('zone.store');
            //$this->data['cityvalue'] = City::allcities();
			$this->data['method'] = 'POST';
			return view('superadmin.zone.addedit', $this->data); 		
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

			$insert_array['created_by']=auth()->guard('superadmin')->user()->id;
			$insert_array['updated_by']=auth()->guard('superadmin')->user()->id;
			try{
				$create_array = new Zone;
				$create_array = $create_array->fill($insert_array);
				$create_array->save();

				return redirect('superadmin/zone')->with('success', 'Zone Added Successfully');
				
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
			$this->data['senddata'] =  Zone::find($id);	
			$this->data['message'] = 'Update Zone';        
            $this->data['method'] = 'PUT';	
          //  $this->data['cityvalue'] = City::allcities();
			$this->data['route'] = array('zone.update',$id);
			$this->data['page_details'] = $this->page_details;
			return view('superadmin.zone.addedit',$this->data);
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
				'zone_name'=>'required',
               // 'area_cityid'=>'required',
                'zone_status'=>'required',
			);
			$messages = array(
				'zone_name.required' => 'Enter Zone Name',
			//	'area_cityid.required' => 'Choose City',        
				'zone_status.required' => 'Choose Status', 
			);

            $user_data = $request->except('_token','_method');

			try{
				$_update_record = Zone::find($id);
				$_update_record->fill($user_data);
                $_update_record->save();

				return redirect('superadmin/zone')->with('success', 'Zone Updated Successfully');
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
		public function deleteZone(Request $request)		
		{			
			$user = Zone::find($request->delete_id);
			$user->delete();
			return redirect()->back()->with('success','Zone Deleted Successfully');	
		}

		public function inactiveData(Request $request){

			$change_status = Zone::where('zone_id',$request->id)->first();
			$change_status->zone_status = 0;
			$change_status->save();
		}

		public function activeData(Request $request){

			$change_status = Zone::where('zone_id',$request->id)->first();
			$change_status->zone_status = 1;
			$change_status->save();
		}		
	}	
