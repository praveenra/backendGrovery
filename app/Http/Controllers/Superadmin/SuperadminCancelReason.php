<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;	

use App\Models\CancelReason;	
use App\Http\Requests\Brand\Addform;

class SuperadminCancelReason extends Controller
{
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'CancelReason',
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
				
		public function list(Request $request){			

            $this->data['cancelreasons'] = CancelReason::get();
            $this->data['message'] = 'No CancelReason Added';
           
            return view('superadmin.cancel_reason.manage', $this->data);  
		}		


				
		public function form($id = NULL)		
		{			
			if($id){
				$this->data['cancel_reason'] = CancelReason::where('id',$id)->first();
				$this->data['action'] = "Edit";
			}else{
				$this->data['cancel_reason'] = new CancelReason;
				$this->data['action'] = "Add";
			}
			
			
			return view('superadmin.cancel_reason.addedit', $this->data); 		
		}		
				
		public function save(Request $request)		
		{			
			// dd($request->all());
			
			if($request->id){
				$cancel_reason = CancelReason::where('id',$request->id)->first();
			}else{
				$cancel_reason = new CancelReason;
			}

			$cancel_reason->reason  = $request->cancel_reason;
			$cancel_reason->type         = $request->type;	
			$cancel_reason->status         = $request->status;	

			$cancel_reason->save();

			return redirect('superadmin/cancel_reason');
			
		}	

		public function filter(Request $request){

			if($request->status == "All"){
            	$this->data['cancelreasons'] = CancelReason::get();
			}else{
				$this->data['cancelreasons'] = CancelReason::where('status',$request->status)->get();
			}
            $this->data['message'] = 'No CancelReason Added';

            return view('superadmin/cancel_reason/manage_ajax', $this->data);  
			
		}			
				
			
			public function deleteCancelReason(Request $request)		
		{	
			$user = CancelReason::find($request->delete_id);
			$user->delete();
			return redirect()->back()->with('success','Cancel Reason Deleted Successfully');	
		}	


		public function inactiveData(Request $request){

			$change_status = CancelReason::where('id',$request->id)->first();
			$change_status->status = "0";
			$change_status->save();
		}

		public function activeData(Request $request){
			
			$change_status = CancelReason::where('id',$request->id)->first();
			$change_status->status = "1";
			$change_status->save();
		}
}