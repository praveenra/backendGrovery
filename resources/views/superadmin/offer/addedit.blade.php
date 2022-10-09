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
@section('title','Coupon') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Coupon </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Coupon</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-3 grid-margin stretch-card">
         <div class="card">
            <div class="card-body p-3">
            <form action="{{route('saveOffer')}}" method="post" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="id" value="{{$offer->id}}">
               <div class="form-group">
                  <label for="city">City</label>
                  <select class="form-control" name="city" required="">
                     <option value="">Select City</option>
                     @foreach($cities as $city)
                        <option value="{{$city->city_id}}" {{$offer->city == $city->city_id  ? 'selected' : '' }}>{{$city->city_name}}</option>
                     @endforeach
                  </select>
                  @if($errors->has('city'))
                     <div class="error_span help-text text-danger">{{ $errors->first('city') }}</div>
                  @endif
               </div>
               <div class="form-group">
                  <label for="subject">Subject</label>
                  <input type="text"  name="subject" class="form-control" placeholder="Subject" value="{{$offer->subject}}" required="">
                  @if($errors->has('subject'))
                     <div class="error_span help-text text-danger">{{ $errors->first('subject') }}</div>
                  @endif
               </div>

               <div class="form-group">
                  <label for="coupon_name">Coupon Name</label>
                  <input type="text"  name="coupon_name" class="form-control" placeholder="Coupon Name" value="{{$offer->coupon_name}}" required="">
                  @if($errors->has('coupon_name'))
                     <div class="error_span help-text text-danger">{{ $errors->first('coupon_name') }}</div>
                  @endif
               </div>  

               <div class="form-group">
                  <label for="coupon_code">Coupon code</label>
                  <input type="text"  name="coupon_code" class="form-control" placeholder="Coupon code" value="{{$offer->coupon_code}}" required="">
                  @if($errors->has('coupon_code'))
                     <div class="error_span help-text text-danger">{{ $errors->first('coupon_code') }}</div>
                  @endif
               </div>               
               <div class="form-group">
                  <label for="details">Details</label>
                  <textarea name="details" class="form-control" placeholder="Details">{{$offer->details}}</textarea>
                  @if($errors->has('details'))
                     <div class="error_span help-text text-danger">{{ $errors->first('details') }}</div>
                  @endif
               </div>
               <div class="form-group">
                  <label for="type">Type</label>
                  <select class="form-control" name="type" required="">
                     <option value="">Select Type</option>
                     <option value="percentage" {{$offer->type == 'percentage'  ? 'selected' : '' }}>Percentage</option>
                     <option value="absolute" {{$offer->type == 'absolute'  ? 'selected' : '' }}>Absolute</option>
                  </select>
                  @if($errors->has('type'))
                     <div class="error_span help-text text-danger">{{ $errors->first('type') }}</div>
                  @endif
               </div>
               <div class="form-group">
                  <label for="">Value</label>
                  <input type="text" name="value" id="value_format" class="form-control" placeholder="value" value="{{$offer->value}}" required="">
                  @if($errors->has('value'))
                     <div class="error_span help-text text-danger">{{ $errors->first('value') }}</div>
                  @endif
               </div>

               <script type="text/javascript">
                  $("#value_format").keypress(function (e) {
                  var keyCode = e.keyCode || e.which;
       
                  var regex = /^[0-9]+$/;
       
                  //Validate TextBox value against the Regex.
                  var isValid = regex.test(String.fromCharCode(keyCode));
                  return isValid;
                
              });
               </script>
               <div class="form-group">
                  <label for="promo_for">Coupon For</label>
                  <select class="form-control coupon_search" name="coupon_for" id="coupon_for" required="">
                     <option value="">Select Coupon</option>
                     <option value="main_category" class="coupon_search" {{$offer->coupon_for == 'main_category'  ? 'selected' : '' }}>Main Category</option>
                     <option value="stores" class="coupon_search" {{$offer->coupon_for == 'stores'  ? 'selected' : '' }}>Stores</option>
                     <option value="items" class="coupon_search" {{$offer->coupon_for == 'items'  ? 'selected' : '' }}>Items</option>
                     <option value="product_sub_category" class="coupon_search" {{$offer->coupon_for == 'product_sub_category'  ? 'selected' : '' }}>Product Sub Category</option>
                     <option value="delivery" class="coupon_search" {{$offer->coupon_for == 'delivery'  ? 'selected' : '' }}>Delivery</option>
                  </select>
                  @if($errors->has('coupon_for'))
                     <div class="error_span help-text text-danger">{{ $errors->first('coupon_for') }}</div>
                  @endif
               </div>
               <div class="form-group">
                  <label for="type">Loyalty Type</label>
                  <select class="form-control" name="loyalty_type" required="">
                     <option value="">Select Loyalty Type</option>
                     <option value="percentage" {{$offer->loyalty_type == 'percentage'  ? 'selected' : '' }}>Percentage</option>
                     <option value="absolute" {{$offer->loyalty_type == 'absolute'  ? 'selected' : '' }}>Absolute</option>
                  </select>
                  @if($errors->has('loyalty_type'))
                     <div class="error_span help-text text-danger">{{ $errors->first('loyalty_type') }}</div>
                  @endif
               </div>
               <div class="form-group">
                  <label for="">Loyalty</label>
                  <input type="text" name="loyalty" class="form-control" placeholder="Loyalty" value="{{$offer->value}}" required="">
                  @if($errors->has('loyalty'))
                     <div class="error_span help-text text-danger">{{ $errors->first('loyalty') }}</div>
                  @endif
               </div>

               <div class="form-group">
                  <label for="">Image</label>
                  <input type="file" name="image" class="form-control" onchange="loadImage(this)">
                  @if($action == 'Add')
                     <img src="" id="preview">
                  @elseif($action == 'Edit')
                     <img src="data:image/png;base64, {{$offer->image}}" height="100" width="100" id="preview">
                  @endif
               </div>
               <script type="text/javascript">

                  function loadImage(input, id) {
                        $('#preview').css('display','block');
                        id = id || '#preview';
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
            </div>
         </div>
      </div>
      <div class="col-md-5 grid-margin stretch-card">
         <div class="card">
            <div class="card-body p-3">

               <div class="row">
                  <div class="form-group col-lg-6">
                     <div class="custom-control custom-switch">
                     <label for="user_type">User Type</label>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <select class="form-control" name="user_type" id="user_type">
                        <option value="all_user" {{$offer->user_type == 'all_user'  ? 'selected' : '' }}>All User </option>
                        <option value="membership" {{$offer->user_type == 'membership'  ? 'selected' : '' }}>Membership</option>
                        <option value="first_time_user" {{$offer->user_type == 'first_time_user'  ? 'selected' : '' }}>First Time User</option>
                     </select> 
                     @if($errors->has('user_type'))
                        <div class="error_span help-text text-danger">{{ $errors->first('user_type') }}</div>
                     @endif 
                  </div>
               </div> 

               <div class="row">
                  <div class="col-lg-12">
                     <div class="form-group">
                        <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input" id="customSwitch1" name="approve" {{$offer->approve == 'on'  ? 'checked' : '' }}>
                           <label class="custom-control-label" for="customSwitch1">Approve</label>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="form-group">
                        <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input" id="customSwitch2" name="active" {{$offer->active == 'on'  ? 'checked' : '' }}>
                           <label class="custom-control-label" for="customSwitch2">Active</label>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-lg-12">
                     <div class="form-group">
                        <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input" id="customSwitch11" name="user_visible" {{$offer->approve == 'on'  ? 'checked' : '' }}>
                           <label class="custom-control-label" for="customSwitch11">User Visible</label>
                        </div>
                     </div>
                  </div>
               </div>                                        
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input" id="customSwitch10" name="user_limit_per_day" {{$offer->user_limit_per_day == 'on'  ? 'checked' : '' }}>
                           <label class="custom-control-label" for="customSwitch10">User Limit Per Day</label>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     @if($action == 'Add')
                        <input type="text" name="user_limit" id="user_limit" class="form-control" disabled>
                     @elseif($action == 'Edit' && $offer->user_limit_per_day == 'on')
                        <input type="text" name="user_limit" id="user_limit" class="form-control" value="{{$offer->user_limit}}">
                     @elseif($action == 'Edit' && $offer->user_limit_per_day == '')
                        <input type="text" name="user_limit" id="user_limit" class="form-control" value="{{$offer->user_limit}}" disabled>
                     @endif
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input" id="customSwitch3" name="apply_after_completion" {{$offer->apply_after_completion == 'on'  ? 'checked' : '' }}>
                           <label class="custom-control-label" for="customSwitch3">Apply After Completion</label>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     @if($action == 'Add')
                        <input type="text" name="apply_completion" id="apply_completion" class="form-control" disabled>
                     @elseif($action == 'Edit' && $offer->apply_after_completion == 'on')
                        <input type="text" name="apply_completion" id="apply_completion" class="form-control" value="{{$offer->apply_completion}}">
                     @elseif($action == 'Edit' && $offer->apply_after_completion == '')
                        <input type="text" name="apply_completion" id="apply_completion" class="form-control" value="{{$offer->apply_completion}}" disabled>
                     @endif
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input" id="customSwitch4" name="promo_uses" {{$offer->promo_uses == 'on'  ? 'checked' : '' }}>
                           <label class="custom-control-label" for="customSwitch4">Promo Uses Required</label>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     @if($action == 'Add')
                        <input type="text" name="promo" id="promo" class="form-control" disabled>
                     @elseif($action == 'Edit' && $offer->promo_uses == 'on')
                        <input type="text" name="promo" id="promo" class="form-control" value="{{$offer->promo}}">
                     @elseif($action == 'Edit' && $offer->promo_uses == '')
                        <input type="text" name="promo" id="promo" class="form-control" value="{{$offer->promo}}" disabled>
                     @endif
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input" id="customSwitch5" name="minimum_amount_limit" {{$offer->minimum_amount_limit == 'on'  ? 'checked' : '' }}>
                           <label class="custom-control-label" for="customSwitch5">Minimum Amount Limit</label>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     @if($action == 'Add')
                        <input type="text" name="min_amount" id="min_amount" class="form-control" disabled>
                     @elseif($action == 'Edit' && $offer->minimum_amount_limit == 'on')
                        <input type="text" name="min_amount" id="min_amount" class="form-control" value="{{$offer->min_amount}}">
                     @elseif($action == 'Edit' && $offer->minimum_amount_limit == '')
                        <input type="text" name="min_amount" id="min_amount" class="form-control" disabled value="{{$offer->min_amount}}">
                     @endif
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input" id="customSwitch6" name="maximum_discount_limit" {{$offer->maximum_discount_limit == 'on'  ? 'checked' : '' }}>
                           <label class="custom-control-label" for="customSwitch6">Maximum Discount Limit</label>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     @if($action == 'Add')
                        <input type="text" name="max_discount" id="max_discount" class="form-control" disabled>
                     @elseif($action == 'Edit' && $offer->maximum_discount_limit == 'on')
                        <input type="text" name="max_discount" id="max_discount" class="form-control" value="{{$offer->max_discount}}">
                     @elseif($action == 'Edit' && $offer->maximum_discount_limit == '')
                        <input type="text" name="max_discount" id="max_discount" class="form-control" disabled value="{{$offer->max_discount}}">
                     @endif
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input" id="customSwitch7" name="minimum_item_limit" {{$offer->minimum_item_limit == 'on'  ? 'checked' : '' }}>
                           <label class="custom-control-label" for="customSwitch7">Minimum Item Limit Cart</label>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     @if($action == 'Add')
                        <input type="text" name="min_limit" id="min_limit" class="form-control" disabled>
                     @elseif($action == 'Edit' && $offer->minimum_item_limit == 'on')
                        <input type="text" name="min_limit" id="min_limit" class="form-control" value="{{$offer->min_limit}}">
                     @elseif($action == 'Edit' && $offer->minimum_item_limit == '')
                        <input type="text" name="min_limit" id="min_limit" class="form-control" disabled>
                     @endif
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="form-group">
                        <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input" id="customSwitch8" name="date" {{$offer->date == 'on'  ? 'checked' : '' }}>
                           <label class="custom-control-label" for="customSwitch8">Date</label>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row date" style="display: none;">
                  <div class="col-lg-6">
                     <label>Start Date</label>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        @if($action == 'Add')
                           <input type="date" name="start_date" id="start_date" class="form-control">
                        @elseif($action == 'Edit' && $offer->date == 'on')
                           <input type="date" name="start_date" class="form-control" value="{{$offer->start_date}}">
                        @elseif($action == 'Edit' && $offer->date == '')
                           <input type="date" name="start_date" class="form-control" disabled>
                        @endif
                     </div>
                  </div>
               </div>
               <div class="row date" style="display: none;">
                  <div class="col-lg-6">
                     <label>End Date</label>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        @if($action == 'Add')
                           <input type="date" name="end_date" id="end_date" class="form-control">
                        @elseif($action == 'Edit' && $offer->date == 'on')
                           <input type="date" name="end_date" class="form-control" value="{{$offer->end_date}}">
                        @elseif($action == 'Edit' && $offer->date == '')
                           <input type="date" name="end_date" class="form-control" disabled>
                        @endif
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
         <div class="card">
            <div class="card-body p-3">
            
               <div class="form-group" id="show_recursion">
                  <label for="recursion_type" for="customSwitch9">Recursion Type</label>
                  <select class="form-control" name="recursion_type" id="recursion_type">
                    
                     <option value="no_recursion" {{$offer->recursion_type == 'no_recursion'  ? 'selected' : '' }}>No recursion </option>
                     <option value="monthly_recursion" {{$offer->recursion_type == 'monthly_recursion'  ? 'selected' : '' }}>Monthly Recursion</option>
                  </select> 
                  @if($errors->has('recursion_type'))
                     <div class="error_span help-text text-danger">{{ $errors->first('recursion_type') }}</div>
                  @endif               
               </div>
               <div class="form-group recursion">
                  <label for="start_time">Start Time</label>
                  <input type="time" name="start_time" class="form-control" placeholder="Start Time" value="{{$offer->start_time}}">
                  @if($errors->has('start_time'))
                     <div class="error_span help-text text-danger">{{ $errors->first('start_time') }}</div>
                  @endif
               </div>
               <div class="form-group recursion">
                  <label for="end_time">End Time</label>
                  <input type="time" name="end_time" class="form-control" placeholder="End Time" value="{{$offer->end_time}}">
                  @if($errors->has('end_time'))
                     <div class="error_span help-text text-danger">{{ $errors->first('end_time') }}</div>
                  @endif
               </div>
               <div class="form-group recursion">
                  <label for="week" >Week</label><br>
                  <input type="checkbox" name="weeks[]" value="1"> First Week<br>
                  <input type="checkbox" name="weeks[]" value="2"> Second Week<br>
                  <input type="checkbox" name="weeks[]" value="3"> Third Week<br>
                  <input type="checkbox" name="weeks[]" value="4"> Fourth Week<br>
                  <input type="checkbox" name="weeks[]" value="5"> Fifth Week<br>
               </div>
               <div class="form-group recursion"> 

                  <label for="day">Day</label>
                  <br>
                  <input type="checkbox" name="day[]" value="sunday" {{$offer->day == 'sunday'  ? 'selected' : '' }} > Sunday<br>
                  <input type="checkbox" name="day[]" value="monday" {{$offer->day == 'monday'  ? 'selected' : '' }}> Monday<br>
                  <input type="checkbox" name="day[]" value="tuesday" {{$offer->day == 'tuesday'  ? 'selected' : '' }}> Tuesday<br>
                  <input type="checkbox" name="day[]" value="wednesday" {{$offer->day == 'wednesday'  ? 'selected' : '' }}> Wednesday<br>
                  <input type="checkbox" name="day[]" value="thursday" {{$offer->day == 'thursday'  ? 'selected' : '' }}> Thursday<br>
                  <input type="checkbox" name="day[]" value="friday" {{$offer->day == 'friday'  ? 'selected' : '' }}> Friday<br>
                  <input type="checkbox" name="day[]" value="saturday" {{$offer->day == 'saturday'  ? 'selected' : '' }}> Saturday

                  @if($errors->has('day'))
                     <div class="error_span help-text text-danger">{{ $errors->first('day') }}</div>
                  @endif 
               </div>
            </div>
         </div>
      </div>

      <input type="hidden" id="check_date" value="{{$offer->date}}">
      <input type="checkbox" id="checkAll">Check All
      <input type="checkbox" class="coupon_for" name="coupon_for" id="check_coupon" value="{{$offer->coupon_for}}">

      <!-- Select all -->
      <script type="text/javascript">
         $(document).ready(function(){
         $("#checkAll").click(function () {
              $('input:checkbox').not(this).prop('checked', this.checked);
          });
         });
      </script>
      <!-- Select all -->

       <style type="text/css">

         #searchbar{
         margin-left: 15%;
         padding:15px;
         border-radius: 10px;
         }

         #list{
            font-size: 1.5em;
            margin-left: 90px;
         }

         .coupon_search{
         display: list-item;  
         }

      </style>

      <input id="searchbar" onkeyup="coupon_search_bar()" type="text"
      name="search" placeholder="Search Bar..">

      <script type="text/javascript">
         function coupon_search_bar() {
            let input = document.getElementById('searchbar').value
            input=input.toLowerCase();
            let x = document.getElementsByClassName('coupon_search');
            
            for (i = 0; i < x.length; i++) {
               if (!x[i].innerHTML.toLowerCase().includes(input)) {
                  x[i].style.display="none";
               }
               else {
                  x[i].style.display="list-item";           
               }
            }
         }
      </script>

      <input type="hidden" id="check_recursion" value="{{$offer->recursion_type}}">
      
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <div class="row">
                  <div class="form-group main">
                     @foreach($main_categories as $data)
                        <input type="checkbox" name="main_categories[]" value="{{$data->mc_id}}" {{ $offer->main_categories->contains($data->mc_id) ? 'checked' : '' }}> {{$data->mc_name}}
                     @endforeach
                  </div>
                  <div class="form-group stores">
                     @foreach($stores as $data)
                        <input type="checkbox" name="sellers[]" value="{{$data->sd_usid}}" {{ $offer->sellers->contains($data->sd_usid) ? 'checked' : '' }}> {{$data->sd_sname}}
                     @endforeach
                  </div>
                  <div class="form-group items">
                     @foreach($items as $data)
                        <input type="checkbox" name="products[]" value="{{$data->product_id}}" {{ $offer->products->contains($data->product_id) ? 'checked' : '' }}> {{$data->product_name}}
                     @endforeach
                  </div>
                  <div class="form-group sub_categories">
                     @foreach($sub_categories as $data)
                        <input type="checkbox" name="sub_categories[]" value="{{$data->cat_id}}" {{ $offer->sub_categories->contains($data->cat_id) ? 'checked' : '' }}> {{$data->cat_name}}
                     @endforeach
                  </div>
               </div>
            </div>
         </div>
      </div>

      <button type="submit" class="btn btn-gradient-primary mr-2" style="margin-left: 45%">Submit</button>
      </form>
   </div>
</div>
@endsection

<script src="{{asset('public/js/jquery.min.js')}}"></script>

<script type="text/javascript">

   $(document).ready(function(){

      if($('#check_date').val() != ''){
         $('.date').show()
      }else{
         $('.date').hide()
      }

      if($('#check_coupon').val() == ''){
         $('.main').hide()
         $('.stores').hide()
         $('.items').hide()
         $('.sub_categories').hide()
      }else if($('#check_coupon').val() == 'main_category'){
         $('.main').show()
         $('.stores').hide()
         $('.items').hide()
         $('.sub_categories').hide()
      }else if($('#check_coupon').val() == 'stores'){
         $('.main').hide()
         $('.stores').show()
         $('.items').hide()
         $('.sub_categories').hide()
      }else if($('#check_coupon').val() == 'items'){
         $('.main').hide()
         $('.stores').hide()
         $('.items').show()
         $('.sub_categories').hide()
      }else if($('#check_coupon').val() == 'product_sub_category'){
         $('.main').hide()
         $('.stores').hide()
         $('.items').hide()
         $('.sub_categories').show()
      }

      $("#customSwitch3").change(function(){
         if($('#customSwitch3').is(":checked")){
            $('#apply_completion').prop('disabled',false)
         }else{
            $('#apply_completion').prop('disabled',true)
         }
      });

      $("#customSwitch4").change(function(){
         if($('#customSwitch4').is(":checked")){
            $('#promo').prop('disabled',false)
         }else{
            $('#promo').prop('disabled',true)
         }
      });

      $("#customSwitch5").change(function(){
         if($('#customSwitch5').is(":checked")){
            $('#min_amount').prop('disabled',false)
         }else{
            $('#min_amount').prop('disabled',true)
         }
      });

      $("#customSwitch6").change(function(){
         if($('#customSwitch6').is(":checked")){
            $('#max_discount').prop('disabled',false)
         }else{
            $('#max_discount').prop('disabled',true)
         }
      });

      $("#customSwitch7").change(function(){
         if($('#customSwitch7').is(":checked")){
            $('#min_limit').prop('disabled',false)
         }else{
            $('#min_limit').prop('disabled',true)
         }
      });

      if($('#check_recursion').val() != ''){
         $('#show_recursion').show()
         $('.recursion').show()
      }else{
         $('#show_recursion').hide()
         $('.recursion').hide()
      }

      $("#customSwitch8").change(function(){
         if($('#customSwitch8').is(":checked")){
            $('.date').show()
            $('#show_recursion').show()
            $('.recursion').show()
         }else{
            $('.date').hide()
            $('#show_recursion').hide()
            $('.recursion').hide()
         }
      });

      $("#customSwitch10").change(function(){
         if($('#customSwitch10').is(":checked")){
            $('#user_limit').prop('disabled',false)
         }else{
            $('#user_limit').prop('disabled',true)
         }
      });

      $("#customSwitch12").change(function(){
         if($('#customSwitch12').is(":checked")){
            $('#coupon_order_value').prop('disabled',false)
         }else{
            $('#coupon_order_value').prop('disabled',true)
         }
      });

      $("#customSwitch13").change(function(){
         if($('#customSwitch13').is(":checked")){
            $('#coupon_redeem_value').prop('disabled',false)
         }else{
            $('#coupon_redeem_value').prop('disabled',true)
         }
      });

      $("#recursion_type").change(function(){
         $('.recursion').hide()
         if($('#recursion_type').val() == "no_recursion"){
            $('.recursion').hide()
         }else{
            $('.recursion').show()
         }
      });

      $("#coupon_for").change(function(){
         if($('#coupon_for').val() == 'main_category'){
            $('.main').show()
            $('.stores').hide()
            $('.items').hide()
            $('.sub_categories').hide()
         }else if($('#coupon_for').val() == 'stores'){
            $('.main').hide()
            $('.stores').show()
            $('.items').hide()
            $('.sub_categories').hide()
         }else if($('#coupon_for').val() == 'items'){
            $('.main').hide()
            $('.stores').hide()
            $('.items').show()
            $('.sub_categories').hide()
         }else if($('#coupon_for').val() == 'product_sub_category'){
            $('.main').hide()
            $('.stores').hide()
            $('.items').hide()
            $('.sub_categories').show()
         }else{
             $('.main').hide()
            $('.stores').hide()
            $('.items').hide()
            $('.sub_categories').hide()
         }
      });

   });
</script>