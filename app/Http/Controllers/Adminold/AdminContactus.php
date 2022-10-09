<?php	
		
	namespace App\Http\Controllers\Admin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\User;
    use App\Models\Settings;
    use App\Models\Seller;	
	use App\Models\City;
	use App\Models\Contactus;
	use App\Http\Requests\Contactus\Addform;
		
	class AdminContactus extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Contactus',
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

            $this->data['senddata'] = Contactus::paginate();
            $this->data['message'] = 'No Contact Added';
            $this->data['add'] = 'contactus.create';
			$this->data['edit'] = url('admin/contactus'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('admin.contactus.manage', $this->data);  
		}		

		public function filter(Request $request){

            $this->data['senddata'] = Contactus::where('status',$request->status)->get();
            $this->data['message'] = 'No Contact Added';
            $this->data['add'] = 'contactus.create';
			$this->data['edit'] = url('admin/contactus'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('admin.contactus.manage_ajax', $this->data);

		}	
				
		/**			
			* Show the form for creating a new resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
		public function create()		
		{			
			$this->data['senddata'] = new Contactus;
			$this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('contactus.store');
			$this->data['method'] = 'POST';
			return view('admin.contactus.addedit', $this->data); 		
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
				$create_array = new Contactus;
				$create_array = $create_array->fill($insert_array);
				$create_array->save();

				$activity = new ActivityLog;
				$activity->user_id = Auth::guard('admin')->user()->id;
				$activity->user_type = 'Admin';
				$activity->module = 'Contact Us';
				$activity->activity = 'Contact Us Details Added';
				$activity->created_at = now();
	        $activity->updated_at = now();
				$activity->save();

				return redirect('admin/contactus')->with('success', 'Contact Added Successfully');
				
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
			$this->data['senddata'] =  Contactus::find($id);	
			$this->data['message'] = 'Update Contact';        
            $this->data['method'] = 'PUT';
			$this->data['route'] = array('contactus.update',$id);
			$this->data['page_details'] = $this->page_details;
			return view('admin.contactus.addedit',$this->data);
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
				'email'=>'required',
                'phon_no'=>'required',
                'address'=>'required',
                'status'=>'required',
			);
			$messages = array(
				'email.required' => 'Enter Eamil Address',
				'phon_no.required' => 'Enter Phone Number',        
				'address.required' => 'Enter Address', 
				'status.required' => 'Choose Status', 
			);

            $user_data = $request->except('_token','_method');

			try{
				$_update_record = Contactus::find($id);
				$_update_record->fill($user_data);
                $_update_record->save();


                $activity = new ActivityLog;
				$activity->user_id = Auth::guard('admin')->user()->id;
				$activity->user_type = 'Admin';
				$activity->module = 'Contact Us';
				$activity->activity = 'Contact Us Details Updated';
				$activity->created_at = now();
	        $activity->updated_at = now();
				$activity->save();

				return redirect('admin/contactus')->with('success', 'Contact Updated Successfully');
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
		public function deleteContact(Request $request)		
		{			
			$user = Contactus::find($request->delete_id);
			$user->delete();


			$activity = new ActivityLog;
			$activity->user_id = Auth::guard('admin')->user()->id;
			$activity->user_type = 'Admin';
			$activity->module = 'Contact Us';
			$activity->activity = 'Contact Us Details Deleted';
			$activity->created_at = now();
	        $activity->updated_at = now();
			$activity->save();

			return redirect()->back()->with('success','Contact Deleted Successfully');	
		}		
	}	
