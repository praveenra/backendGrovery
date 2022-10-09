<?php	
		
	namespace App\Http\Controllers\Superadmin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\User;
    use App\Models\Settings;
    use App\Models\Area;	
    use App\Models\City;
    use App\Models\BankDetail;
    use App\Models\ShiftDetail;
	use App\Models\Order;
	use App\Http\Requests\Deliveryboy\Addform;
		
	class SuperadminDelivery extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Care Givers',
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

            $this->data['senddata'] = User::where('user_type',1)->with('city')->paginate(200);
            $this->data['message'] = 'No Deliveryboy Added';
            $this->data['add'] = 'delivery.create';
			$this->data['edit'] = url('superadmin/delivery'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('superadmin.delivery.manage', $this->data);  
		}	

		public function filter(Request $request){

            $this->data['senddata'] = User::where('user_type',1)->where('user_status',$request->status)->with('city')->paginate();
            $this->data['message'] = 'No Deliveryboy Added';
            $this->data['add'] = 'delivery.create';
			$this->data['edit'] = url('superadmin/delivery'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');

            return view('superadmin.delivery.manage_ajax', $this->data);  
			
		}			
				
		/**			
			* Show the form for creating a new resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
		public function create()		
		{			
			$this->data['senddata'] = new User;
			$this->data['area1'] = Area::where('area_status',1)->get();
			$this->data['area2'] = Area::where('area_status',1)->get();
			$this->data['area3'] = Area::where('area_status',1)->get();
			$this->data['area4'] = Area::where('area_status',1)->get();
			$this->data['area5'] = Area::where('area_status',1)->get();
			$this->data['area6'] = Area::where('area_status',1)->get();
			$this->data['area7'] = Area::where('area_status',1)->get();
			$this->data['bank'] =  new BankDetail;	
			$this->data['shift'] = new ShiftDetail;	
			$this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('delivery.store');
            $this->data['cityvalue'] = City::allcities();
			$this->data['cities'] = City::where('city_status',1)->get();
			$this->data['areas'] = City::where('area','!=',NULL)->get();
			$this->data['method'] = 'POST';
			return view('superadmin.delivery.addedit', $this->data); 		
		}	

		public function city_dropdown(request $request)
	    {
	    
	             // dd($request->all());

	        $detail = City::where('city_id',$request->id)->first();

	        return response()->json($detail);
	    }	

		public function area_dropdown(request $request)
	    {
	    
	             // dd($request->all());

	        $detail = Area::where('area_cityid',$request->id)->get();

	        return response()->json($detail);
	    }

		public function assigncaregiver(request $request)
	    {
	    
	             // dd($request->all());
		    $order = Order::where('order_id',$request->order_id)->first();
			$order->delivery_man=$request->id;
			$order->save();
	        return response()->json(1);
	    }
				
		/**			
			* Store a newly created resource in storage.			
			*			
			* @param  \Illuminate\Http\Request  $request			
			* @return \Illuminate\Http\Response			
		*/		
		public function store(Addform $request)		
		{	
		//	echo "<pre>";
		//	print_r($request->all());
          //  exit;
            $insert_array = $request->except(['_token']);
            $insert_array_store = $request->storedetails;
			$user_details=User::where('user_status','1')->where('user_type','1')->where('deleted_at','=',null)->orderBy('id','desc')->first();
			$insert_array['user_type']=1;
			// $insert_array['user_status']=1;
			$insert_array['password_user']=$insert_array['password'];
			$insert_array['password']=bcrypt($insert_array['password']);
			$insert_array['created_by']=auth()->guard('superadmin')->user()->id;
			$insert_array['updated_by']=auth()->guard('superadmin')->user()->id;
			$zoneid=Area::where('area_name', 'like', '%' . $request->area . '%')->first();
			$insert_array['zone_id']=$zoneid->Zone_id;
			try{
				$create_array = new User;
				$create_array = $create_array->fill($insert_array);
				$create_array->alternative_number = $request->alternative_number;
				$create_array->aadhar = $request->aadhar;
				$create_array->driving_license_no = $request->driving_license_no;
				$create_array->driving_license_expiry = $request->driving_license_expiry;

				if($request->hasFile('profile_image')){
		            $profile_image = $request->file('profile_image');

		            $filename = time() . '.' . $profile_image->getClientOriginalExtension();
		            $profile_image->move('public/admin/images/caregiver',$filename);  
		        }

				$create_array->profile_image = $filename;

				$create_array->save();
				$user_pref_id=Settings::where('s_id',3)->where('s_status',1)->first();
				
				if($user_details){
					$last_user_code=$user_details->user_id;
					$code   =substr($last_user_code,-4);
					$code   = $code + 1;
					$custid = ($code < 10 ? '0'.$code : $code);
					$custid = str_pad($custid, 4, '0', STR_PAD_LEFT);
					$userid = $user_pref_id->s_content.$custid;
	
				}else{
					$userid = $user_pref_id->s_content ."0001";
				}

				$bank = new BankDetail;
				$bank->user_id     = $create_array->id;
				$bank->bank_name   = $request->bank_name;
				$bank->acc_no      = $request->acc_no;
				$bank->ifsc        = $request->ifsc;
				$bank->pan         = $request->pan;
				$bank->max_deposit = $request->max_deposit;
				$bank->save();

				$shift = new ShiftDetail;
				$shift->user_id             = $create_array->id;
				$shift->shift_type          = $request->shift_type;
				$shift->sunday_shift        = $request->sunday_shift;
				$shift->sunday_zone         = $request->sunday_zone;
				$shift->sunday_start_time   = $request->sunday_start_time;
				$shift->sunday_end_time     = $request->sunday_end_time;
				$shift->monday_shift        = $request->monday_shift;
				$shift->monday_zone         = $request->monday_zone;
				$shift->monday_start_time   = $request->monday_start_time;
				$shift->monday_end_time     = $request->monday_end_time;
				$shift->tuesday_shift       = $request->tuesday_shift;
				$shift->tuesday_zone        = $request->tuesday_zone;
				$shift->tuesday_start_time  = $request->tuesday_start_time;
				$shift->tuesday_end_time    = $request->tuesday_end_time;
				$shift->wednesday_shift     = $request->wednesday_shift;
				$shift->wednesday_zone      = $request->wednesday_zone;
				$shift->wednesday_start_time= $request->wednesday_start_time;
				$shift->wednesday_end_time  = $request->wednesday_end_time;
				$shift->thursday_shift      = $request->thursday_shift;
				$shift->thursday_zone       = $request->thursday_zone;
				$shift->thursday_start_time = $request->thursday_start_time;
				$shift->thursday_end_time   = $request->thursday_end_time;
				$shift->friday_shift        = $request->friday_shift;
				$shift->friday_zone         = $request->friday_zone;
				$shift->friday_start_time   = $request->friday_start_time;
				$shift->friday_end_time     = $request->friday_end_time;
				$shift->saturday_shift      = $request->saturday_shift;
				$shift->saturday_zone       = $request->saturday_zone;
				$shift->saturday_start_time = $request->saturday_start_time;
				$shift->saturday_end_time   = $request->saturday_end_time;
				$shift->save();

                User::find($create_array->id)->update(array('user_id'=>$userid));

				return redirect('superadmin/delivery')->with('success', 'Deliveryboy Added Successfully');
				
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
			$this->data['area1'] = Area::where('area_status',1)->get();
			$this->data['area2'] = Area::where('area_status',1)->get();
			$this->data['area3'] = Area::where('area_status',1)->get();
			$this->data['area4'] = Area::where('area_status',1)->get();
			$this->data['area5'] = Area::where('area_status',1)->get();
			$this->data['area6'] = Area::where('area_status',1)->get();
			$this->data['area7'] = Area::where('area_status',1)->get();
			$this->data['bank']  = BankDetail::where('user_id',$id)->first();
			$this->data['shift'] = ShiftDetail::where('user_id',$id)->first();
			$this->data['message'] = 'Update Seller';        
            $this->data['method'] = 'PUT';	
            $this->data['cityvalue'] = City::allcities();
            $this->data['cities'] = City::where('city_status',1)->get();
			$this->data['areas'] = City::where('area','!=',NULL)->get();
			$this->data['route'] = array('delivery.update',$id);
			$this->data['page_details'] = $this->page_details;
			return view('superadmin.delivery.addedit',$this->data);
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
				$zoneid=Area::where('area_name', 'like', '%' . $request->area . '%')->first();
				$_update_record->zone_id=$zoneid->Zone_id;
				if($request->hasFile('profile_image')){
		            $profile_image = $request->file('profile_image');

		            $filename = time() . '.' . $profile_image->getClientOriginalExtension();
		            $profile_image->move('public/admin/images/caregiver',$filename);  
					$_update_record->profile_image = $filename;
					
		        }

				$_update_record->save();

                $bank = BankDetail::where('user_id',$id)->first();
				if($bank){
					$bank->user_id     = $id;
					$bank->bank_name   = $request->bank_name;
					$bank->acc_no      = $request->acc_no;
					$bank->ifsc        = $request->ifsc;
					$bank->pan         = $request->pan;
					$bank->max_deposit = $request->max_deposit;
					$bank->save();
				}
				$shift = ShiftDetail::where('user_id',$id)->first();
               if($shift){
				$shift->user_id             = $id;
				$shift->shift_type          = $request->shift_type;
				$shift->sunday_shift        = $request->sunday_shift;
				$shift->sunday_zone         = $request->sunday_zone;
				$shift->sunday_start_time   = $request->sunday_start_time;
				$shift->sunday_end_time     = $request->sunday_end_time;
				$shift->monday_shift        = $request->monday_shift;
				$shift->monday_zone         = $request->monday_zone;
				$shift->monday_start_time   = $request->monday_start_time;
				$shift->monday_end_time     = $request->monday_end_time;
				$shift->tuesday_shift       = $request->tuesday_shift;
				$shift->tuesday_zone        = $request->tuesday_zone;
				$shift->tuesday_start_time  = $request->tuesday_start_time;
				$shift->tuesday_end_time    = $request->tuesday_end_time;
				$shift->wednesday_shift     = $request->wednesday_shift;
				$shift->wednesday_zone      = $request->wednesday_zone;
				$shift->wednesday_start_time= $request->wednesday_start_time;
				$shift->wednesday_end_time  = $request->wednesday_end_time;
				$shift->thursday_shift      = $request->thursday_shift;
				$shift->thursday_zone       = $request->thursday_zone;
				$shift->thursday_start_time = $request->thursday_start_time;
				$shift->thursday_end_time   = $request->thursday_end_time;
				$shift->friday_shift        = $request->friday_shift;
				$shift->friday_zone         = $request->friday_zone;
				$shift->friday_start_time   = $request->friday_start_time;
				$shift->friday_end_time     = $request->friday_end_time;
				$shift->saturday_shift      = $request->saturday_shift;
				$shift->saturday_zone       = $request->saturday_zone;
				$shift->saturday_start_time = $request->saturday_start_time;
				$shift->saturday_end_time   = $request->saturday_end_time;
				$shift->save();
			   }
				


                return redirect('superadmin/delivery')->with('success', 'Deliveryboy Updated Successfully');
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
			return redirect()->back()->with('success','Delivery Boy Deleted Successfully');	
		}

		public function inactiveData(Request $request){

			$change_user_status = User::where('id',$request->id)->first();
			$change_user_status->user_status = 0;
			$change_user_status->save();
		}

		public function activeData(Request $request){
			
			$change_user_status = User::where('id',$request->id)->first();
			$change_user_status->user_status = 1;
			$change_user_status->save();
		}
	}	
