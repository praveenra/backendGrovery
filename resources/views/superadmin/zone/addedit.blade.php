@extends('layouts.admin')
@section('title','Zone') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Grovery Service Providing Zone </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Grovery Service Providing Zone</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Grovery Service Providing Zone</h4>
               {!! Form::model($senddata, ['method' => $method, 'route' => $route, 'enctype'=>'multipart/form-data']) !!}
                  <div class="form-group">
                     <label for="first_name">Zone Name</label>
                     {{ Form::text('zone_name', old('zone_name'), ['class' => 'form-control', 'placeholder' => 'Title']) }}
                     @if($errors->has('zone_name'))
                     <div class="error_span help-text text-danger">{{ $errors->first('zone_name') }}</div>
                     @endif
                  </div>
                  <div class="form-group">
                     <label for="first_name">Zone Latitude</label>
                     {{ Form::text('zone_lat', old('zone_lat'), ['class' => 'form-control', 'placeholder' => 'Zone Latitude']) }}
                     @if($errors->has('zone_lat'))
                     <div class="error_span help-text text-danger">{{ $errors->first('zone_lat') }}</div>
                     @endif
                  </div>
                  <div class="form-group">
                     <label for="first_name">Zone Longitude</label>
                     {{ Form::text('zone_lon', old('zone_lon'), ['class' => 'form-control', 'placeholder' => 'Zone Longitude']) }}
                     @if($errors->has('zone_lon'))
                     <div class="error_span help-text text-danger">{{ $errors->first('zone_lon') }}</div>
                     @endif
                  </div>
                  <div class="form-group">
                     <label for="first_name">Zone Radius</label>
                     {{ Form::text('zone_radius', old('zone_radius'), ['class' => 'form-control', 'placeholder' => 'Zone Radius']) }}
                     @if($errors->has('zone_radius'))
                     <div class="error_span help-text text-danger">{{ $errors->first('zone_radius') }}</div>
                     @endif
                  </div>
                 <div class="form-group">
                    <label for="first_name">Zone Status</label>
                    <div class="radio-list">
                        <label>
                        {{ Form::radio('zone_status', 1) }} Active</label> <br/>
                        <label>
                        {{ Form::radio('zone_status', 0) }} In Active</label>
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