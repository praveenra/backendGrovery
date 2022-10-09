<?php	
		
	namespace App\Http\Controllers\Superadmin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\User;
    use App\Models\Settings;
    use App\Models\Seller;	
	use App\Models\City;
	use App\Models\Area;
	use App\Models\Zone;
	use App\Http\Requests\Area\Addform;
		
	class SuperadminArea extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Area',
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

            $this->data['senddata'] = Area::with('cities')->paginate();
            $this->data['message'] = 'No Area Added';
            $this->data['add'] = 'area.create';
			$this->data['edit'] = url('superadmin/area'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('superadmin.area.manage', $this->data);  
		}	

		public function filter(Request $request){

            $this->data['senddata'] = Area::with('cities')->where('area_status',$request->status)->get();
            $this->data['message'] = 'No Area Added';
            $this->data['add'] = 'area.create';
			$this->data['edit'] = url('superadmin/area'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');

            return view('superadmin.area.manage_ajax', $this->data);  
			
		}		
				
		/**			
			* Show the form for creating a new resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
		public function create()		
		{			
			$this->data['senddata'] = new Area;
			$this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('area.store');
            $this->data['cityvalue'] = City::allcities();
			$this->data['zonevalue'] = Zone::allzone();
			$this->data['method'] = 'POST';
			return view('superadmin.area.addedit', $this->data); 		
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
				$create_array = new Area;
				$create_array = $create_array->fill($insert_array);
				$create_array->save();

				return redirect('superadmin/area')->with('success', 'Area Added Successfully');
				
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
			$this->data['senddata'] =  Area::find($id);	
			$this->data['message'] = 'Update Area';        
            $this->data['method'] = 'PUT';	
            $this->data['cityvalue'] = City::allcities();
			$this->data['zonevalue'] = Zone::allzone();
			$this->data['route'] = array('area.update',$id);
			$this->data['page_details'] = $this->page_details;
			return view('superadmin.area.addedit',$this->data);
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
				'area_name'=>'required',
                'area_cityid'=>'required',
                'area_status'=>'required',
			);
			$messages = array(
				'area_name.required' => 'Enter Area Name',
				'area_cityid.required' => 'Choose City',        
				'area_status.required' => 'Choose Area', 
			);

            $user_data = $request->except('_token','_method');

			try{
				$_update_record = Area::find($id);
				$_update_record->fill($user_data);
                $_update_record->save();

				return redirect('superadmin/area')->with('success', 'Area Updated Successfully');
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
		public function deleteArea(Request $request)		
		{			
			$user = Area::find($request->delete_id);
			$user->delete();
			return redirect()->back()->with('success','Area Deleted Successfully');	
		}

		public function inactiveData(Request $request){

			$change_status = Area::where('area_id',$request->id)->first();
			$change_status->area_status = 0;
			$change_status->save();
		}

		public function activeData(Request $request){
			
			$change_status = Area::where('area_id',$request->id)->first();
			$change_status->area_status = 1;
			$change_status->save();
		}		
	}	
