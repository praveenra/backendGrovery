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
@section('title','Seller')
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Seller </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Seller</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">User Details</h4>
               {!! Form::model($senddata, ['route' => $route, 'method' => $method, 'id'=>"formValidate" , 'novalidate'=>"true", 'files' => true]) !!}
               <div class="form-group">
                  <label for="first_name">User Name</label>
                  {{ Form::text('first_name',old('first_name'),['class' => 'form-control','data-error' => 'Enter Your User Name','placeholder'=>'Enter Your User Name','required'=>'required','type'=>'text','id'=>"name"] )}}
                  <p id="Name" style="color:red;"></p>
                  @if($errors->has('first_name'))
                  <div class="error_span help-text text-danger">{{ $errors->first('first_name') }}</div>
                  @endif
               </div>
               <div class="form-group">
                  <label for="mobile_number">Mobile Number</label>
                  {{ Form::number('mobile_number',old('mobile_number'),['class' => 'form-control','data-error' => 'Enter Your Mobile Number','placeholder'=>'Enter Your Mobile Number','required'=>'required','type'=>'number','min'=>"1",'max'=>"9999999999", 'id'=>"mobile1"] )}}
                  <p id="Mobile2" style="color:red;"></p>
                  @if($errors->has('mobile_number'))
                  <div class="error_span help-text text-danger">{{ $errors->first('mobile_number') }}</div>
                  @endif
               </div>
               <div class="form-group">
                  <label for="email">Email Id</label>
                  {{ Form::text('email',old('email'),['class' => 'form-control','data-error' => 'Enter Your Email','placeholder'=>'Enter Your Email','required'=>'required','type'=>'text','id'=>"email1"] )}}
                  <p id="Email2" style="color:red;"></p>
                  @if($errors->has('email'))
                  <div class="error_span help-text text-danger">{{ $errors->first('email') }}</div>
                  @endif
               </div>
               <div class="form-group">
                  <label for="">Password</label>
                  {{ Form::password('password',['class' => 'form-control','data-error' => 'Enter Your Password','placeholder'=>'Enter Your Password','required'=>'required','type'=>'password', 'id'=>"password"] )}}
                  <p id="Password" style="color:red;"></p>
                  @if($errors->has('password'))
                  <div class="error_span help-text text-danger">{{ $errors->first('password') }}</div>
                  @endif
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-6 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Seller Details</h4>
               <div class="form-group">
                  <label for="first_name">Store Name</label>
                  {{ Form::text('storedetails[sd_sname]',old('sd_sname'),['class' => 'form-control','data-error' => 'Enter Your Store Name','placeholder'=>'Enter Your Store Name','required'=>'required','type'=>'text','id'=>"sd_sname"] )}}
                  <p id="SdSname" style="color:red;"></p>
                  @if($errors->has('storedetails.sd_sname'))
                  <div class="error_span help-text text-danger">{{ $errors->first('storedetails.sd_sname') }}</div>
                  @endif
               </div>
          <div class="form-group">
        <label for="first_name">Main Category</label>
        {!! Form::select('storedetails[main_category]', (['' => '--Select a Category--'] + $main_category), ($senddata->main_category) ? $senddata->main_category : null ,['class' => 'form-control','data-error' => 'Choose Main Category','id'=>"main_category"]) !!}
        <p id="MainCategory" style="color:red;"></p>

                  <div class="help-block form-text with-errors form-control-feedback"></div>
                  @if( $errors->has('storedetails.main_category') )
                  <div class="error_span help-text text-danger"> {{ $errors->first('storedetails.main_category') }}</div>
                  @endif

               </div>
               <div class="form-group">
                  <label for="mobile_number">Store Number</label>
                  {{ Form::number('storedetails[sd_snumber]',old('sd_snumber'),['class' => 'form-control','data-error' => 'Enter Your Store Mobile Number','placeholder'=>'Enter Your Store Mobile Number','required'=>'required','type'=>'number','min'=>"1",'max'=>"9999999999",'id'=>"sd_snumber"] )}}
                  <p id="SdSnumber" style="color:red;"></p>
                  @if($errors->has('storedetails.sd_snumber'))
                  <div class="error_span help-text text-danger">{{ $errors->first('storedetails.sd_snumber') }}</div>
                  @endif
               </div>
               <div class="form-group">
                  <label for="email">Store AdminShare</label>
                  {{ Form::text('storedetails[sd_sadminshare]',old('sd_sadminshare'),['class' => 'form-control','data-error' => 'Enter Your Store AdminShare','placeholder'=>'Enter Your Store AdminShare','required'=>'required','type'=>'text','id'=>"sd_sadminshare"] )}}
                  <p id="SdSadminshare" style="color:red;"></p>
                  @if($errors->has('storedetails.sd_sadminshare'))
                  <div class="error_span help-text text-danger">{{ $errors->first('storedetails.sd_sadminshare') }}</div>
                  @endif
               </div>
               <div class="form-group">
                  <label for="">Store City</label>
                  {!! Form::select('storedetails[sd_scityid]', (['' => '--Select a City--'] + $cityvalue), ($senddata->sd_scityid) ? $senddata->sd_scityid : null ,['class' => 'form-control','data-error' => 'Choose City','id'=>"sd_scityid"]) !!}
                  <p id="SdScityid" style="color:red;"></p>
                  <div class="help-block form-text with-errors form-control-feedback"></div>
                  @if( $errors->has('storedetails.sd_scityid') )
                  <div class="error_span help-text text-danger"> {{ $errors->first('storedetails.sd_scityid') }}</div>
                  @endif
               </div>
                              <div class="form-group">
                     <label for="">Store Zone</label>
                     {!! Form::select('storedetails[sd_zone_id]', (['' => '--Select a Zone--'] + $zonevalue), ($senddata->sd_zone_id) ? $senddata->sd_zone_id : null ,['class' => 'form-control','data-error' => 'Choose Zone','id'=>"sd_zone_id"]) !!}
                     <p id="SdZoneId" style="color:red;"></p>
                     <div class="help-block form-text with-errors form-control-feedback"></div>
                     @if( $errors->has('storedetails[sd_zone_id]') )
                     <div class="error_span help-text text-danger"> {{ $errors->first('storedetails[sd_zone_id]') }}</div>
                     @endif
                  </div>

                  <div class="form-group">
                  <label for="mobile_number">Store Latitude</label>
                  {{ Form::number('storedetails[sd_lat]',old('sd_lat'),['class' => 'form-control','data-error' => 'Enter store Latitude','placeholder'=>'Latitude','required'=>'required','type'=>'number','min'=>"1",'max'=>"9999999999",'id'=>"sd_latitude"] )}}
                  <p id="SdLat" style="color:red;"></p>
                  @if($errors->has('storedetails.sd_lat'))
                  <div class="error_span help-text text-danger">{{ $errors->first('storedetails.sd_lat') }}</div>
                  @endif
               </div>
               <div class="form-group">
                  <label for="mobile_number">Store Longitude</label>
                  {{ Form::number('storedetails[sd_lng]',old('sd_lng'),['class' => 'form-control','data-error' => 'Enter store Longitude','placeholder'=>'Longitude','required'=>'required','type'=>'number','min'=>"1",'max'=>"9999999999",'id'=>"sd_longitude"] )}}
                  <p id="SdLng" style="color:red;"></p>
                  @if($errors->has('storedetails.sd_lng'))
                  <div class="error_span help-text text-danger">{{ $errors->first('storedetails.sd_lng') }}</div>
                  @endif
               </div>

               <div class="form-group">
                  <label for="">Store DeliveryKm</label>
                  {{ Form::number('storedetails[sd_sdeliverykm]',old('sd_sdeliverykm'),['class' => 'form-control','data-error' => 'Enter Your Store DeliveryKm','placeholder'=>'Enter Your Store DeliveryKm','required'=>'required','type'=>'number','min'=>"1",'max'=>"10000",'id'=>"sd_sdeliverykm"] )}}
                  <p id="SdSdeliverykm" style="color:red;"></p>
                  @if($errors->has('storedetails.sd_sdeliverykm'))
                  <div class="error_span help-text text-danger">{{ $errors->first('storedetails.sd_sdeliverykm') }}</div>
                  @endif
               </div>
               <div class="form-group">
                  <label for="email">Store Address</label>
                  {{ Form::text('storedetails[sd_address]',old('sd_address'),['class' => 'form-control','data-error' => 'Enter Your Store Address','placeholder'=>'Enter Your Store Address','required'=>'required','type'=>'text','id'=>"sd_address"] )}}
                  <p id="SdAddress" style="color:red;"></p>
                  @if($errors->has('storedetails.sd_address'))
                  <div class="error_span help-text text-danger">{{ $errors->first('storedetails.sd_address') }}</div>
                  @endif
               </div>
               <div class="form-group">
                  <label for="email">Store Pincode</label>
                  {{ Form::number('storedetails[sd_spincode]',old('sd_spincode'),['class' => 'form-control','data-error' => 'Enter Your Store Pincode','placeholder'=>'Enter Your Store Pincode','required'=>'required','type'=>'number','min'=>"1",'max'=>"9999999",'id'=>"sd_spincode"] )}}
                  <p id="SdSpincode" style="color:red;"></p>
                  @if($errors->has('storedetails.sd_spincode'))
                  <div class="error_span help-text text-danger">{{ $errors->first('storedetails.sd_spincode') }}</div>
                  @endif
               </div>

                <div class="form-group">
                  <label class="switch">
                    <input type="checkbox" name="buisness" id="customSwitch">
                    <span class="slider round"></span>
                  </label><label for="buisness">Buisness</label>
                </div>

                <script src="{{asset('public/js/jquery.min.js')}}"></script>
                <script type="text/javascript">
                  $(document).ready(function(){
                 $('#seller_store_timing').hide()
                    $("#customSwitch").change(function(){
                         if($('#customSwitch').is(":checked")){
                            $('#seller_store_timing').show()
                         }else{
                            $('#seller_store_timing').hide()
                         }
                      });
                    });
                </script>

               <div class="form-group">

                    <label for="first_name">Store Logo</label>
                    {{ Form::file('store_logo', old('store_logo'), ['class' => 'form-control']) }}
                    @if($errors->has('store_logo'))
                    <div class="error_span help-text text-danger">{{ $errors->first('store_logo') }}</div>
                    @endif
               </div>
               <div class="form-group">
                  @if($senddata->id!="")
                     <img src="{{url('admin/images/store_logo/')}}/{{$seller->store_logo}}" alt="" class="img-thumbnail" height="100" width="100" id="preview1"/>
                     <a style="cursor:pointer" onclick="removelogo()" id="remove1">Remove</a>
                     <input type="hidden" name="findremove" id="findremove1">
                  @endif

               </div><br>
               <div class="form-group">
                    <label for="first_name">Store Image</label>
                    {{ Form::file('store_image', old('store_image'), ['class' => 'form-control']) }}
                    @if($errors->has('store_image'))
                    <div class="error_span help-text text-danger">{{ $errors->first('store_image') }}</div>
                    @endif
               </div>
               <div class="form-group">

                  @if($senddata->id!="")
                     <img src="{{url('admin/images/store_image/')}}/{{$seller->store_image}}" alt="" class="img-thumbnail" height="100" width="100" id="preview"/>
                     <a style="cursor:pointer" onclick="removeimg()" id="remove">Remove</a>
                     <input type="hidden" name="findremove" id="findremove">
                  @endif

               </div>
               <div class="form-group">

                    <label for="first_name">Tags</label>
                    <input type="text" name="tag" class="form-control" value="{{$seller->tag}}" placeholder="Tags">
                    @if($errors->has('tag'))
                    <div class="error_span help-text text-danger">{{ $errors->first('tag') }}</div>
                    @endif
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
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
                       <td><input type="text" name="bank_name" class="form-control" value="{{$seller->bank_name}}" required placeholder="Bank Name"></td>
                       <td><input type="text" name="acc_no" class="form-control" value="{{$seller->acc_no}}" required placeholder="Account Number"></td>
                       <td><input type="text" name="ifsc" class="form-control" value="{{$seller->ifsc}}" required placeholder="IFSC Code"></td>
                       <td><input type="text" name="pan" class="form-control" value="{{$seller->pan}}" required placeholder="Pan Card Number"></td>
                       <td><input type="text" name="max_deposit" class="form-control" value="{{$seller->max_deposit}}" required placeholder="Max. Security Deposit"></td>
                     </tr>
                   </tbody>
                 </table>
              </div>
            </div>
         </div>
      </div>

      <div class="col-md-12 grid-margin stretch-card" id="seller_store_timing">
      </div>

      <div class="col-md-12 grid-margin stretch-card" id="seller_store_timing">
         <div class="card">
            <div class="card-body">
               <div class="form-group">
                 <label for="">Seller Timing</label>
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
                          <input type="checkbox" name="sunday_check" id="customSwitch1"  value="{{$seller->sunday_check}}" class="check">
                          <span class="slider round"></span>
                          </label>
                          <input type="time" name="sunday_opening_time" id="sunday_off1"  value="{{$seller->sunday_opening_time}}" class="form-control sunday_opening_time" disabled="">
                          <input type="time" name="sunday_closing_time" id="sunday_off2"  value="{{$seller->sunday_closing_time}}" class="form-control sunday_closing_time" disabled="">
                        </td>
                       <td>
                        <label class="switch" for="customSwitch2">
                          <input type="checkbox" name="monday_check" id="customSwitch2" value="{{$seller->monday_check}}" class="check">
                          <span class="slider round"></span>
                          </label>
                          <input type="time" name="monday_opening_time" id="monday_off1" value="{{$seller->monday_opening_time}}" class="form-control monday_opening_time" disabled="">
                          <input type="time" name="monday_closing_time" id="monday_off2" value="{{$seller->monday_closing_time}}" class="form-control monday_closing_time" disabled="">
                        </td>
                        <td>
                        <label class="switch" for="customSwitch3">
                          <input type="checkbox" name="tuesday_check" id="customSwitch3" value="{{$seller->tuesday_check}}" class="check">
                          <span class="slider round"></span>
                          </label>
                          <input type="time" name="tuesday_opening_time" id="tuesday_off1" value="{{$seller->tuesday_opening_time}}" class="form-control tuesday_opening_time" disabled="">
                          <input type="time" name="tuesday_closing_time" id="tuesday_off2" value="{{$seller->tuesday_closing_time}}" class="form-control tuesday_closing_time" disabled="">
                        </td>
                        <td>
                        <label class="switch" for="customSwitch4">
                          <input type="checkbox" name="wednesday_check" id="customSwitch4" value="{{$seller->wednesday_check}}" class="check">
                          <span class="slider round"></span>
                          </label>
                          <input type="time" name="wednesday_opening_time" id="wednesday_off1" value="{{$seller->wednesday_opening_time}}" class="form-control wednesday_opening_time" disabled="">
                          <input type="time" name="wednesday_closing_time" id="wednesday_off2" value="{{$seller->wednesday_closing_time}}" class="form-control wednesday_closing_time" disabled="">
                        </td>
                        <td>
                        <label class="switch" for="customSwitch5">
                          <input type="checkbox" name="thursday_check" id="customSwitch5" value="{{$seller->thursday_check}}" class="check">
                          <span class="slider round"></span>
                          </label>
                          <input type="time" name="thursday_opening_time" id="thursday_off1" value="{{$seller->thursday_opening_time}}" class="form-control thursday_opening_time" disabled="">
                          <input type="time" name="thursday_closing_time" id="thursday_off2" value="{{$seller->thursday_closing_time}}" class="form-control thursday_closing_time" disabled="">
                        </td>
                        <td>
                        <label class="switch" for="customSwitch6">
                          <input type="checkbox" name="friday_check" id="customSwitch6" value="{{$seller->friday_check}}" class="check">
                          <span class="slider round"></span>
                          </label>
                          <input type="time" name="friday_opening_time" id="friday_off1" value="{{$seller->friday_opening_time}}" class="form-control friday_opening_time" disabled="">
                          <input type="time" name="friday_closing_time" id="friday_off2" value="{{$seller->friday_closing_time}}" class="form-control friday_closing_time" disabled="">
                        </td>
                        <td>
                        <label class="switch" for="customSwitch7">
                          <input type="checkbox" name="saturday_check" id="customSwitch7" value="{{$seller->saturday_closing_time}}" class="check">
                          <span class="slider round"></span>
                          </label>
                          <input type="time" name="saturday_opening_time" id="saturday_off1" value="{{$seller->saturday_closing_time}}" class="form-control saturday_opening_time" disabled="">
                          <input type="time" name="saturday_closing_time" id="saturday_off2" value="{{$seller->saturday_closing_time}}" class="form-control saturday_closing_time" disabled="">
                        </td>
                     </tr>
                   </tbody>
                 </table>
              </div>
            </div>
         </div>
      </div>



      <button type="submit"  class="btn btn-gradient-primary mr-2 bt-sm test" style="margin-left: 45%; width:10%; ">Submit</button>

      </form>
   </div>
</div>



<script type="text/javascript">
function removeimg()
{
   document.getElementById("preview").style.display="none";
   document.getElementById("remove").style.display="none";
   document.getElementById("findremove").value="1";
}
function removelogo()
{
   document.getElementById("preview1").style.display="none";
   document.getElementById("remove1").style.display="none";
   document.getElementById("findremove").value="1";
}
</script>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('public/js/jquery.min.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function(){
         $( '.test' ).click(function( event ) {
            var name =$('#name').val();
            var mobile =$('#mobile1').val();
            var email =$('#email1').val();
            var password=$('#password').val();
            var main_category=$('#main_category').val();
            var sd_sname=$('#sd_sname').val();
            var sd_snumber=$('#sd_snumber').val();
            var sd_sadminshare=$('#sd_sadminshare').val();
            var sd_scityid=$('#sd_scityid').val();
            var sd_sdeliverykm=$('#sd_sdeliverykm').val();
            var sd_address=$('#sd_address').val();
            var sd_spincode=$('#sd_spincode').val();
            var sd_latitude=$('#sd_latitude').val();
            var sd_longitude=$('#sd_longitude').val();
            var count =0;
            if (name==null || name==""){
            $("#Name").html("Name is required");
            count++;
            }if(password.length<6){
            $("#Password").html("Password must be at least 6 characters long");
            count++;
            }if(mobile==null || mobile=="" && mobile.length!=10){
            $("#Mobile2").html("Mobile number must be 10 digits long");
            count++;
            }if(email==null || email==""){
            $("#Email2").html("Email is required");
            count++;
            }if(main_category==null || main_category==""){
            $("#MainCategory").html("Main Category is required");
            count++;
            }if(sd_sname==null || sd_sname==""){
            $("#SdSname").html("Shop Name is required");
            count++;
            }if(sd_snumber==null || sd_snumber==""){
            $("#SdSnumber").html("Shop Number is required");
            count++;
            }if(sd_sadminshare==null || sd_sadminshare==""){
            $("#SdSadminshare").html("Admin Share is required");
            count++;
            }if(sd_scityid==null || sd_scityid==""){
            $("#SdScityid").html("City is required");
            count++;
            }if(sd_sdeliverykm==null || sd_sdeliverykm==""){
            $("#SdSdeliverykm").html("Delivery Km is required");
            count++;
            }if(sd_address==null || sd_address==""){
            $("#SdAddress").html("Address is required");
            count++;
            }if(sd_spincode==null || sd_spincode==""){
            $("#SdSpincode").html("Pincode is required");
            count++;
            }if(sd_latitude==null || sd_latitude==""){
            $("#SdLat").html("Latitude is required");
            count++;
            }if(sd_longitude==null || sd_longitude==""){
            $("#SdLng").html("Longitude is required");
            count++;
            }
            if(count>0){
               return false;
            }
            });
    $("#customSwitch1").change(function(){
         if($('#customSwitch1').is(":checked")){
            $('#sunday_off1').prop('disabled',false)
            $('#sunday_off2').prop('disabled',false)
         }else{
            $('#sunday_off1').prop('disabled',true)
            $('#sunday_off2').prop('disabled',true)
         }
      });
    $("#customSwitch2").change(function(){
         if($('#customSwitch2').is(":checked")){
            $('#monday_off1').prop('disabled',false)
            $('#monday_off2').prop('disabled',false)
         }else{
            $('#monday_off1').prop('disabled',true)
            $('#monday_off2').prop('disabled',true)
         }
      });
    $("#customSwitch3").change(function(){
         if($('#customSwitch3').is(":checked")){
            $('#tuesday_off1').prop('disabled',false)
            $('#tuesday_off2').prop('disabled',false)
         }else{
            $('#tuesday_off1').prop('disabled',true)
            $('#tuesday_off2').prop('disabled',true)
         }
      });
    $("#customSwitch4").change(function(){
         if($('#customSwitch4').is(":checked")){
            $('#wednesday_off1').prop('disabled',false)
            $('#wednesday_off2').prop('disabled',false)
         }else{
            $('#wednesday_off1').prop('disabled',true)
            $('#wednesday_off2').prop('disabled',true)
         }
      });
    $("#customSwitch5").change(function(){
         if($('#customSwitch5').is(":checked")){
            $('#thursday_off1').prop('disabled',false)
            $('#thursday_off2').prop('disabled',false)
         }else{
            $('#thursday_off1').prop('disabled',true)
            $('#thursday_off2').prop('disabled',true)
         }
      });
    $("#customSwitch6").change(function(){
         if($('#customSwitch6').is(":checked")){
            $('#friday_off1').prop('disabled',false)
            $('#friday_off2').prop('disabled',false)
         }else{
            $('#friday_off1').prop('disabled',true)
            $('#friday_off2').prop('disab
         }
      });
    $("#customSwitch7").change(function(){
         if($('#customSwitch7').is(":checked")){
            $('#saturday_off1').prop('disabled',false)
            $('#saturday_off2').prop('disabled',false)
         }else{
            $('#saturday_off1').prop('disabled',true)
            $('#saturday_off2').prop('disabled',true)
         }
      });
    });
</script>
