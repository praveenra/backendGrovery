<?php	
		
	namespace App\Http\Controllers\Superadmin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\Tag;
	use DB;

	class SuperadminSellerTags extends Controller	
	{		
        
		
				
		public function list(Request $request){			

            $this->data['tags'] = Tag::select('seller_details.*','tags.*')->leftjoin('seller_details','seller_details.sd_usid','tags.seller_id')->get();

            $this->data['message'] = 'No Tags Found';

            return view('superadmin.seller_tags.list', $this->data);
		}	

		public function filter(Request $request){

			if($request->status != ''){
				$this->data['tags'] = Tag::select('seller_details.*','tags.*')->leftjoin('seller_details','seller_details.sd_usid','tags.seller_id')->where('status',$request->status)->get();
			}else{
				$this->data['tags'] = Tag::select('seller_details.*','tags.*')->leftjoin('seller_details','seller_details.sd_usid','tags.seller_id')->get();
			}

            $this->data['message'] = 'No Tags Found';

            return view('superadmin.seller_tags.list_ajax', $this->data);
		}
				
	}	
