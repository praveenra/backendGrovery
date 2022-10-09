<?php	
		
	namespace App\Http\Controllers\Seller;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\Tag;
	use App\Models\ActivityLog;
	use Auth;
		
	class SellerTags extends Controller	
	{		
        protected $data = array();
         	
		public function __construct(){			
			$this->middleware('seller');			
		}		
				
		/**			
			* Display a listing of the resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
				
		public function list(){			

			$this->data['tags'] = Tag::select('seller_details.sd_sname','tags.*')->leftjoin('seller_details','seller_details.sd_usid','tags.seller_id')->get();

			$this->data['message'] = 'No Tags Added';

            return view('seller.tags.list', $this->data);
		}

		public function form($id = NULL){

			if($id){
				$this->data['tag'] = Tag::where('id',$id)->first();
				$this->data['action'] = 'Edit';
			}else{
				$this->data['tag'] = new Tag;
				$this->data['action'] = 'Add';
			}
            return view('seller.tags.form', $this->data);
		}

		public function save(Request $request){

			if($request->id){
				$tag = Tag::where('id',$request->id)->first();
				$tag->updated_at = now();
			}else{
				$tag = new Tag;
				$tag->created_at = now();
				$tag->updated_at = NULL;
			}

			$tag->seller_id = Auth::guard('seller')->user()->id;
			$tag->tag = $request->tag;
			$tag->status = $request->status;
			$tag->save();
			
            return redirect('seller/tags/list');
		}

		public function delete(Request $request){

			$delete_tag = Tag::where('id',$request->id)->delete();

			return redirect('seller/tags/list');

		}

	}	
