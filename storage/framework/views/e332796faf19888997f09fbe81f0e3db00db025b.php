
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<script type="text/javascript" src="js/googlemap.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkUOdZ5y7hMm0yrcCQoCvLwzdM6M8s5qk&libraries=drawing"></script>

<style>

html,
body,
#map-canvas {
  height: 100%;
  margin: 0px;
  padding: 0px
}

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



<?php $__env->startSection('title','City'); ?> 
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> City </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">City</li>
         </ol>
      </nav>
   </div>

   <div class="w3-container">
  

  <div class="w3-row">

    <a href="javascript:void(0)" onclick="openCity(event, 'Basic_details');">
      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding ">Basic Details</div>
    </a>

    <a href="javascript:void(0)" onclick="openCity(event, 'Delivery_area');">
      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Delivery Area</div>
    </a>

    <a href="javascript:void(0)" onclick="openCity(event, 'Zone');">
      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Zone</div>
    </a>

  </div>

  <div id="Basic_details" class="w3-container city grid" >

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">City</h4>


               <form action="<?php echo e(url('superadmin/city_update')); ?>" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <input type="hidden" value="<?php echo e($city->city_id); ?>" name="id">

                <div class="form-group">
                  <label for="city_name">City Name</label>
                  <input type="text" name="city_name" value="<?php echo e($city->city_name); ?>"  class="form-control" placeholder="City Name" style="width: 50%;">
                </div>


                <div class="form-group">
                  <label for="city_center_location" >City Center Location</label>
                  <div class="row">
                    <div class="col-lg-3">
                      <input type="text" class="form-control" placeholder="Latitude" name="lat" id="lat" value="<?php echo e($city->lat); ?>" >
                    </div>
                    <div class="col-lg-3">
                      <input type="text" class="form-control" placeholder="Longitude" name="long" id="long" value="<?php echo e($city->long); ?>" >
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="city_status">City Status:</label><br>
                    <input type="radio" id="active" name="city_status"  value="1" <?php echo e('1' == $city->city_status ? 'checked' : ''); ?>>
                    <label for="active">Active</label>
                    <input type="radio" id="inactive" name="city_status" value="0" <?php echo e('0' == $city->city_status ? 'checked' : ''); ?>>
                    <label for="inactive">Inactive</label><br>  
                </div>

                <div class="form-group">
                  <label class="switch" for="buisness_switch">
                    <input type="checkbox" id="buisness_switch" name="buisness"  <?php echo e('on' == $city->buisness ? 'checked' : ''); ?>>
                    <span class="slider round"></span>
                  </label><label for="buisness">Buisness</label>
                </div>

                <div class="form-group">
                  <label for="buisness_text"></label>
                  <input type="file" name="buisness_image" id="buisness_image1" value="<?php echo e($city->buisness_image); ?>" class="form-control" onchange="loadImage(this);" style="width: 50%;"disabled="">
                    <div style="margin-left:10px;"><br>
                        <img src="" id="img_preview">
                    </div>
                  <input type="text" name="buisness_text" id="buisness_text1" value="<?php echo e($city->buisness_text); ?>" class="form-control" style="width: 50%;"disabled="">
                  
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
                  <label class="switch">
                    <input type="checkbox"   name="promo_available" <?php echo e('on' == $city->promo_available ? 'checked' : ''); ?>>
                    <span class="slider round"></span>
                  </label><label for="promo_available">Promo Available</label>
                </div>

                <div class="row2">

                <div class="form-group">
                  <label for="payment_details">Payment Details</label>
                </div>

                 <div class="form-group">
                  <label class="switch">
                    <input type="checkbox" name="pay_by_cash" <?php echo e('on' == $city->pay_by_cash ? 'checked' : ''); ?>>
                    <span class="slider round"></span>
                  </label>
                  <label for="pay_by_cash">can user pay by cash?</label>
                </div>


                <div class="form-group">
                  <label class="switch">
                    <input type="checkbox"  name="other_payment_method" <?php echo e('on' == $city->other_payment_method ? 'checked' : ''); ?>>
                    <span class="slider round"></span>
                  </label>
                  <label for="other_payment_method">can user pay by other payment method?</label>
                </div>

                <div class="form-group">
                  <label class="switch">
                    <input type="checkbox"  name="wallet_in_cash" <?php echo e('on' == $city->wallet_in_cash ? 'checked' : ''); ?>>
                    <span class="slider round"></span>
                  </label>
                  <label for="wallet_in_cash">settled deliveryman wallet in cash payment</label>
                </div>

                <div class="form-group">
                  <label class="switch">
                    <input type="checkbox" name="wallet_in_other" <?php echo e('on' == $city->wallet_in_other ? 'checked' : ''); ?>>
                    <span class="slider round"></span>
                  </label>
                  <label for="wallet_in_other">settled deliveryman wallet in other payment</label>
                </div>

                <div class="form-group">
                  <label class="switch">
                    <input type="checkbox" name="received_cash_payment" <?php echo e('on' == $city->received_cash_payment ? 'checked' : ''); ?>>
                    <span class="slider round"></span>
                  </label>
                  <label for="received_cash_payment">check wallet amount to received cash payment</label>
                  
                </div>

                <div class="form-group">
                  <input type="text" value="<?php echo e($city->min_amount); ?>" name="min_amount">
                </div>

                </div>

            </div>
         </div>
      </div>
   </div>
  </div>

  <div id="Delivery_area" class="w3-container city grid" style="display:none">

    <br>
     <div class="mapform" >

      <div class="form-group">
        <label class="switch">
        <input type="checkbox" id="use_radius" name="use_radius"  <?php echo e('on' == $city->use_radius ? 'checked' : ''); ?>>
        <span class="slider round"></span>
        </label>
        <label for="wallet_in_other">Use Radius?</label>
      </div>
      

      <div class="form-group">
      <input type="text" name="radius" id="radius" value="<?php echo e($city->radius); ?>"  class="form-control" placeholder="Radius" disabled>
      </div>

      <div class="form-group">
      <input type="text" name="area" id="area" value="<?php echo e($city->area); ?>" class="form-control" placeholder="Area" disabled>
      </div>
      
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHrzCW9-HgQK4PIGv9V8kd5GyjZtB0iD8&callback=initMap&libraries=drawing" type="text/javascript"></script>
      <div id="area_map" style="height:400px; width: 955px; display: none;" class="my-3"></div>
        
    </div>
  </div>

  <div id="Zone" class="w3-container city grid" style="display:none">
    <br>
    <div class="form-group">

      

      <div class="form-group float-right">
         <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button> 
      </div>

      <div class="form-group">
        <label class="switch">
        <input type="checkbox" id="use_zone" name="zone" <?php echo e('on' == $city->zone ? 'checked' : ''); ?>>
        <span class="slider round"></span>
        </label>
        <label for="wallet_in_other">Zone Business</label>
        <input type="text" name="vertices" id="vertices" value="<?php echo e($city->vertices); ?>" class="form-control" readonly>
      </div>


      <div class="form-group">
      <input type="text" name="zone_name" id="zone" value="<?php echo e($city->zone_name); ?>" class="form-control" placeholder="Zone Name" disabled>
      </div>

      <div id="zone_map" style="height:400px; width: 800px; display: none;" class="my-3"></div>
        <script src="<?php echo e(asset('public/js/jquery.min.js')); ?>"></script>

        <script>

            $(document).ready(function(){
            
              $("#use_radius").change(function(){
                if($('#use_radius').is(":checked")){
                    $('#radius').prop('disabled',false)
                    $('#area_map').show()
                }else{
                    $('#radius').prop('disabled',true)
                    $('#area_map').hide()
                }
              });

              $("#use_radius").change(function(){
                if($('#use_radius').is(":checked")){
                    $('#area').prop('disabled',false)
                    $('#area').show()
                }else{
                    $('#area').prop('disabled',true)
                    $('#area').hide()
                }
              });

              $("#use_zone").change(function(){
                if($('#use_zone').is(":checked")){
                    $('#zone_map').show()
                    $('#vertices').show()
                }else{
                    $('#zone_map').hide()
                    $('#vertices').hide()
                }
              });

              $("#use_zone").change(function(){
                if($('#use_zone').is(":checked")){
                    $('#zone').prop('disabled',false)
                    $('#zone').show()
                }else{
                    $('#zone').prop('disabled',true)
                    $('#zone').hide()
                }
              });

              $("#radius").keyup(function(){
                  var rad = parseFloat($(this).val());
                  initMap(rad)
              });

              $("#radius").keypress(function (e) {
                  var keyCode = e.keyCode || e.which;
       
                  var regex = /^[0-9]+$/;
       
                  //Validate TextBox value against the Regex.
                  var isValid = regex.test(String.fromCharCode(keyCode));
                  return isValid;
                
              });


            });

            var map;
            var zone_map;
            function initMap(rad) {
                //Area 
                var latitude = parseFloat(11.0168);   //us lat 37.09024
                var longitude = parseFloat(76.9558);  //us lng -100.4179324
                var area_current_location = {lat: latitude, lng: longitude};
                var drawingManager;
                var iw = new google.maps.InfoWindow(); // Global declaration of the infowindow
                var markers = new Array();

                map = new google.maps.Map(document.getElementById('area_map'),{
                  zoom: 10,
                  center: area_current_location
                });

                var marker = new google.maps.Marker({
                    map: map,
                    position: area_current_location
                });

                var sunCircle = {
                    strokeColor: "#c3fc49",
                    strokeOpacity: 1,
                    strokeWeight: 2,
                    fillColor: "#c3fc49",
                    fillOpacity: 0.35,
                    map: map,
                    center: area_current_location,
                    radius: rad // in meters
                };

                cityCircle = new google.maps.Circle(sunCircle);
                cityCircle.bindTo('center', marker, 'position');

                //Area End

                //Zone

                zone_map = new google.maps.Map(document.getElementById('zone_map'),{
                  zoom: 10,
                  center: area_current_location
                });

                drawingManager = new google.maps.drawing.DrawingManager({
                  drawingMode: google.maps.drawing.OverlayType.POLYGON,
                  drawingControl: true,
                  drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: [
                      google.maps.drawing.OverlayType.POLYGON
                    ],
                  },
                  polygonOptions: {
                    editable: true
                  }
                });
                
                drawingManager.setMap(zone_map);


                google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
                  var newShape = event.overlay;
                  newShape.type = event.type;
                });

                google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
                  overlayClickListener(event.overlay);
                  $('#vertices').val(event.overlay.getPath().getArray());
                });

            

            }

            function overlayClickListener(overlay) {
              google.maps.event.addListener(overlay, "mouseup", function(event) {
                $('#vertices').val(overlay.getPath().getArray());
              });
            }
                //Zone End

            google.maps.event.addDomListener(window, 'load', initMap);

        </script>



    </div>
</form>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo e(asset('public/js/jquery.min.js')); ?>"></script>

<script type="text/javascript">
  $(document).ready(function(){
          
    $("#buisness_switch").change(function(){
         if($('#buisness_switch').is(":checked")){
            $('#buisness_text1').prop('disabled',true)
            $('#buisness_image1').prop('disabled',true)
         }else{
            $('#buisness_text1').prop('disabled',false)
            $('#buisness_image1').prop('disabled',false)          
         }
      });
    });
</script>

<script>
function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-border-red";
}
</script>


<!-- NEXT PREV -->
<script type="text/javascript">
  var visibleDiv = 0;
  function showDiv()
  {
    $(".grid").hide();
    $(".grid:eq("+ visibleDiv +")").show();
  }
  showDiv()

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\Laravel\backendGrovery\resources\views/superadmin/city/edit.blade.php ENDPATH**/ ?>