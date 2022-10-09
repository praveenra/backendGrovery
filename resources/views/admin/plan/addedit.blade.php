@extends('layouts.admin2')
@section('title','Plan') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> create Membership Plan </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">create Membership Plan</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Membership Plan</h4>
               {!! Form::model($senddata, ['method' => $method, 'route' => $route, 'enctype'=>'multipart/form-data']) !!}
                  <div class="form-group">
                     <label for="first_name">Plan Name</label>
                     {{ Form::text('plan_name', old('plan_name'), ['class' => 'form-control', 'placeholder' => 'Plan Name']) }}
                     @if($errors->has('plan_name'))
                     <div class="error_span help-text text-danger">{{ $errors->first('plan_name') }}</div>
                     @endif
                  </div>
				  <div class="form-group">
                     <label for="first_name">Plan Duration</label>
                     {{ Form::text('plan_duration', old('plan_duration'), ['class' => 'form-control', 'placeholder' => 'Plan Duration']) }}
                     @if($errors->has('plan_duration'))
                     <div class="error_span help-text text-danger">{{ $errors->first('plan_duration') }}</div>
                     @endif
                  </div>
				  
				  <div class="form-group">
				<label for="first_name">Plan Offer</label>
				{!! Form::select('plan_offer', (['' => '--Select a Plan Offer--','Free Delivery' => 'Free Delivery','Free Carrybag' => 'Free Carrybag']), ($senddata->plan_offer) ? $senddata->plan_offer : null ,['multiple'=>'multiple','name'=>'plan_offer[]','id'=>'plan_offer','class' => 'form-control','data-error' => 'Choose Plan Offer']) !!}                    
                  <div class="help-block form-text with-errors form-control-feedback"></div>
                  @if( $errors->has('storedetails.plan_offer') )
                  <div class="error_span help-text text-danger"> {{ $errors->first('storedetails.plan_offer') }}</div>
                  @endif
                  
               </div>
				  
				  <div class="form-group">
                     <label for="first_name">Plan Amount</label>
                     {{ Form::text('plan_amount', old('plan_amount'), ['class' => 'form-control', 'placeholder' => 'Plan Amount']) }}
                     @if($errors->has('plan_amount'))
                     <div class="error_span help-text text-danger">{{ $errors->first('plan_amount') }}</div>
                     @endif
                  </div>
                  
				  <div class="form-group">
                     <label for="first_name">Description</label>
                     {{ Form::textarea('description', old('description'), ['class' => 'form-control', 'placeholder' => 'Description']) }}
                     
                  </div>
                  
                 <div class="form-group">
                    <label for="first_name">Plan Status</label>
                    <div class="radio-list">
                        <label>
                        {{ Form::radio('plan_status', 1) }} Active</label> <br/>
                        <label>
                        {{ Form::radio('plan_status', 0) }} In Active</label>
                     </div>
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
	var values="{{$senddata['plan_offer']}}";
	$.each(values.split(","), function(i,e){
    $("#plan_offer option[value='" + e + "']").prop("selected", true);
});

});
</script>
@endsection