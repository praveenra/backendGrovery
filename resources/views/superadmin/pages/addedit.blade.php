@extends('layouts.admin')
@section('title','Pages') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Pages </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pages</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Pages</h4>
               {!! Form::model($senddata, ['method' => $method, 'route' => $route, 'enctype'=>'multipart/form-data']) !!}
                  <div class="form-group">
                     <label for="first_name">Page Type</label>
                     <select name="type" class="form-control">
                       <option value="">Select Page Type</option>
                       <option value="1" {{'1' == $senddata->page_type ? 'selected' : ''}}>About Us</option>
                       <option value="2" {{'2' == $senddata->page_type ? 'selected' : ''}}>Privacy Policy</option>
                       <option value="3" {{'3' == $senddata->page_type ? 'selected' : ''}}>Terms & Conditions</option>
                       <option value="4" {{'4' == $senddata->page_type ? 'selected' : ''}}>Return Policy</option>
                     </select>
                     @if($errors->has('page_name'))
                     <div class="error_span help-text text-danger">{{ $errors->first('page_name') }}</div>
                     @endif
                  </div>
                  <div class="form-group">
                     <label for="first_name">Page Name</label>
                     {{ Form::text('page_name', old('page_name'), ['class' => 'form-control', 'placeholder' => 'Page Name']) }}
                     @if($errors->has('page_name'))
                     <div class="error_span help-text text-danger">{{ $errors->first('page_name') }}</div>
                     @endif
                  </div>
				          <div class="form-group">
                     <label for="first_name">Description</label>
                     {{ Form::textarea('page_description', old('page_description'), ['class' => 'form-control description','id' => 'description', 'placeholder' => 'Description']) }}
                     
                  </div>
                  
                 <div class="form-group">
                    <label for="first_name">Page Status</label>
                    <div class="radio-list">
                        <label>
                        {{ Form::radio('page_status', 1) }} Active</label> <br/>
                        <label>
                        {{ Form::radio('page_status', 0) }} In Active</label>
                     </div>
                 </div>




                  <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

  <script>
    CKEDITOR.replace( 'description' );
  </script>

@endsection