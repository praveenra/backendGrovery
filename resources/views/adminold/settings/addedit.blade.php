@extends('layouts.admin')
@section('title','Settings') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> create Store Settings </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">create store settings</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Store Settings</h4>
               {!! Form::model($senddata, ['method' => $method, 'route' => $route, 'enctype'=>'multipart/form-data']) !!}
                  <div class="form-group">
                     <label for="first_name">Seller Name</label>
                     {!! Form::select('seller_id', (['' => '--Select a Seller Id--'] + $seller_id), ($senddata->seller_id) ? $senddata->seller_id : null ,['class' => 'form-control','data-error' => 'Choose seller id']) !!}                    
                     <div class="help-block form-text with-errors form-control-feedback"></div>
                     @if( $errors->has('seller_id') )
                     <div class="error_span help-text text-danger"> {{ $errors->first('seller_id') }}</div>
                     @endif
                  </div>
				  <div class="form-group">
                     <label for="first_name">Start Time</label>
                     {{ Form::time('opening_time', old('opening_time'), ['class' => 'form-control', 'placeholder' => 'opening_time']) }}
                     @if($errors->has('opening_time'))
                     <div class="error_span help-text text-danger">{{ $errors->first('opening_time') }}</div>
                     @endif
                  </div>
				  
				  <div class="form-group">
                     <label for="first_name">End Time</label>
                     {{ Form::time('closing_time', old('closing_time'), ['class' => 'form-control', 'placeholder' => 'Offer condition', 'id' => 'closing_time']) }}
                     @if($errors->has('closing_time'))
                     <div class="error_span help-text text-danger">{{ $errors->first('closing_time') }}</div>
                     @endif
                  </div>

				  <div class="form-group">
                     <label for="first_name">Opening Day</label>
					 <br>
                    {{ Form::checkbox('opening_day[]', 'Sunday', false,['id' => 'open_Sunday']) }} Sunday
                    {{ Form::checkbox('opening_day[]', 'Monday', false,['id' => 'open_Monday']) }} Monday
                    {{ Form::checkbox('opening_day[]', 'Tuesday', false,['id' => 'open_Tuesday']) }} Tuesday
                    {{ Form::checkbox('opening_day[]', 'Wednesday', false,['id' => 'open_Wednesday']) }} Wednesday
                    {{ Form::checkbox('opening_day[]', 'Thurday', false,['id' => 'open_Thursday']) }} Thurday
                    {{ Form::checkbox('opening_day[]', 'Friday', false,['id' => 'open_Friday']) }} Friday
                    {{ Form::checkbox('opening_day[]', 'Saturday', false,['id' => 'open_Saturday']) }} Saturday

                  </div>
				  	 
                  <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script>

$(document).ready(function(){
	
	var facility_id="{{$senddata->opening_day}}";
	
	var result=facility_id.split(',');
	  
	for(var i=0;i<=result.length;i++)
	{
		$("#open_"+result[i]).prop( "checked", true );
	}
	
	
	if({{$code}}=="1")
	{
     var uniquecode="{{uniqid()}}";
	 document.getElementById("code").value=uniquecode;
	}
});
</script>
@endsection