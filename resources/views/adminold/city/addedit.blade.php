@extends('layouts.admin2')
@section('title','City') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> create City </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">create City</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">City</h4>
               {!! Form::model($senddata, ['method' => $method, 'route' => $route, 'enctype'=>'multipart/form-data']) !!}
                  <div class="form-group">
                     <label for="city_name">City Name</label>
                     {{ Form::text('city_name', old('city_name'), ['class' => 'form-control', 'placeholder' => 'Title']) }}
                     @if($errors->has('city_name'))
                     <div class="error_span help-text text-danger">{{ $errors->first('city_name') }}</div>
                     @endif
                  </div>


                 <div class="form-group">
                    <label for="first_name">City Status</label>
                    <div class="radio-list">
                        <label>
                        {{ Form::radio('city_status', 1) }} Active</label> <br/>
                        <label>
                        {{ Form::radio('city_status', 0) }} In Active</label>
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