@extends('layouts.admin2')
@section('title','Offer') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> create Offer </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">create Offer</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Offer</h4>
               {!! Form::model($senddata, ['method' => $method, 'route' => $route, 'enctype'=>'multipart/form-data']) !!}
                  <div class="form-group">
                     <label for="first_name">Offer Name</label>
                     {{ Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Name']) }}
                     @if($errors->has('name'))
                     <div class="error_span help-text text-danger">{{ $errors->first('name') }}</div>
                     @endif
                  </div>
				  <div class="form-group">
                     <label for="first_name">Offer Amount</label>
                     {{ Form::text('amount', old('amount'), ['class' => 'form-control', 'placeholder' => 'Amount']) }}
                     @if($errors->has('amount'))
                     <div class="error_span help-text text-danger">{{ $errors->first('amount') }}</div>
                     @endif
                  </div>
				  
				  <div class="form-group">
                     <label for="first_name">Offer Condition</label>
                     {{ Form::text('offer_condition', old('offer_condition'), ['class' => 'form-control', 'placeholder' => 'Offer condition', 'id' => 'offer_condition']) }}
                     @if($errors->has('offer_condition'))
                     <div class="error_span help-text text-danger">{{ $errors->first('offer_condition') }}</div>
                     @endif
                  </div>

				  <div class="form-group">
                     <label for="first_name">Offer Code</label>
                     {{ Form::text('code', old('code'), ['class' => 'form-control', 'placeholder' => 'code', 'id' => 'code']) }}
                     @if($errors->has('code'))
                     <div class="error_span help-text text-danger">{{ $errors->first('code') }}</div>
                     @endif
                  </div>

                  <div class="form-group">
                     <label for="first_name">Offer Amount Limit</label>
                     {{ Form::text('amount_limit', old('amount_limit'), ['class' => 'form-control', 'placeholder' => 'Offer Amount Limit', 'id' => 'amount_limit']) }}
                     @if($errors->has('amount_limit'))
                     <div class="error_span help-text text-danger">{{ $errors->first('amount_limit') }}</div>
                     @endif
                  </div>

                  <div class="form-group">
                     <label for="first_name">Main Category</label>
                     <select class="form-control" name="main_category" required>
                        <option value="">Select Main Category</option>
                        @foreach($main_categories as $data)
                           <option value="{{$data->mc_id}}" {{$data->mc_id == $senddata->main_category ? 'selected' : ''}}>{{$data->mc_name}}</option>
                        @endforeach
                     </select>
                  </div>

				  	  <div class="form-group">
                     <label for="first_name">Description</label>
                     {{ Form::textarea('description', old('description'), ['class' => 'form-control', 'placeholder' => 'Description']) }}
                     
                  </div>
                  
                 <div class="form-group">
                    <label for="first_name">Offer Status</label>
                    <div class="radio-list">
                        <label>
                        {{ Form::radio('status', 1) }} Active</label> <br/>
                        <label>
                        {{ Form::radio('status', 0) }} In Active</label>
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