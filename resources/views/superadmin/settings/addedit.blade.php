<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script type="text/javascript" src="js/googlemap.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
  <meta charset="utf-8"> 

  <style>

.switch {
  position: relative;
  display: inline-block;
  width: 30px;
  height: 15px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 10px;
  width: 10px;
  left: 2px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(15px);
  -ms-transform: translateX(15px);
  transform: translateX(15px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}


    


</style>


@extends('layouts.admin')
@section('title','Store Settings') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Store Settings </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">store settings</li>
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
                     <label for="first_name">Store Name</label>
                     {!! Form::select('seller_id', (['' => '--Select a Store Name--'] + $seller_id), ($senddata->seller_id) ? $senddata->seller_id : null ,['class' => 'form-control','data-error' => 'Choose seller id']) !!}  
                  </div>

                  <div class="form-group">
                    <div class="col-lg-3">
                     <label for="sunday">Sunday</label>
                     <label class="switch">
                        <input type="checkbox" name="sunday_check" class="check">
                        <span class="slider round"></span>
                      </label>
                    </div>
                    <div class="col-lg-3">
                      <input type="time" name="sunday_opening_time" class="form-control sunday_opening_time">
                    </div>
                    <div class="col-lg-3">
                      <input type="time" name="sunday_closing_time" class="form-control sunday_closing_time">
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="col-lg-3">
                     <label for="monday">Monday</label>
                     <label class="switch">
                        <input type="checkbox" name="monday_check" class="check">
                        <span class="slider round"></span>
                      </label>
                    </div>
                    <div class="col-lg-3">
                      <input type="time" name="monday_opening_time" class="form-control monday_opening_time">
                    </div>
                    <div class="col-lg-3">
                      <input type="time" name="monday_closing_time" class="form-control monday_closing_time">
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="col-lg-3">
                     <label for="tuesday">Tuesday</label>
                     <label class="switch">
                        <input type="checkbox" name="tuesday_check" class="check">
                        <span class="slider round"></span>
                      </label>
                    </div>
                    <div class="col-lg-3">
                      <input type="time" name="tuesday_opening_time" class="form-control tuesday_opening_time">
                    </div>
                    <div class="col-lg-3">
                      <input type="time" name="tuesday_closing_time" class="form-control tuesday_closing_time">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-lg-3">
                     <label for="wednesday">Wednesday</label>
                     <label class="switch">
                        <input type="checkbox" name="wednesday_check" class="check">
                        <span class="slider round"></span>
                      </label>
                    </div>
                    <div class="col-lg-3">
                      <input type="time" name="wednesday_opening_time" class="form-control wednesday_opening_time">
                    </div>
                    <div class="col-lg-3">
                      <input type="time" name="wednesday_closing_time" class="form-control wednesday_closing_time">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-lg-3">
                     <label for="thursday">Thursday</label>
                     <label class="switch">
                        <input type="checkbox" name="thursday_check" class="check">
                        <span class="slider round"></span>
                      </label>
                    </div>
                    <div class="col-lg-3">
                      <input type="time" name="thursday_opening_time" class="form-control thursday_opening_time">
                    </div>
                    <div class="col-lg-3">
                      <input type="time" name="thursday_closing_time" class="form-control thursday_closing_time">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-lg-3">
                     <label for="friday">Friday</label>
                     <label class="switch">
                        <input type="checkbox" name="friday_check" class="check">
                        <span class="slider round"></span>
                      </label>
                    </div>
                    <div class="col-lg-3">
                      <input type="time" name="friday_opening_time" class="form-control friday_opening_time">
                    </div>
                    <div class="col-lg-3">
                      <input type="time" name="friday_closing_time" class="form-control friday_closing_time">
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="col-lg-3">
                     <label for="saturday">Saturday</label>
                     <label class="switch">
                        <input type="checkbox" name="saturday_check" class="check">
                        <span class="slider round"></span>
                      </label>
                    </div>
                    <div class="col-lg-3">
                      <input type="time" name="saturday_opening_time" class="form-control saturday_opening_time">
                    </div>
                    <div class="col-lg-3">
                      <input type="time" name="saturday_closing_time" class="form-control saturday_closing_time">
                    </div>
                  </div>




                  <div class="row">
                  <div class="col-lg-12">
                     <div class="form-group">
                        <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input" id="customSwitch" name="business">
                           <label class="custom-control-label" for="customSwitch">Business</label>
                        </div>
                     </div>
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