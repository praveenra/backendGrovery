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
	use App\Models\ActivityLog;
	use App\Http\Requests\Area\Addform;
		
	class AdminArea extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Area',
            'page_auth'=> 'admin',
        );		
			
		public function __construct(){			
			$this->middleware('admin');			
		}		
				
		public function index(Request $request){			

            $this->data['senddata'] = Area::with('cities')->paginate();
            $this->data['message'] = 'No Area Added';
            $this->data['add'] = 'area.create';
			$this->data['edit'] = url('admin/area'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('admin.area.manage', $this->data);  
		}	

		public function filter(Request $request){

            $this->data['senddata'] = Area::with('cities')->where('area_status',$request->status)->get();
            $this->data['message'] = 'No Area Added';
            $this->data['add'] = 'area.create';
			$this->data['edit'] = url('admin/area'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');

            return view('admin.area.manage_ajax', $this->data);  
			
		}		
					
		public function create()		
		{			
			$this->data['senddata'] = new Area;
			$this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('area.store');
            $this->data['cityvalue'] = City::allcities();
			$this->data['method'] = 'POST';
			return view('admin.area.addedit', $this->data); 		
		}		
					
		public function store(Addform $request)		
		{			

			
            $insert_array = $request->except(['_token']);

			$insert_array['created_by']=auth()->guard('admin')->user()->id;
			$insert_array['updated_by']=auth()->guard('admin')->user()->id;
			try{
				$create_array = new Area;
				$create_array = $create_array->fill($insert_array);
				$create_array->save();

				$activity = new ActivityLog;
				$activity->user_id = Auth::guard('admin')->user()->id;
				$activity->user_type = 'Admin';
				$activity->module = 'Area';
				$activity->activity = 'Area Added';
				$activity->created_at = now();
	            $activity->updated_at = now();
				$activity->save();

				return redirect('admin/area')->with('success', 'Area Added Successfully');
				
			}
			catch(\Illuminate\Database\QueryException $e){ 
				return redirect()->back()->withInput()->with('failure', $e->getMessage());
			}
			catch (Exception $e){
				report($e);
				return redirect()->back()->withInput()->with('failure', $e->getMessage());
			}
		}		
					
		public function edit($id)		
		{			
			$this->data['senddata'] =  Area::find($id);	
			$this->data['message'] = 'Update Area';        
            $this->data['method'] = 'PUT';	
            $this->data['cityvalue'] = City::allcities();
			$this->data['route'] = array('area.update',$id);
			$this->data['page_details'] = $this->page_details;
			return view('admin.area.addedit',$this->data);
		}		
		
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

                $activity = new ActivityLog;
				$activity->user_id = Auth::guard('admin')->user()->id;
				$activity->user_type = 'Admin';
				$activity->module = 'Area';
				$activity->activity = 'Area Updated';
				$activity->created_at = now();
	            $activity->updated_at = now();
				$activity->save();

				return redirect('admin/area')->with('success', 'Area Updated Successfully');
			}
			catch(\Illuminate\Database\QueryException $e){ 
				return redirect()->back()->withInput()->with('failure', $e->getMessage());
			}
			catch (Exception $e){
				report($e);
				return redirect()->back()->withInput()->with('failure', $e->getMessage());
			}

		}		
				
		public function deleteArea(Request $request)		
		{			
			$user = Area::find($request->delete_id);
			$user->delete();

		    $activity = new ActivityLog;
			$activity->user_id = Auth::guard('admin')->user()->id;
			$activity->user_type = 'Admin';
			$activity->module = 'Area';
			$activity->activity = 'Area Deleted';
			$activity->created_at = now();
	        $activity->updated_at = now();
			$activity->save();

			return redirect()->back()->with('success','Area Deleted Successfully');	
		}		
	}	
