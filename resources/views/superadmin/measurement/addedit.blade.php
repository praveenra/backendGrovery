@extends('layouts.admin')
@section('title','Admin') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> create Offer </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">create Offer</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Measurement</h4>
               {!! Form::model($senddata, ['method' => $method, 'route' => $route, 'enctype'=>'multipart/form-data']) !!}
                  <div class="form-group">
                     <label for="first_name">Name</label>
                     {{ Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Measurement Name']) }}
                     @if($errors->has('name'))
                     <div class="error_span help-text text-danger">{{ $errors->first('name') }}</div>
                     @endif
                  </div>
				  
                 <div class="form-group">
                    <label for="first_name">Measurement Status</label>
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>


@endsection