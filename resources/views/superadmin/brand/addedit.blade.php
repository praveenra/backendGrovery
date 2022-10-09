@extends('layouts.admin')
@section('title','Brand') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Brand </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Brand</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Brand</h4>
               {!! Form::model($slider, ['method' => $method, 'route' => $route, 'enctype'=>'multipart/form-data']) !!}
               <div class="form-group">
                     <label for="">Category</label>
                     {!! Form::select('cat_is_parent_id', (['' => '--Select a Category--'] + $category), ($slider->cat_is_parent_id) ? $slider->cat_is_parent_id : null ,['class' => 'form-control','data-error' => 'Choose category']) !!}                    
                     <div class="help-block form-text with-errors form-control-feedback"></div>
                     @if( $errors->has('cat_is_parent_id') )
                     <div class="error_span help-text text-danger"> {{ $errors->first('cat_is_parent_id') }}</div>
                     @endif
                  </div>
                  
                  <div class="form-group">
                     <label for="first_name">Brand Name</label>
                     {{ Form::text('brand_name', old('cat_name'), ['class' => 'form-control', 'placeholder' => 'Brand Name']) }}
                     @if($errors->has('brand_name'))
                     <div class="error_span help-text text-danger">{{ $errors->first('brand_name') }}</div>
                     @endif
                  </div>
                 <div class="form-group">
                    <label for="first_name">Brand Status</label>
                    <div class="radio-list">
                        <label>
                        {{ Form::radio('brand_status', 1) }} Active</label> <br/>
                        <label>
                        {{ Form::radio('brand_status', 0) }} In Active</label>
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