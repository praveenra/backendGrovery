<?php	
		
	namespace App\Http\Controllers\Admin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\User;
    use App\Models\Settings;
    use App\Models\Area;	
    use App\Models\City;
    use App\Models\BankDetail;
	use App\Http\Requests\Deliveryboy\Addform;
		
	class AdminDelivery extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Deliveryboy',
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

            $this->data['senddata'] = User::where('user_type',1)->with('city')->paginate();
            $this->data['message'] = 'No Deliveryboy Added';
            $this->data['add'] = 'delivery.create';
			$this->data['edit'] = url('admin/delivery'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('admin.delivery.manage', $this->data);  
		}	

		public function filter(Request $request){

            $this->data['senddata'] = User::where('user_type',1)->where('user_status',$request->status)->with('city')->paginate();
            $this->data['message'] = 'No Deliveryboy Added';
            $this->data['add'] = 'delivery.create';
			$this->data['edit'] = url('admin/delivery'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');

            return view('admin.delivery.manage_ajax', $this->data);  
			
		}			
				
		/**			
			* Show the form for creating a new resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
		public function create()		
		{			
			$this->data['senddata'] = new User;
			$this->data['bank'] =  new BankDetail;	
			$this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('delivery.store');
            $this->data['cityvalue'] = City::allcities();
			$this->data['method'] = 'POST';
			return view('admin.delivery.addedit', $this->data); 		
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
            $insert_array_store = $request->storedetails;
			$user_details=User::where('user_status','1')->where('user_type','1')->where('deleted_at','=',null)->orderBy('id','desc')->first();
			$insert_array['user_type']=1;
			// $insert_array['user_status']=1;
			$insert_array['password_user']=$insert_array['password'];
			$insert_array['password']=bcrypt($insert_array['password']);
			$insert_array['created_by']=auth()->guard('admin')->user()->id;
			$insert_array['updated_by']=auth()->guard('admin')->user()->id;
			try{
				$create_array = new User;
				$create_array = $create_array->fill($insert_array);
				$create_array->alternative_number = $request->alternative_number;
				$create_array->aadhar = $request->aadhar;
				$create_array->driving_license_no = $request->driving_license_no;
				$create_array->driving_license_expiry = $request->driving_license_expiry;
				$create_array->save();
				$user_pref_id=Settings::where('s_id',3)->where('s_status',1)->first();
				
				if($user_details){
					$last_user_code=$user_details->user_id;
					$code=substr($last_user_code,-4);
					$code= $code + 1;
					$custid = ($code < 10 ? '0'.$code : $code);
					$custid = str_pad($custid, 4, '0', STR_PAD_LEFT);
					$userid = $user_pref_id->s_content.$custid;
	
				}else{
					$userid = $user_pref_id->s_content ."0001";
				}

				$bank = new BankDetail;
				$bank->user_id = $create_array->id;
				$bank->bank_name = $request->bank_name;
				$bank->acc_no = $request->acc_no;
				$bank->ifsc = $request->ifsc;
				$bank->pan = $request->pan;
				$bank->max_deposit = $request->max_deposit;
				$bank->save();

				$activity = new ActivityLog;
				$activity->user_id = Auth::guard('admin')->user()->id;
				$activity->user_type = 'Admin';
				$activity->module = 'Delivery Executive';
				$activity->activity = 'Delivery Executive Added';
				$activity->created_at = now();
	        	$activity->updated_at = now();
				$activity->save();

                User::find($create_array->id)->update(array('user_id'=>$userid));

				return redirect('admin/delivery')->with('success', 'Deliveryboy Added Successfully');
				
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
			$this->data['senddata'] =  User::with('city')->find($id);	
			$this->data['bank'] =  BankDetail::where('user_id',$id)->first();
			$this->data['message'] = 'Update Seller';        
            $this->data['method'] = 'PUT';	
            $this->data['cityvalue'] = City::allcities();
			$this->data['route'] = array('delivery.update',$id);
			$this->data['page_details'] = $this->page_details;
			return view('admin.delivery.addedit',$this->data);
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
				'first_name'=>'required',
                'mobile_number'=>'required|unique:users,mobile_number, '.$id.'|digits:10',
                'email'=>'required|email|unique:users,email, '.$id.'',
                'city_id'=>'required',
                'address'=>'required',

			);
			$messages = array(
				'first_name.required' => 'Enter First Name',
				'mobile_number.unique' => 'Mobile Number Already Exists',        
				'mobile_number.required' => 'Enter Mobile Number',    
				'email.unique' => 'EmailId Already Exists',        
                'email.required' => 'Enter EmailId',   
                'city_id.required' => 'Choose City',
                'address.required' => 'Enter Address',

			);

            $user_data = $request->except('_token','_method');
            $store_data = $request->storedetails;
			$password_data=$request->password;
			if($password_data!=null){
				$user_data['password_user']=$password_data;
				$user_data['password']=bcrypt($password_data);
			}
			else{
                unset($user_data['password']);
				
			}
			try{
				$_update_record = User::find($id);
				$_update_record->fill($user_data);
				$_update_record->alternative_number = $request->alternative_number;
				$_update_record->aadhar = $request->aadhar;
				$_update_record->driving_license_no = $request->driving_license_no;
				$_update_record->driving_license_expiry = $request->driving_license_expiry;
                $_update_record->save();

                $bank = BankDetail::where('user_id',$id)->first();
				$bank->user_id = $id;
				$bank->bank_name = $request->bank_name;
				$bank->acc_no = $request->acc_no;
				$bank->ifsc = $request->ifsc;
				$bank->pan = $request->pan;
				$bank->max_deposit = $request->max_deposit;
				$bank->save();

				$activity = new ActivityLog;
				$activity->user_id = Auth::guard('admin')->user()->id;
				$activity->user_type = 'Admin';
				$activity->module = 'Delivery Executive';
				$activity->activity = 'Delivery Executive Updated';
				$activity->created_at = now();
	        	$activity->updated_at = now();
				$activity->save();

                return redirect('admin/delivery')->with('success', 'Deliveryboy Updated Successfully');
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
		public function deleteDelivery(Request $request)		
		{			
			$user = User::where('id',$request->delete_id)->first();
			$user->delete();

			$activity = new ActivityLog;
			$activity->user_id = Auth::guard('admin')->user()->id;
			$activity->user_type = 'Admin';
			$activity->module = 'Delivery Executive';
			$activity->activity = 'Delivery Executive Deleted';
			$activity->created_at = now();
	        $activity->updated_at = now();
			$activity->save();

			return redirect()->back()->with('success','Delivery Boy Deleted Successfully');	
		}	
	}	
