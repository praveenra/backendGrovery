<?php	
		
	namespace App\Http\Controllers\Admin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\Notification;
	use App\Models\Customer;
	use App\Models\ActivityLog;
	use Auth;
		
	class AdminNotification extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Notifications',
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
				
		public function list(Request $request){			

            $this->data['notifications'] = Notification::select('notifications.*','customer.name as customer')->leftjoin('customer','customer.id','notifications.customer_id')->orderBy('notifications.id','asc')->get();

			return view('admin/notification/manage',$this->data);

		}

		public function send(Request $request)
		{
			$title = $request->title;
			$message = $request->message;
			$file = $request->file('image');
			if(!empty($file)){
				$name = $file->getClientOriginalName();
				$file->move('admin/images/notification',$name);
				$file_name = $name;
				$image_path = 'https://ibotix.tech/Grovery/admin/images/notification/'.$name;
			}else{
				$file_name = NULL;
			}
			$url = "https://fcm.googleapis.com/fcm/send";
			
			$serverKey = 'AAAAqlfNKJ4:APA91bE4JGAFBfQT0y8CbHE6A3VRJI8Sfy1-JQSeJU9tzauMbYDOygj1JKDioX90balbVSGuhyOZfZTp_4wMGja2qqcv5fwWP1WGr07WnEmBrH9U2yvhfMKeaoNw-9EpPMQMVLaz0DWU';
			
			$notification = array('title' =>$title , 'body' => $message, 'image' => $image_path, 'sound' => 'default', 'badge' => '1');
			
			$customers = Customer::where('fcm_id','!=', NULL)->where('status',1)->get();

			foreach ($customers as $key => $value) {

				$token = $value->fcm_id;

				$arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
				$json = json_encode($arrayToSend);
				$headers = array();
				$headers[] = 'Content-Type: application/json';
				$headers[] = 'Authorization: key='. $serverKey;
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
				curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
				curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
				//Send the request
				$response = curl_exec($ch);
				//Close request
				if ($response === FALSE) {
				//die('FCM Send Error: ' . curl_error($ch));
				}
				curl_close($ch);
				
				$notification = new Notification;
				$notification->title = $title;
				$notification->message = $message;
				$notification->customer_id = $value->id;
				$notification->image = $file_name;
				$notification->save();

				$activity = new ActivityLog;
				$activity->user_id = Auth::guard('admin')->user()->id;
				$activity->user_type = 'Admin';
				$activity->module = 'Notification';
				$activity->activity = 'Notification Sent';
				$activity->created_at = now();
		        $activity->updated_at = now();
				$activity->save();

			}
			
			return redirect('admin/notification')->with(['success' => 'Notification sent successfully']);

		}	
	}	
