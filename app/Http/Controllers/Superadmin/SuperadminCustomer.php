<?php	
		
	namespace App\Http\Controllers\Superadmin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\Customer;
	use App\Exports\CustomersExport;
	use Maatwebsite\Excel\Facades\Excel;
	class SuperadminCustomer extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Customer',
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

            $this->data['customers'] = Customer::paginate();
            $this->data['message'] = 'No Customer Added';
            $this->data['page_details'] = $this->page_details;

            return view('superadmin.customers.manage', $this->data);  
		}

		public function export(Request $request){

			return Excel::download(new CustomersExport(), 'customers.csv');

		}

		public function filter(Request $request){

			if($request->status == ""){
            	$this->data['customers'] = Customer::get();
			}else{
				$this->data['customers'] = Customer::where('status',$request->status)->get();
			}
            $this->data['message'] = 'No Customer Added';

            return view('superadmin/customers/manage_ajax', $this->data);  
			
		}


		public function inactiveData(Request $request){

			$change_status = Customer::where('id',$request->id)->first();
			$change_status->status = 0;
			$change_status->save();
		}

		public function activeData(Request $request){
			
			$change_status = Customer::where('id',$request->id)->first();
			$change_status->status = 1;
			$change_status->save();
		}


	}	
