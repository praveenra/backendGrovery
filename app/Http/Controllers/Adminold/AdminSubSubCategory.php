<?php	
		
	namespace App\Http\Controllers\Admin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\SubSubCategory;
    use App\Models\Category;
	
		
	class AdminSubSubCategory extends Controller	
	{
				
		public function list(Request $request){			

            $this->data['subsubcategories'] = SubSubCategory::select('sub_sub_categories.*','category.*')->leftjoin('category','category.cat_id','sub_sub_categories.category_id')->get();
            $this->data['message'] = 'No Sub Sub Category Added';

            return view('admin.subsubcategory.manage', $this->data); 

		}	

		public function form($id = NULL){

			if($id){

				$this->data['data'] = SubSubCategory::where('id',$id)->first();
				$this->data['action'] = 'Edit';

			}else{

				$this->data['data'] = new SubSubCategory;
				$this->data['action'] = 'Add';

			}	

            $this->data['categories'] = Category::where('cat_is_parent_id',null)->get();
            $this->data['subcategories'] = Category::where('cat_is_parent_id','!=',null)->get();

            return view('admin.subsubcategory.addedit', $this->data); 

		}

		public function save(Request $request){

			if($request->id){
				$subsubcategory = SubSubCategory::where('id',$request->id)->first();
				$subsubcategory->updated_at = now();

				$activity = new ActivityLog;
				$activity->user_id = Auth::guard('admin')->user()->id;
				$activity->user_type = 'Admin';
				$activity->module = 'Sub Sub Category';
				$activity->activity = 'Sub Sub Category Updated';
				$activity->created_at = now();
		        $activity->updated_at = now();
				$activity->save();

			}else{
				$subsubcategory = new SubSubCategory;
				$subsubcategory->created_at = now();
				$subsubcategory->updated_at = Null;

				$activity = new ActivityLog;
				$activity->user_id = Auth::guard('admin')->user()->id;
				$activity->user_type = 'Admin';
				$activity->module = 'Sub Sub Category';
				$activity->activity = 'Sub Sub Category Added';
				$activity->created_at = now();
		        $activity->updated_at = now();
				$activity->save();

			}	

			$subsubcategory->name = $request->name;
			$subsubcategory->category_id = $request->category_id;
			$subsubcategory->sub_category_id = $request->sub_category_id;

			// if($request->image){
			// 	$image = time().$request->image->getCLientOriginalExtension();
			// 	$request->image->move('admin/images/subsubcategory',$image);
			// 	$subsubcategory->image = $image;
			// }

			$subsubcategory->status = $request->status;
			$subsubcategory->save();

			

            return redirect('admin/subsubcategory');

		}

		public function delete(Request $request){

			$delete = SubSubCategory::where('id',$request->delete_id)->delete();

			$activity = new ActivityLog;
			$activity->user_id = Auth::guard('admin')->user()->id;
			$activity->user_type = 'Admin';
			$activity->module = 'Sub Sub Category';
			$activity->activity = 'Sub Sub Category Deleted';
			$activity->created_at = now();
		    $activity->updated_at = now();
			$activity->save();

			return redirect('admin/subsubcategory');

		}

	}	
