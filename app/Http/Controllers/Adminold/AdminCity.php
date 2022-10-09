<?php	
		
	namespace App\Http\Controllers\Admin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\User;
    use App\Models\Settings;
    use App\Models\Seller;	
	use App\Models\City;
	use App\Models\Area;
	use App\Http\Requests\City\Addform;
		
	class AdminCity extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'City',
            'page_auth'=> 'admin',
        );		
		/**  			
			* Contructor to aunthendicate user			
		*/		
		public function __construct(){			
			$this->middleware('admin');			
		}		
				
		/**			
			* Display a listing of the resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
				
		public function index(Request $request){			

            $this->data['senddata'] = City::paginate();
            $this->data['message'] = 'No City Added';
            $this->data['add'] = 'city.create';
			$this->data['edit'] = url('admin/city'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('admin.city.manage', $this->data);  
		}	

		public function filter(Request $request){

            $this->data['senddata'] = City::where('city_status',$request->status)->get();
            $this->data['message'] = 'No City Added';
            $this->data['add'] = 'city.create';
			$this->data['edit'] = url('admin/city'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');

            return view('admin.city.manage_ajax', $this->data);  
			
		}			
				
		/**			
			* Show the form for creating a new resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
		public function create()		
		{			
			$this->data['senddata'] = new City;
			$this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('city.store');
         //   $this->data['cityvalue'] = City::allcities();
			$this->data['method'] = 'POST';
			return view('admin.city.addedit', $this->data); 		
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

			$insert_array['created_by']=auth()->guard('admin')->user()->id;
			$insert_array['updated_by']=auth()->guard('admin')->user()->id;
			try{
				$create_array = new City;
				$create_array = $create_array->fill($insert_array);
				$create_array->save();

				$activity = new ActivityLog;
				$activity->user_id = Auth::guard('admin')->user()->id;
				$activity->user_type = 'Admin';
				$activity->module = 'City';
				$activity->activity = 'City Added';
				$activity->created_at = now();
	        $activity->updated_at = now();
				$activity->save();

				return redirect('admin/city')->with('success', 'City Added Successfully');
				
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
			$this->data['senddata'] =  City::find($id);	
			$this->data['message'] = 'Update Area';        
            $this->data['method'] = 'PUT';	
           // $this->data['cityvalue'] = City::allcities();
			$this->data['route'] = array('city.update',$id);
			$this->data['page_details'] = $this->page_details;
			return view('superadmin.city.addedit',$this->data);
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
				'city_name'=>'required',
                'city_status'=>'required',
			);
			$messages = array(
				'city_name.required' => 'Enter Area Name',       
				'city_status.required' => 'Choose Status', 
			);

            $user_data = $request->except('_token','_method');

			try{
				$_update_record = City::find($id);
				$_update_record->fill($user_data);
                $_update_record->save();

                $activity = new ActivityLog;
				$activity->user_id = Auth::guard('admin')->user()->id;
				$activity->user_type = 'Admin';
				$activity->module = 'City';
				$activity->activity = 'City Updated';
				$activity->created_at = now();
	        $activity->updated_at = now();
				$activity->save();

				return redirect('admin/city')->with('success', 'City Updated Successfully');
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
		public function deleteCity(Request $request)		
		{			
			$user = City::find($request->delete_id);
			$user->delete();

			$activity = new ActivityLog;
			$activity->user_id = Auth::guard('admin')->user()->id;
			$activity->user_type = 'Admin';
			$activity->module = 'City';
			$activity->activity = 'City Deleted';
			$activity->created_at = now();
	        $activity->updated_at = now();
			$activity->save();

			return redirect()->back()->with('success','City Deleted Successfully');	
		}		
	}	
