@extends('layouts.admin')
@section('title','Area') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Area </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Area</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Area</h4>
               {!! Form::model($senddata, ['method' => $method, 'route' => $route, 'enctype'=>'multipart/form-data']) !!}
                  <div class="form-group">
                     <label for="first_name">Area Name</label>
                     {{ Form::text('area_name', old('area_name'), ['class' => 'form-control', 'placeholder' => 'Title']) }}
                     @if($errors->has('area_name'))
                     <div class="error_span help-text text-danger">{{ $errors->first('area_name') }}</div>
                     @endif
                  </div>
                  <div class="form-group">
                     <label for="">City</label>
                     {!! Form::select('area_cityid', (['' => '--Select a City--'] + $cityvalue), ($senddata->area_cityid) ? $senddata->area_cityid : null ,['class' => 'form-control','data-error' => 'Choose City']) !!}                    
                     <div class="help-block form-text with-errors form-control-feedback"></div>
                     @if( $errors->has('area_cityid') )
                     <div class="error_span help-text text-danger"> {{ $errors->first('area_cityid') }}</div>
                     @endif
                  </div>
                  <div class="form-group">
                     <label for="">Zone</label>
                     {!! Form::select('Zone_id', (['' => '--Select a Zone--'] + $zonevalue), ($senddata->Zone_id) ? $senddata->Zone_id : null ,['class' => 'form-control','data-error' => 'Choose Zone']) !!}                    
                     <div class="help-block form-text with-errors form-control-feedback"></div>
                     @if( $errors->has('Zone_id') )
                     <div class="error_span help-text text-danger"> {{ $errors->first('Zone_id') }}</div>
                     @endif
                  </div>
                 <div class="form-group">
                    <label for="first_name">Area Status</label>
                    <div class="radio-list">
                        <label>
                        {{ Form::radio('area_status', 1) }} Active</label> <br/>
                        <label>
                        {{ Form::radio('area_status', 0) }} In Active</label>
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