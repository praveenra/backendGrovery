<?php	
		
	namespace App\Http\Controllers\Superadmin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\DeliverySetting;
	use App\Models\Settings;
	use App\Exports\LogExport;
	use DB;
	use Maatwebsite\Excel\Facades\Excel;

	class SuperadminDeliverySetting extends Controller	
	{		
        
		public function list(Request $request){			

			$this->data['count'] = DeliverySetting::count();
			
			$this->data['settings'] = DeliverySetting::get();

			$this->data['message'] = "Delivery Settings not Found";

            return view('superadmin.deliverySettings.list', $this->data);  
		}

		public function form($id = NULL){

			if($id){
				$this->data['setting'] = DeliverySetting::get();
				$this->data['action'] = 'Edit';
			}else{
				$this->data['setting'] = new DeliverySetting;
				$this->data['action'] = 'Add';
			}

            return view('superadmin.deliverySettings.form', $this->data);  
		}

		public function save(Request $request){

			if($request->action == 'Edit'){
				$setting = DeliverySetting::select('*')->delete();
			}else{
				$setting = new DeliverySetting;
			}
			$data = $request->form_data;

			foreach ($data as $value) {
				if(array_key_exists('on_off',$value)){ $value['on_off'] = 1; }else{ $value['on_off'] = 0; }
                
                $setting = DeliverySetting::insert($value);
            }
			return redirect('superadmin/delivery_settings_list');
		}

		public function delete(Request $request){

			$setting = DeliverySetting::where('id',$request->id)->delete();

			return redirect('superadmin/delivery_settings_list');

		}
				public function dboycashinhandview(Request $request){
			$this->data['setting'] = Settings::where('s_id',4)->first();
			return view('superadmin.deliverySettings.dboycashinhand', $this->data); 

		}

		public function savedboycashinhandview(Request $request){
			$deliveryboy_details=Settings::where('s_id',$request->id)->first();
			$deliveryboy_details->update(['s_content'=>$request->cash_in_hand]);
			$this->data['setting'] = Settings::where('s_id',$request->id)->first();
			return redirect()->back()->with('success','saved successfully',$this->data);

		}

	}	
