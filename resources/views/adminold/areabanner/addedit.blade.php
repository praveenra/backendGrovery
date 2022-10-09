@extends('layouts.admin2')
@section('title','Area Banner') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> create Area Banner </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">create Banner</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Area Banner</h4>
               {!! Form::model($slider, ['method' => $method, 'route' => $route, 'enctype'=>'multipart/form-data']) !!}
                  <div class="form-group">
                     <label for="first_name">Banner Name</label>
                     {{ Form::text('ab_name', old('ab_name'), ['class' => 'form-control', 'placeholder' => 'Title']) }}
                     @if($errors->has('ab_name'))
                     <div class="error_span help-text text-danger">{{ $errors->first('ab_name') }}</div>
                     @endif
                  </div>
                  <div class="form-group">
                     <label for="first_name">Main Category</label>
                     <select class="form-control" name="mc_id">
                       <option value="">Select Main Category</option>
                        @foreach($main_categories as $data)
                          <option value="{{$data->mc_id}}" {{$slider->mc_id == $data->mc_id ? 'selected' : ''}}>{{$data->mc_name}}</option>
                        @endforeach
                     </select>
                     @if($errors->has('mc_id'))
                     <div class="error_span help-text text-danger">{{ $errors->first('mc_id') }}</div>
                     @endif
                  </div>
                  <div class="form-group">
                     <label for="">Area Banner</label>
                     {!! Form::select('ab_area_id', (['' => '--Select a Area--'] + $areas), ($slider->ab_area_id) ? $slider->ab_area_id : null ,['class' => 'form-control','data-error' => 'Choose Area']) !!}                    
                     <div class="help-block form-text with-errors form-control-feedback"></div>
                     @if( $errors->has('ab_area_id') )
                     <div class="error_span help-text text-danger"> {{ $errors->first('ab_area_id') }}</div>
                     @endif
                  </div>
                  <div class="form-group">
                    <label>Current Image</label>
                    @if($slider->SliderImage())
                    <img src="{{$slider->SliderImage()}}" alt="" class="img-thumbnail"/>
                     @endif  
                </div>
                  <div class="form-group">
                    <label for="first_name">Banner Image</label>
                    <input type="file" name="ab_image" class="form-control" value="{{old('ab_image')}}" onchange="loadImage(this);">
                    <div style="margin-left:10px;"><br>
                        <img src="" id="img_preview">
                    </div>
                    @if($errors->has('ab_image'))
                    <div class="error_span help-text text-danger">{{ $errors->first('ab_image') }}</div>
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
                    <label for="first_name">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="{{old('start_date')}}{{$slider->start_date}}">
                    @if($errors->has('start_date'))
                    <div class="error_span help-text text-danger">{{ $errors->first('start_date') }}</div>
                    @endif
                 </div>
                 <div class="form-group">
                    <label for="first_name">End Date</label>
                    <input type="date" name="end_date" class="form-control" value="{{old('end_date')}}{{$slider->end_date}}">
                    @if($errors->has('end_date'))
                    <div class="error_span help-text text-danger">{{ $errors->first('end_date') }}</div>
                    @endif
                 </div>
                 <div class="form-group">
                    <label for="first_name">Banner Status</label>
                    <div class="radio-list">
                        <label>
                        {{ Form::radio('ab_status', 1) }} Active</label> <br/>
                        <label>
                        {{ Form::radio('ab_status', 0) }} In Active</label>
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