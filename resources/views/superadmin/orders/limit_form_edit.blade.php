<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script type="text/javascript" src="js/googlemap.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
  <meta charset="utf-8"> 

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
@section('title','Order Limit') 
@section('content')

  <div class="content-wrapper">
   
   <div class="page-header">
      <h3 class="page-title"> Order Limit </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Order Limit</li>
         </ol>
      </nav>
   </div>

   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body p-3">
  
            <form action="{{url('superadmin/save_orders_limit')}}" method="post">
               @csrf
               
               <div class="row">
                <div class="form-group">

                  <select class="form-control col-lg-6" id="customSwitch_city_area_zone">
                    <option>Select</option>
                    <option value="city">City</option>
                    <option value="area">Area</option>
                    <option value="zone">Zone</option>
                  </select>

                </div>
              </div>

              <div class="row">
               <div class="col-lg-12" id="city_order_limit">
                  <table class="table responsive">
                    <thead>
                      <tr>
                        <th>City</th>
                        <th></th>
                        <th>Order Limit</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($cities as $key => $city)
                      <tr>
                        <td><input type="text" name="form_data[{{$key}}][city]" class="form-control" value="{{$city->city_name}}" readonly></td>
                        <td>
                          <label class="switch">
                            <input type="checkbox" name="check" id="customSwitch{{$key}}" class="check">
                            <span class="slider round"></span>
                          </label>
                        </td>

                        <td><input type="text" name="form_data[{{$key}}][order_limit]" class="form-control order_limit" placeholder="Order Limit" disabled></td>
                        
                        
                        <td><input type="date" name="form_data[{{$key}}][start_date]" class="form-control start_date" disabled></td>
                        <td><input type="date" name="form_data[{{$key}}][end_date]" class="form-control end_date" disabled></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                 
                </div> 
              </div>

              <div class="row">
               <div class="col-lg-12" id="area_order_limit">
                  <table class="table responsive">
                    <thead>
                      <tr>
                        <th>Area</th>
                        <th></th>
                        <th>Order Limit</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($areas as $key => $area)
                      <tr>
                        <td><input type="text" name="form_data[{{$key}}][area]" class="form-control" value="{{$area->area_name}}" readonly></td>
                        <td>
                          <label class="switch">
                            <input type="checkbox" name="check" id="customSwitch{{$key}}" class="check">
                            <span class="slider round"></span>
                          </label>
                        </td>
                        <td><input type="text" name="form_data[{{$key}}][order_limit]" class="form-control order_limit" placeholder="Order Limit" disabled></td>
                        <td><input type="date" name="form_data[{{$key}}][start_date]" class="form-control start_date" disabled></td>
                        <td><input type="date" name="form_data[{{$key}}][end_date]" class="form-control end_date" disabled></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                 
                </div> 
              </div>

              <div class="row">
               <div class="col-lg-12" id="zone_order_limit">
                  <table class="table responsive">
                    <thead>
                      <tr>
                        <th>Zone</th>
                        <th></th>
                        <th>Order Limit</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($zones as $key => $zone)
                      <tr>
                        <td><input type="text" name="form_data[{{$key}}][zone]" class="form-control" value="{{$zone->zone_name}}" readonly></td>
                        <td>
                          <label class="switch">
                            <input type="checkbox" name="check" id="customSwitch{{$key}}" class="check">
                            <span class="slider round"></span>
                          </label>
                        </td>
                        <td><input type="text" name="form_data[{{$key}}][order_limit]" class="form-control order_limit" placeholder="Order Limit" disabled></td>
                        <td><input type="date" name="form_data[{{$key}}][start_date]" class="form-control start_date" disabled></td>
                        <td><input type="date" name="form_data[{{$key}}][end_date]" class="form-control end_date" disabled></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                 
                </div> 
              </div>

                <button type="submit" class="btn btn-gradient-primary mr-2 float-right">Submit</button>

            </form>            
             
            </div>
         </div>
      </div>

    </div>
  </div>
@endsection

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('public/js/jquery.min.js')}}"></script>
<script type="text/javascript">

  $(document).ready(function(){

    $('#city_order_limit').hide()
    $('#area_order_limit').hide()
    $('#zone_order_limit').hide()
    $("#customSwitch_city_area_zone").change(function(){
       if($("#customSwitch_city_area_zone").val() == "city"){
          $('#city_order_limit').show()
          $('#area_order_limit').hide()
          $('#zone_order_limit').hide()
       }else if($("#customSwitch_city_area_zone").val() == "area"){
          $('#city_order_limit').hide()
          $('#area_order_limit').show()
          $('#zone_order_limit').hide()
       }else if($("#customSwitch_city_area_zone").val() == "zone"){
          $('#city_order_limit').hide()
          $('#area_order_limit').hide()
          $('#zone_order_limit').show()
       }else{
          $('#city_order_limit').hide()
          $('#area_order_limit').hide()
          $('#zone_order_limit').hide()
       }
    });

    $("body").on("change",".check",function(){

        if($(this).is(":checked")){
          $(this).closest('td').siblings().find('.order_limit').prop("disabled", false);
          $(this).closest('td').siblings().find('.start_date').prop("disabled", false);
          $(this).closest('td').siblings().find('.end_date').prop("disabled", false);
        }else{
          $(this).closest('td').siblings().find('.order_limit').prop("disabled", true);
          $(this).closest('td').siblings().find('.start_date').prop("disabled", true);
          $(this).closest('td').siblings().find('.end_date').prop("disabled", true);
        }

    });

  });





  
  
</script>



