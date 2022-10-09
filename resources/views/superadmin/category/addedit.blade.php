@extends('layouts.admin')
@section('title','CAtegory') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Category </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Category</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Category</h4>
               {!! Form::model($slider, ['method' => $method, 'route' => $route, 'enctype'=>'multipart/form-data']) !!}
                  <div class="form-group">
                     <label for="first_name">Category Name</label>
                     {{ Form::text('cat_name', old('cat_name'), ['class' => 'form-control', 'placeholder' => 'Category Name']) }}
                     @if($errors->has('cat_name'))
                     <div class="error_span help-text text-danger">{{ $errors->first('cat_name') }}</div>
                     @endif
                  </div>
                  <div class="form-group">
                    <label>Current Image</label>
                    @if($slider->SliderImage())
                    <img src="{{$slider->SliderImage()}}" alt="" class="img-thumbnail"/>
                     @endif  
                </div>
                  <div class="form-group">
                    <label for="first_name">Category Image</label>
                    <input type="file" name="cat_image" class="form-control" value="{{old('cat_image')}}" onchange="loadImage(this);">
                    <div style="margin-left:10px;"><br>
                        <img src="" id="img_preview">
                    </div>
                    @if($errors->has('cat_image'))
                    <div class="error_span help-text text-danger">{{ $errors->first('cat_image') }}</div>
                    @endif
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
                    <label for="first_name">Category Status</label>
                    <div class="radio-list">
                        <label>
                        {{ Form::radio('cat_status', 1) }} Active</label> <br/>
                        <label>
                        {{ Form::radio('cat_status', 0) }} In Active</label>
                     </div>
                 </div>




                  <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection