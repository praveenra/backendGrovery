<?php	
		
	namespace App\Http\Controllers\Admin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\User;
    use App\Models\Settings;
    use App\Models\Seller;	
	use App\Models\City;
	use App\Models\Measurement;
	use App\Http\Requests\Measurement\Addform;
		
	class AdminMeasurement extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Measurement',
            'page_auth'=> 'superadmin',
        );		
		/**  			
			* Contructor to aunthendicate user			
		*/		
		public function __construct(){			
			$this->middleware('superadmin');			
		}		
				
		/**			
			* Display a listing of the resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
				
		public function index(Request $request){			

            $this->data['senddata'] = Measurement::paginate();
            $this->data['message'] = 'No Measurement Added';
            $this->data['add'] = 'measurement.create';
			$this->data['edit'] = url('admin/measurement'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('admin.measurement.manage', $this->data);  
		}		


		public function filter(Request $request){

            $this->data['senddata'] = Measurement::where('status',$request->status)->get();
            $this->data['message'] = 'No Measurement Added';
            $this->data['add'] = 'measurement.create';
			$this->data['edit'] = url('admin/measurement'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('admin.measurement.manage_ajax', $this->data);  

		}	
				
		/**			
			* Show the form for creating a new resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
		public function create()		
		{			
			$this->data['senddata'] = new Measurement;
			$this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('measurement.store');
			$this->data['method'] = 'POST';
			return view('admin.measurement.addedit', $this->data); 		
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
				$create_array = new Measurement;
				$create_array = $create_array->fill($insert_array);
				$create_array->save();

				$activity = new ActivityLog;
				$activity->user_id = Auth::guard('admin')->user()->id;
				$activity->user_type = 'Admin';
				$activity->module = 'Measurement';
				$activity->activity = 'Measurement Added';
				$activity->created_at = now();
	        	$activity->updated_at = now();
				$activity->save();

				return redirect('admin/measurement')->with('success', 'Measurement Added Successfully');
				
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
			$this->data['senddata'] =  Measurement::find($id);	
			$this->data['message'] = 'Update Measurement';        
            $this->data['method'] = 'PUT';
			$this->data['route'] = array('measurement.update',$id);
			$this->data['page_details'] = $this->page_details;
			return view('admin.measurement.addedit',$this->data);
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
				'name'=>'required',
                'status'=>'required',
			);
			$messages = array(
				'name.required' => 'Enter Measurement Name',
				'status.required' => 'Choose Status', 
			);

            $user_data = $request->except('_token','_method');

			try{
				$_update_record = Measurement::find($id);
				$_update_record->fill($user_data);
                $_update_record->save();

                $activity = new ActivityLog;
				$activity->user_id = Auth::guard('admin')->user()->id;
				$activity->user_type = 'Admin';
				$activity->module = 'Measurement';
				$activity->activity = 'Measurement Updated';
				$activity->created_at = now();
	        	$activity->updated_at = now();
				$activity->save();

				return redirect('admin/measurement')->with('success', 'Measurement Updated Successfully');
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
		public function deleteMeasurement(Request $request)		
		{			
			$user = Measurement::find($request->delete_id);
			$user->delete();

			$activity = new ActivityLog;
			$activity->user_id = Auth::guard('admin')->user()->id;
			$activity->user_type = 'Admin';
			$activity->module = 'Measurement';
			$activity->activity = 'Measurement Deleted';
			$activity->created_at = now();
	        $activity->updated_at = now();
			$activity->save();

			return redirect()->back()->with('success','Measurement Deleted Successfully');	
		}		
	}	
