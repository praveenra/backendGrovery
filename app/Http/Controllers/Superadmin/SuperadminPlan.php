<?php	
		
	namespace App\Http\Controllers\Superadmin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\User;
    use App\Models\Settings;
    use App\Models\Seller;	
	use App\Models\City;
	use App\Models\Plan;
	use App\Models\MembershipUser;
	use App\Http\Requests\Plan\Addform;
		
	class SuperadminPlan extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Plan',
            'page_auth'=> 'superadmin',
        );		
		
		public function list(Request $request){			

            $this->data['plans'] = Plan::get();
            $this->data['message'] = 'No Plan Added';

            return view('superadmin.plan.manage', $this->data);

		}		


		public function filter(Request $request){

            $this->data['senddata'] = Plan::where('plan_status',$request->status)->get();
            $this->data['message'] = 'No Plan Added';
            $this->data['add'] = 'plan.create';
			$this->data['edit'] = url('superadmin/plan'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('superadmin.plan.manage_ajax', $this->data); 
		}	
				
		public function form($id = NULL)		
		{
			if($id){
				$this->data['plan'] = Plan::where('id',$id)->first();
			}else{
				$this->data['plan'] = new Plan;
			}

			return view('superadmin.plan.addedit', $this->data); 		
		}		
				
		public function save(Request $request)		
		{			
            if($request->id){
            	$plan = Plan::where('id',$request->id)->first();
            }else{
            	$plan = new Plan;
            }

            $plan->plan_name = $request->plan_name;
            $plan->plan_duration = $request->plan_duration;
            $plan->plan_limit = $request->plan_limit;
            $plan->original_plan_amount = $request->original_plan_amount;
            $plan->plan_amount = $request->plan_amount;
            $plan->description = $request->description;
            $plan->plan_status = $request->plan_status;
            $plan->free_delivery = $request->free_delivery;
            $plan->carry_bag = $request->carry_bag;
            $plan->save();

            return redirect('superadmin/plan_list');
		}		
		
		public function deletePlan(Request $request){
			$plan = Plan::find($request->delete_id);
			$plan->delete();
			return redirect()->back()->with('success','Plan Deleted Successfully');	
		}

		public function inactiveData(Request $request){

			$change_status = Plan::where('id',$request->id)->first();
			$change_status->plan_status = 0;
			$change_status->save();
		}

		public function activeData(Request $request){
			
			$change_status = Plan::where('id',$request->id)->first();
			$change_status->plan_status = 1;
			$change_status->save();
		}
		
		public function membership_user_list(Request $request){			

			$this->data['mebership_user_list']  = MembershipUser::select('membership_users.*','membership_plan.*','customer.*')
                        ->leftjoin('membership_plan','membership_plan.id','membership_users.membership_plan_id')
                        ->leftjoin('customer','customer.id','membership_users.id')
                        ->get();

            $this->data['message'] = 'No Plan Added';

            return view('superadmin/plan/membership_user_list', $this->data);
		}	

	}	
