<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<script type="text/javascript" src="js/googlemap.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkUOdZ5y7hMm0yrcCQoCvLwzdM6M8s5qk&libraries=drawing"></script>

 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
 <link rel="stylesheet" href="/path/to/cdn/bootstrap.min.css" />
 <script src="/path/to/cdn/jquery.min.js"></script>
 <script src="/path/to/cdn/bootstrap.min.js"></script>
 <link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css">
 <script type="text/javascript" src="js/bootstrap-multiselect.js"></script>

 <!-- Include Twitter Bootstrap and jQuery: -->
 <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
 <script type="text/javascript" src="js/jquery.min.js"></script>
 <script type="text/javascript" src="js/bootstrap.min.js"></script>
  
 <!-- Include the plugin's CSS and JS: -->
 <script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
 <link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css"/>

 <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

 <meta charset="utf-8">
 <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=1">

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha256-YLGeXaapI0/5IgZopewRJcFXomhRMlyyjugPLSyNjTY=" crossorigin="anonymous" />

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css">

 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

 <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
 <script type="text/javascript" src="js/googlemap.js"></script>

 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
 <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" ></script>

 <link rel=”stylesheet” href=”https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css”>

@extends('layouts.admin')
@section('title','Delivery Executive') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Care Givers </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Care Givers</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Care Givers</h4>
               {!! Form::model($senddata, ['route' => $route, 'method' => $method, 'id'=>"formValidate" , 'novalidate'=>"true", 'files' => true]) !!}
                  <div class="form-group">
                     <label for="first_name">User Name</label>
                     {{ Form::text('first_name',old('first_name'),['class' => 'form-control','data-error' => 'Enter Your User Name','placeholder'=>'Enter Your User Name','required'=>'required','type'=>'text'] )}}
                     @if($errors->has('first_name'))
                     <div class="error_span help-text text-danger">{{ $errors->first('first_name') }}</div>
                     @endif
                  </div>
                  <div class="form-group">
                    <label for="mobile_number">Mobile Number</label>
                    {{ Form::number('mobile_number',old('mobile_number'),['class' => 'form-control','data-error' => 'Enter Your Mobile Number','placeholder'=>'Enter Your Mobile Number','required'=>'required','type'=>'number','min'=>"1",'max'=>"9999999999"] )}}
                    @if($errors->has('mobile_number'))
                    <div class="error_span help-text text-danger">{{ $errors->first('mobile_number') }}</div>
                    @endif
                 </div>
                 <div class="form-group">
                     <label for="alternative_number">Alternative Number</label>
                     <input type="tel" name="alternative_number" class="form-control" value="{{$senddata->alternative_number}}" placeholder="Enter Alternative Number" pattern="[0-9]{10}">
                     @if($errors->has('alternative_number'))
                     <div class="error_span help-text text-danger">{{ $errors->first('alternative_number') }}</div>
                     @endif
                  </div>
                 <div class="form-group">
                    <label for="">Aadhar Number</label>
                    <input type="text" name="aadhar" class="form-control" id="aadhar_number_format" value="{{$senddata->aadhar}}" required placeholder="Enter Aadhar Number">
                    @if($errors->has('aadhar'))
                    <div class="error_span help-text text-danger">{{ $errors->first('aadhar') }}</div>
                    @endif
                 </div>
                 <div class="form-group">
                    <label for="">Driving License Number</label>
                    <input type="text" name="driving_license_no" class="form-control" value="{{$senddata->driving_license_no}}" required placeholder="Enter Driving License Number">
                    @if($errors->has('driving_license_no'))
                    <div class="error_span help-text text-danger">{{ $errors->first('driving_license_no') }}</div>
                    @endif
                 </div>
                 <div class="form-group">
                    <label for="">Driving License Expiry</label>
                    <input type="date" name="driving_license_expiry" class="form-control" value="{{$senddata->driving_license_expiry}}" required placeholder="Enter Driving License Expiry">
                    @if($errors->has('driving_license_expiry'))
                    <div class="error_span help-text text-danger">{{ $errors->first('driving_license_expiry') }}</div>
                    @endif
                 </div>
                 <div class="form-group">
                    <label for="email">Email Id</label>
                    {{ Form::text('email',old('email'),['class' => 'form-control','data-error' => 'Enter Your Email','placeholder'=>'Enter Your Email','required'=>'required','type'=>'text'] )}}
                    @if($errors->has('email'))
                    <div class="error_span help-text text-danger">{{ $errors->first('email') }}</div>
                    @endif
                 </div>
                 <div class="form-group">
                    <label for="">Password</label>
                    {{ Form::password('password',['class' => 'form-control','data-error' => 'Enter Your Password','placeholder'=>'Enter Your Password','required'=>'required','type'=>'password'] )}}
                    @if($errors->has('password'))
                    <div class="error_span help-text text-danger">{{ $errors->first('password') }}</div>
                    @endif
                </div>
               

                 <div class="form-group">
                  <label for="city_name">Care Giver City</label>
                  <select name="city_id" type="text"  class="form-control name_city" id="city_name_dropdown" onchange="Loadareacombo()" required>
                      <option value="">--- Select City---</option>
                      @foreach($cities as $city)
                      <option value="{{$city->city_id}}">{{$city->city_name}}</option>
                      @endforeach
                  </select>
               </div>

               <div class="form-group">
                    <label for="">Vertices</label>
                    <input name="vertices" id="vertices" value="{{$senddata->vertices}}" type="text" class="form-control vertices" readonly=""  />
               </div>

               <div class="form-group">
                  <label for="area">Care Giver Area</label>
                  <select name="area" type="text"  class="form-control name_area" id="area" required>
                  <option value="">--- Select Area---</option>
                  </select>
               </div>

                 <div class="form-group">
                    <label for="">Care Giver Address</label>
                    {{ Form::textarea('address',old('address'),['class' => 'form-control','data-error' => 'Enter Your Delivery Address','placeholder'=>'Enter Your Delivery Address','required'=>'required','type'=>'text'] )}}
                    @if($errors->has('address'))
                    <div class="error_span help-text text-danger">{{ $errors->first('address') }}</div>
                    @endif
                 </div>
                 <div class="form-group">
                    <label for="">Care Giver Image</label>
                    <input type="file" name="profile_image" id="exampleInputFile"  class="form-control" value="{{$senddata->profile_image}}" accept="image/png, image/jpeg" required="">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @if($errors->has('profile_image'))
                    <div class="error_span help-text text-danger">{{ $errors->first('profile_image') }}</div>
                    @endif
                 </div>
                 <div class="form-group">
                    <label for="">Bank Details</label>
                    <table>
                      <thead>
                        <tr>
                          <th>Bank Name</th>
                          <th>Account Number</th>
                          <th>IFSC Code</th>
                          <th>Pan Card No</th>
                          <th>Max. Security Deposit</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><input type="text" name="bank_name" class="form-control" value="{{$bank->bank_name}}" required placeholder="Bank Name"></td>
                          <td><input type="text" name="acc_no" id="account_number_format" class="form-control" value="{{$bank->acc_no}}" required placeholder="Account Number"></td>
                          <td><input type="text" name="ifsc" class="form-control" value="{{$bank->ifsc}}" required placeholder="IFSC Code"></td>
                          <td><input type="text" name="pan" id="pan_number_format" class="form-control" value="{{$bank->pan}}" required placeholder="Pan Card Number"></td>
                          <td><input type="text" name="max_deposit" id="max_deposit_format" class="form-control" value="{{$bank->max_deposit}}" required placeholder="Max. Security Deposit"></td>
                        </tr>
                      </tbody>
                    </table>
                 </div>

                 <input type="text" name="shift_type" class="form-control" placeholder="Shift Type">

                 <div class="form-group">
                    <label for="">Shift Details</label>
                    <table>
                      <thead>
                        <tr>
                          <th>Sunday</th>
                          <th>Monday</th>
                          <th>Tuesday</th>
                          <th>Wednesday</th>
                          <th>Thursday</th>
                          <th>Friday</th>
                          <th>Saturday</th>
                        </tr>
                      </thead>
                      <tbody>

                        <tr>
                          <td>
                            <label class="switch" for="customSwitch1">
                            <input type="checkbox" name="sunday_shift" id="customSwitch1" class="check">
                            <span class="slider round"></span>
                            </label>
                          </td>
                          <td>
                            <label class="switch" for="customSwitch2">
                            <input type="checkbox" name="monday_shift" id="customSwitch2" class="check">
                            <span class="slider round"></span>
                            </label>
                          </td>
                          <td>
                            <label class="switch" for="customSwitch3">
                            <input type="checkbox" name="tuesday_shift" id="customSwitch3" class="check">
                            <span class="slider round"></span>
                            </label>
                          </td>
                          <td>
                            <label class="switch" for="customSwitch4">
                            <input type="checkbox" name="wednesday_shift" id="customSwitch4" class="check">
                            <span class="slider round"></span>
                            </label>
                          </td>
                          <td>
                            <label class="switch" for="customSwitch5">
                            <input type="checkbox" name="thursday_shift" id="customSwitch5" class="check">
                            <span class="slider round"></span>
                            </label>
                          </td>
                          <td>
                            <label class="switch" for="customSwitch6">
                            <input type="checkbox" name="friday_shift" id="customSwitch6" class="check">
                            <span class="slider round"></span>
                            </label>
                          </td>
                          <td>
                            <label class="switch" for="customSwitch7">
                            <input type="checkbox" name="saturday_shift" id="customSwitch7" class="check">
                            <span class="slider round"></span>
                            </label>
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <select type="text" name="sunday_zone" class="form-control" placeholder="Sunday Zone" id="sunday_off" disabled="">
                            <option value="">Select an Option</option>
                            @foreach($area1 as $area11)
                            <option value="{{$area11->area_name}}" >{{$area11->area_name}}</option>
                            @endforeach
                            <input type="time" name="sunday_start_time" id="sunday_off1" class="form-control" disabled="">
                            <input type="time" name="sunday_end_time" id="sunday_off2" class="form-control" disabled="">
                          </td>
                          <td>
                            <select type="text" name="monday_zone" id="monday_off" class="form-control" placeholder="Monday Zone" disabled="">
                            <option value="" >Select an Option</option>
                            @foreach($area2 as $area22)
                            <option value="{{$area22->area_name}}" >{{$area22->area_name}}</option>
                            @endforeach
                            <input type="time" name="monday_start_time" id="monday_off1" class="form-control" disabled="">
                            <input type="time" name="monday_end_time" id="monday_off2" class="form-control" disabled="">
                          </td>
                          <td>
                            <select type="text" name="tuesday_zone" id="tuesday_off" class="form-control" placeholder="Tuesday Zone" disabled="">
                            <option value="">Select an Option</option>
                            @foreach($area3 as $area33)
                            <option value="{{$area33->area_name}}">{{$area33->area_name}}</option>
                            @endforeach
                            <input type="time" name="tuesday_start_time" id="tuesday_off1" class="form-control" disabled="">
                            <input type="time" name="tuesday_end_time" id="tuesday_off2" class="form-control" disabled="">
                          </td>
                          <td>
                            <select type="text" name="wednesday_zone" id="wednesday_off" class="form-control" placeholder="Sunday Zone" disabled="">
                            <option value="">Select an Option</option>
                            @foreach($area4 as $area44)
                            <option value="{{$area44->area_name}}">{{$area44->area_name}}</option>
                            @endforeach
                            <input type="time" name="wednesday_start_time" id="wednesday_off1" class="form-control" disabled="">
                            <input type="time" name="wednesday_end_time" id="wednesday_off2" class="form-control" disabled="">
                          </td>
                          <td>
                            <select type="text" name="thursday_zone" id="thursday_off" class="form-control" placeholder="Sunday Zone" disabled="">
                            <option value="">Select an Option</option>
                            @foreach($area5 as $area55)
                            <option value="{{$area55->area_name}}">{{$area55->area_name}}</option>
                            @endforeach
                            <input type="time" name="thursday_start_time" id="thursday_off1" class="form-control" disabled="">
                            <input type="time" name="thursday_end_time" id="thursday_off2" class="form-control" disabled="">
                          </td>
                          <td>
                            <select type="text" name="friday_zone" id="friday_off" class="form-control" placeholder="Sunday Zone" disabled="">
                            <option value="">Select an Option</option>
                            @foreach($area6 as $area66)
                            <option value="{{$area66->area_name}}">{{$area66->area_name}}</option>
                            @endforeach
                            <input type="time" name="friday_start_time" id="friday_off1" class="form-control" disabled="">
                            <input type="time" name="friday_end_time" id="friday_off2" class="form-control" disabled="">
                          </td>
                          <td>
                            <select type="text" name="saturday_zone" id="saturday_off" class="form-control" placeholder="Sunday Zone" disabled="">
                            <option value="">Select an Option</option>
                            @foreach($area7 as $area77)
                            <option value="{{$area77->area_name}}">{{$area77->area_name}}</option>
                            @endforeach
                            <input type="time" name="saturday_start_time" id="saturday_off1" class="form-control" disabled="">
                            <input type="time" name="saturday_end_time" id="saturday_off2" class="form-control" disabled="">
                          </td>
                        </tr>
                      </tbody>
                    </table>
                 </div>


                 <div class="form-group">
                    <label for="first_name">Status</label>
                    <div class="radio-list">
                        <label>
                        {{ Form::radio('user_status', 1) }} Active</label> <br/>
                        <label>
                        {{ Form::radio('user_status', 0) }} In Active</label>
                     </div>
                 </div>
                 <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('public/js/jquery.min.js')}}"></script>

<!-- Starting image validation -->

<script>

$(document).ready(function() {

  if (window.File && window.FileList && window.FileReader) {
    $("#exampleInputFile").on("change", function(e) {
      var files = e.target.files,
      filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
          "<img class=\"imageThumb\" style=\" width:100px; height:100px\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
          "<br/><span class=\"remove btn btn-danger btn-sm\"><i class=\"glyphicon glyphicon-remove\"></i>Remove image</span>" +
          "</span>").insertAfter("#exampleInputFile");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });

        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});

</script>

<!-- Ending image validation -->

<script type="text/javascript">
    $("#max_deposit_format").keypress(function (e) {
          var keyCode = e.keyCode || e.which;

          var regex = /^[0-9]+$/;

          //Validate TextBox value against the Regex.
          var isValid = regex.test(String.fromCharCode(keyCode));
          return isValid;
        
      });
</script>

<script type="text/javascript">
  $(document).ready(function(){

    $("#customSwitch1").change(function(){
         if($('#customSwitch1').is(":checked")){
            $('#sunday_off').prop('disabled',false)
            $('#sunday_off1').prop('disabled',false)
            $('#sunday_off2').prop('disabled',false)
         }else{
            $('#sunday_off').prop('disabled',true)
            $('#sunday_off1').prop('disabled',true)
            $('#sunday_off2').prop('disabled',true)
         }
      });

    $("#customSwitch2").change(function(){
         if($('#customSwitch2').is(":checked")){
            $('#monday_off').prop('disabled',false)
            $('#monday_off1').prop('disabled',false)
            $('#monday_off2').prop('disabled',false)
         }else{
            $('#monday_off').prop('disabled',true)
            $('#monday_off1').prop('disabled',true)
            $('#monday_off2').prop('disabled',true)
         }
      });

    $("#customSwitch3").change(function(){
         if($('#customSwitch3').is(":checked")){
            $('#tuesday_off').prop('disabled',false)
            $('#tuesday_off1').prop('disabled',false)
            $('#tuesday_off2').prop('disabled',false)
         }else{
            $('#tuesday_off').prop('disabled',true)
            $('#tuesday_off1').prop('disabled',true)
            $('#tuesday_off2').prop('disabled',true)
         }
      });

    $("#customSwitch4").change(function(){
         if($('#customSwitch4').is(":checked")){
            $('#wednesday_off').prop('disabled',false)
            $('#wednesday_off1').prop('disabled',false)
            $('#wednesday_off2').prop('disabled',false)
         }else{
            $('#wednesday_off').prop('disabled',true)
            $('#wednesday_off1').prop('disabled',true)
            $('#wednesday_off2').prop('disabled',true)
         }
      });

    $("#customSwitch5").change(function(){
         if($('#customSwitch5').is(":checked")){
            $('#thursday_off').prop('disabled',false)
            $('#thursday_off1').prop('disabled',false)
            $('#thursday_off2').prop('disabled',false)
         }else{
            $('#thursday_off').prop('disabled',true)
            $('#thursday_off1').prop('disabled',true)
            $('#thursday_off2').prop('disabled',true)
         }
      });

    $("#customSwitch6").change(function(){
         if($('#customSwitch6').is(":checked")){
            $('#friday_off').prop('disabled',false)
            $('#friday_off1').prop('disabled',false)
            $('#friday_off2').prop('disabled',false)
         }else{
            $('#friday_off').prop('disabled',true)
            $('#friday_off1').prop('disabled',true)
            $('#friday_off2').prop('disabled',true)
         }
      });

    $("#customSwitch7").change(function(){
         if($('#customSwitch7').is(":checked")){
            $('#saturday_off').prop('disabled',false)
            $('#saturday_off1').prop('disabled',false)
            $('#saturday_off2').prop('disabled',false)
         }else{
            $('#saturday_off').prop('disabled',true)
            $('#saturday_off1').prop('disabled',true)
            $('#saturday_off2').prop('disabled',true)
         }
      });

  });
</script>

<script type="text/javascript">
  $(document).ready(function(){

    $("#aadhar_number_format").keypress(function (e) {
          var keyCode = e.keyCode || e.which;

          var regex = /^[0-9]+$/;

          //Validate TextBox value against the Regex.
          var isValid = regex.test(String.fromCharCode(keyCode));
          return isValid;
        
      });

    $("#account_number_format").keypress(function (e) {
          var keyCode = e.keyCode || e.which;

          var regex = /^[0-9]+$/;

          //Validate TextBox value against the Regex.
          var isValid = regex.test(String.fromCharCode(keyCode));
          return isValid;
        
      });

    $("#pan_number_format").keypress(function (e) {
          var keyCode = e.keyCode || e.which;

          var regex = /^[0-9]+$/;

          //Validate TextBox value against the Regex.
          var isValid = regex.test(String.fromCharCode(keyCode));
          return isValid;
        
      });

    });
</script>


<script type="text/javascript">
                
    $(document).ready(function(){

      $(document).on('change','.name_city',function(){
        // $('#name_city').on('change', function () {

          var city_id =  $('.name_city').val();
          // var city_id = $(this).val();   //alert(stateID);

         // alert(city_id);
          
          $.ajax({
              type:'GET',
              url:"{{ url('superadmin/delivery_city/city_dropdown') }}",
              data:{'id':city_id},
              dataType:'json',
              success:function(data){
                  
                  console.log(data);

                   $('#city_id').val(data.city_id);
                   $('#vertices').val(data.vertices);
              },
              error:function(){

              }
          });
      });
  });

  function Loadareacombo() {
            var name='area';
            var sel = document.getElementById('area');
            $.ajax({
                type: "GET",
                url:"{{ url('superadmin/delivery_city/area_dropdown') }}",
                data:{'id':document.getElementById("city_name_dropdown").value},
                dataType: "json",
                success: function (response) {
                  $('#area').empty();
                    $.each(response, function (index, item) {
                      console.log('areares',item.area_name);
                     //   $(name).get(0).options[$(name).get(0).options.length] = new Option(item.area_name, item.area_name);
                     opt = document.createElement('option');
                     opt.value = item.area_name;
                    opt.innerHTML = item.area_name;
                    sel.appendChild(opt);
                    });

                },
                failure: function (msg) {
                    alert("No records to display ");
                }
            });
        }


</script>

@endsection