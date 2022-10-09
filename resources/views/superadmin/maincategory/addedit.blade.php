@extends('layouts.admin')
@section('title','Main Category') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Main Category </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Main Category</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Main Category</h4>
               {!! Form::model($senddata, ['method' => $method, 'route' => $route, 'enctype'=>'multipart/form-data']) !!}
                  <div class="form-group">
                     <label for="mc_name">Main Category Name</label>
                     {{ Form::text('mc_name', old('mc_name'), ['class' => 'form-control', 'placeholder' => 'Title']) }}
                     @if($errors->has('mc_name'))
                     <div class="error_span help-text text-danger">{{ $errors->first('mc_name') }}</div>
                     @endif
                  </div>
                  <!--<div class="form-group">
                    <label for="">Seller</label>
                    {!! Form::select('mc_seller_id', (['' => '--Select a Seller--'] + $Seller), ($senddata->mc_seller_id) ? $senddata->mc_seller_id : null ,['class' => 'form-control','data-error' => 'Choose City']) !!}                    
                    <div class="help-block form-text with-errors form-control-feedback"></div>
                    @if( $errors->has('mc_seller_id') )
                    <div class="error_span help-text text-danger"> {{ $errors->first('mc_seller_id') }}</div>
                    @endif
                 </div> -->
				
				 <div class="form-group">
                    <label for="mc_commision">Category Image</label>
                    <input type="file" name="image" class="form-control" value="{{old('image')}}" onchange="loadImage(this);">
                    <div style="margin-left:10px;"><br>
                        <img src="" id="img_preview">
                    </div>
                 </div>
                 <script type="text/javascript">
                   function loadImage(input, id) {
                      id = id || '#img_preview';
                      if (input.files && input.files[0]) {
                          var reader = new FileReader();

                          reader.onload = function (e) {
                          $(id)
                              .attr('src', e.target.result)
                              .width(100)
                              .height(100);
                          };
                          reader.readAsDataURL(input.files[0]);
                      }
                  }
                 </script>
				  <div class="form-group">
                   
                    @if($senddata->mc_id!="")
                    <img src="{{url('/admin/images/category/')}}/{{$senddata->image}}" alt="" class="img-thumbnail" height="100" width="100" id="preview"/>
				<a style="cursor:pointer" onclick="removeimg()" id="remove">Remove</a>
						<input type="hidden" name="findremove" id="findremove">
                     @endif  
                </div>
				 <div class="form-group">
                    <label for="mc_commision">Commission Percentage</label>
                    {{ Form::text('mc_commision', old('mc_commision'), ['class' => 'form-control', 'placeholder' => 'Title']) }}
                    @if($errors->has('mc_commision'))
                    <div class="error_span help-text text-danger">{{ $errors->first('mc_commision') }}</div>
                    @endif
                 </div>

                 <div class="form-group">
                    <label for="first_name">Main Category Status</label>
                    <div class="radio-list">
                        <label>
                        {{ Form::radio('mc_status', 1) }} Active</label> <br/>
                        <label>
                        {{ Form::radio('mc_status', 0) }} In Active</label>
                     </div>
                 </div>




                  <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
function removeimg()
{
	document.getElementById("preview").style.display="none";
	document.getElementById("remove").style.display="none";
	document.getElementById("findremove").value="1";
}
</script>
@endsection