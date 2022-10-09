<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<script type="text/javascript" src="js/googlemap.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
<meta charset="utf-8"> 

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<style>

.row2{
  position: absolute;
  float: left;
  left: 55%;
  top: 100px;
}

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

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
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

.container{
      height: 450px;
    }
    
#map {
      width: 70%;
      height: 50%;
      border: 1px solid blue;
    }

</style>

@extends('layouts.admin')
@section('title','Delivery Fee') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title">Delivery Fee</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Delivery Fee</li>
         </ol>
      </nav>
   </div>

   <div class="w3-container">

   <form action="{{ url('superadmin/delivery_info_update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="hidden" value="{{$deliveryinfo->id}}" name="id">

    <div id="Service_data" class="w3-container delivery_info grid" style="float: left; left: 5%; width: 30%;">

    <div class="row" style="height: 700px;">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Delivery Info</h4>

                <div class="form-group">
                  <label for="city_name">Delivery Type</label>
                  <input type="text" name="delivery_type" class="form-control" value="Store" readonly>
                </div>
                
                <div class="form-group">
                  <label for="city_name">City Name</label>
                  <input type="text" name="city_name" value="{{ $deliveryinfo->city_name }}" class="form-control" placeholder="Title" >
                </div>

                <div class="form-group">
                  <label for="vehicle_name">Vehicle Name</label>
                  <input type="text" name="vehicle_name" value="{{ $deliveryinfo->vehicle_name }}" class="form-control" placeholder="Vehicle Name" >
                </div>

                <div class="form-group">
                  <label class="switch">
                    <input type="checkbox" name="buisness" {{'on' == $deliveryinfo->buisness ? 'checked' : ''}}>
                    <span class="slider round"></span>
                  </label><label for="buisness">Buisness</label>
                </div>

                <div class="form-group">
                  <label class="switch">
                    <input type="checkbox" name="use_distance_calculation" id="customSwitch" {{'on' == $deliveryinfo->use_distance_calculation ? 'checked' : ''}}>
                    <span class="slider round"></span>
                  </label><label for="use_distance_calculation">Use Distance Calculation</label>
                  <input type="hidden" id="dis_calc" value="{{$deliveryinfo->use_distance_calculation}}">
                </div>

                <div class="form-group">
                  <label for="profit_mode">Profit Mode</label>
                  <select type="text" name="profit_mode" class="form-control" value="{{ $deliveryinfo->profit_mode }}" placeholder="Profit Mode<">
                    <option value="absolute">Absolute</option>
                    <option value="percentage">Percentage</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="profit_value">Profit Value</label>
                  <input type="text" name="profit_value" class="form-control" value="{{ $deliveryinfo->profit_value }}" placeholder="Profit Value" >
                </div>

            </div>
         </div>
      </div>
   </div>
  </div>

  <div id="delivery_price_setting1"  class="w3-container delivery_info grid" style="float: left; left: 35%; width: 30%;">

    <div class="row" style="height: 700px;">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Delivery Price Setting(Km)</h4>

                <div class="form-group">
                  <label for="base_price_distance">Base Price Distance</label>
                  <input type="text" name="base_price_distance" value="{{ $deliveryinfo->base_price_distance }}"  class="form-control" placeholder="Base Price Distance">
                </div>

                <div class="form-group">
                  <label for="base_price">Base Price </label>
                  <input type="text" name="base_price" value="{{ $deliveryinfo->base_price }}"  class="form-control" placeholder="Base Price" >
                </div>

                <div class="form-group">
                  <label for="price_per_unit_distance"> Price Per Unit Distance</label>
                  <input type="text" name="price_per_unit_distance" value="{{ $deliveryinfo->price_per_unit_distance }}"  class="form-control" placeholder="Price Per Unit Distance">
                </div>

                <div class="form-group">
                  <label for="price_per_unit_time"> Price Per Unit Time</label>
                  <input type="text" name="price_per_unit_time" value="{{ $deliveryinfo->price_per_unit_time }}"  class="form-control" placeholder="Price Per Unit Time">
                </div>

                <div class="form-group">
                  <label for="service_tax">Service Tax</label>
                  <input type="text" name="service_tax" value="{{ $deliveryinfo->service_tax }}"  class="form-control" placeholder="Service Tax" >
                </div>

                <div class="form-group">
                  <label for="min_fare">Min Fare</label>
                  <input type="text" name="min_fare" value="{{ $deliveryinfo->min_fare }}"  class="form-control" placeholder="Min Fare" >
                </div>
               
            </div>
         </div>
      </div>
   </div>
  </div>

  <div id="delivery_price_setting2" class="w3-container delivery_info grid" style="float: left; left: 35%; width: 60%;" disabled >

     <div class="row" style="height: 700px;" >
       <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Delivery Price Setting(Km)</h4>

               <table class="table table-bordered table-striped" id="dynamicAddRemove">
                <button type="button" name="add" id="dynamic-ar" class="btn btn-sm btn-outline-primary" style="float: right;">+Add More+</button>
                <thead>
                    <th>From Distance</th>
                    <th>To Distance</th>
                    <th>Delivery Fee</th>
                    <th>Action</th>
                </thead>
                @foreach($delivery_fees as $key => $data)
                <tr>

                  <td>   
                    <input type="number" name="addMoreInputFields[{{$key}}][from_distance]"  placeholder="From Distance" class="form-control" value="{{$data->from_distance}}" >
                  </td>

                  <td>
                    <input type="number" name="addMoreInputFields[{{$key}}][to_distance]"  placeholder="To Distance" class="form-control" value="{{$data->to_distance}}" >
                  </td>

                  <td>
                    <input type="number" name="addMoreInputFields[{{$key}}][delivery_fee]" placeholder="Delivery Fee" class="form-control" value="{{$data->delivery_fee}}" >
                  </td>
                  <td><i class="fa fa-times btn_remove" name="remove" style="cursor: pointer; color: red; font-size: 20px;"></i></td>
                </tr>
                @endforeach

               </table>

            </div>
         </div>
       </div>
     </div>
    </div>













<div id="zone_price" class="w3-container delivery_info grid" style="float: left; left: 70%; width: 60%;">
    <div class="row" style="height: 700px;">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Zone Price</h4>

               <table class="table table-bordered table-striped" id="Zoneprice_AddRemove">
                 
                <thead>
                    <th>Select Zone1</th>
                    <th>Select Zone2</th>
                    <th>Amount</th>
                    <th>Action</th>
                </thead>

                <tr>
                  
                  <td>
                    <select type="text" name="addMoreInputFields[0][select_zone1]" value="{{ $deliveryinfo->select_zone1 }}" class="form-control" placeholder="Select Zone1">
                    @foreach($area as $area)
                    <option value="{{$area->area_name}}" {{$area->area_name == $deliveryinfo->select_zone1 ? 'selected' : ''}}>{{$area->area_name}}</option>
                    @endforeach
                  </td>


                  <td>
                    <select type="text" name="addMoreInputFields[0][select_zone2]" value="{{ $deliveryinfo->select_zone2 }}" class="form-control" placeholder="Select Zone2">
                    @foreach($area2 as $area)
                    <option value="{{$area->area_name}}" {{$area->area_name == $deliveryinfo->select_zone2 ? 'selected' : ''}}>{{$area->area_name}}</option>
                    @endforeach
                  </td>




                  <td>
                    <input type="text" name="addMoreInputFields[0][amount]" value="{{ $deliveryinfo->amount }}" class="form-control" placeholder="Amount">
                  </td>




                  <td><button type="button" name="add" id="addmore_zoneprice" class="btn btn-sm btn-outline-primary">+Add More+</button></td>

                </tr>


               </table>

                

            </div>
         </div>
      </div>
   </div>
  </div>

  <button type="submit" class="btn btn-gradient-primary mr-2 float-right">Submit</button>

  </form>
   
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<input type="hidden" name="count" id="count" value="{{$count}}">

<script type="text/javascript">
  $(document).ready(function(){
    var i = 0;
    $("#addmore_zoneprice").click(function () {
        ++i;
        $("#Zoneprice_AddRemove").append('<tr>                                                           <td> <select type="text" name="addMoreInputFields[' + i +'][select_zone1]" class="form-control" placeholder="Select Zone1"> @foreach($area2 as $area) <option value="{{$area->area_name}}">{{$area->area_name}} @endforeach</option> </td>                   <td> <select type="text" name="addMoreInputFields[' + i +'][select_zone2]" class="form-control" placeholder="Select Zone2"> @foreach($area2 as $area) <option value="{{$area->area_name}}">{{$area->area_name}} @endforeach </option> </td>                  <td> <input type="text" name="addMoreInputFields['+ i +'][amount]" class="form-control" placeholder="Amount"> </td>                                                                    <td><i class="fa fa-times btn_remove" name="remove" style="cursor: pointer; color: red; font-size: 20px;"></i></td></tr>'
            );
    });
   

    $(document).on('click', '.btn_remove', function(){  
        var remove = $(this).closest("tr").remove();   
    }); 

   });  
</script>


<script type="text/javascript">
  $(document).ready(function(){

    // var i = 0;

    var i = $("#count").val();

    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<tr> <td><input type="text" name="addMoreInputFields[' + i +'][from_distance]" placeholder="From Distance" class="form-control" /> </td> <td> <input type="text" name="addMoreInputFields[' + i +'][to_distance]" placeholder="To Distance" class="form-control" /> </td> <td> <input type="text" name="addMoreInputFields[' + i +'][delivery_fee]" placeholder="Delivery Fee" class="form-control" /> </td> <td><i class="fa fa-times btn_remove" name="remove" style="cursor: pointer; color: red; font-size: 20px;"></i></td></tr>'
            );
    });
    
    $(document).on('click', '.btn_remove', function(){  
        var remove = $(this).closest("tr").remove();   
    }); 

   });  
</script>


<script src="{{asset('public/js/jquery.min.js')}}"></script>
<script type="text/javascript">

  $(document).ready(function(){

    if($('#dis_calc').val() == 'on'){
        $('#delivery_price_setting1').hide()
        $('#delivery_price_setting2').show()
    }else{
        $('#delivery_price_setting1').show()
        $('#delivery_price_setting2').hide()
    }
    $("#customSwitch").change(function(){
         if($('#customSwitch').is(":checked")){
            $('#delivery_price_setting1').hide()
            $('#delivery_price_setting2').show()
         }else{
            $('#delivery_price_setting1').show()
            $('#delivery_price_setting2').hide()

         }
      });

    });
  
</script>