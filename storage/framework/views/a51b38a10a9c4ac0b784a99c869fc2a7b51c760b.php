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


<?php $__env->startSection('title','Delivery Settings'); ?> 
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> <?php echo e($action); ?> Setting </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e($action); ?> Setting</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Delivery Time Setting</h4>
               <form action="<?php echo e(route('saveDeliverySettings')); ?>" method="post">
                <?php echo csrf_field(); ?>
                  <input type="hidden" name="action" value="<?php echo e($action); ?>">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>On / Off</th>
                        <th>Opening Day</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Minutes</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if($action == 'Add'): ?>
                        <tr>
                          <td><input type="checkbox" class="custom-control-input" id="customSwitch1" name="form_data[0][on_off]">
                              <label class="custom-control-label" for="customSwitch1"></label>
                          </td>
                          <td><input type="text" name="form_data[0][opening_day]" id="monday_off1" class="form-control" value="Monday" readonly disabled></td>
                          <td><input type="time" name="form_data[0][start_time]" id="monday_off2" class="form-control" value="" disabled></td>
                          <td><input type="time" name="form_data[0][end_time]" id="monday_off3" class="form-control" value="" disabled></td>
                          <td><input type="text" name="form_data[0][minutes]" id="monday_off4" class="form-control" value="" disabled></td>
                        </tr>
                        <tr>
                          <td><input type="checkbox" class="custom-control-input" id="customSwitch2" name="form_data[0][on_off]">
                              <label class="custom-control-label" for="customSwitch2"></label>
                          </td>
                          <td><input type="text" name="form_data[1][opening_day]" id="tuesday_off1" class="form-control" value="Tuesday" readonly disabled></td>
                          <td><input type="time" name="form_data[1][start_time]" id="tuesday_off2" class="form-control" value="" disabled></td>
                          <td><input type="time" name="form_data[1][end_time]" id="tuesday_off3" class="form-control" value="" disabled></td>
                          <td><input type="text" name="form_data[1][minutes]" id="tuesday_off4" class="form-control" value="" disabled></td>
                        </tr>
                        <tr>
                          <td><input type="checkbox" class="custom-control-input" id="customSwitch3" name="form_data[0][on_off]">
                              <label class="custom-control-label" for="customSwitch3"></label>
                          </td>
                          <td><input type="text" name="form_data[2][opening_day]" id="wednesday_off1" class="form-control" value="Wednesday" readonly disabled></td>
                          <td><input type="time" name="form_data[2][start_time]" id="wednesday_off2" class="form-control" value="" disabled></td>
                          <td><input type="time" name="form_data[2][end_time]" id="wednesday_off3" class="form-control" value="" disabled></td>
                          <td><input type="text" name="form_data[2][minutes]" id="wednesday_off4" class="form-control" value="" disabled></td>
                        </tr>
                        <tr>
                          <td><input type="checkbox" class="custom-control-input" id="customSwitch4" name="form_data[0][on_off]">
                              <label class="custom-control-label" for="customSwitch4"></label>
                          </td>
                          <td><input type="text" name="form_data[3][opening_day]" id="thursday_off1" class="form-control" value="Thursday" readonly disabled></td>
                          <td><input type="time" name="form_data[3][start_time]" id="thursday_off2" class="form-control" value="" disabled></td>
                          <td><input type="time" name="form_data[3][end_time]" id="thursday_off3" class="form-control" value="" disabled></td>
                          <td><input type="text" name="form_data[3][minutes]" id="thursday_off4" class="form-control" value="" disabled></td>
                        </tr>
                        <tr>
                          <td><input type="checkbox" class="custom-control-input" id="customSwitch5" name="form_data[0][on_off]">
                              <label class="custom-control-label" for="customSwitch5"></label>
                          </td>
                          <td><input type="text" name="form_data[4][opening_day]" id="friday_off1" class="form-control" value="Friday" readonly disabled></td>
                          <td><input type="time" name="form_data[4][start_time]" id="friday_off2" class="form-control" value="" disabled></td>
                          <td><input type="time" name="form_data[4][end_time]" id="friday_off3" class="form-control" value="" disabled></td>
                          <td><input type="text" name="form_data[4][minutes]" id="friday_off4" class="form-control" value="" disabled></td>
                        </tr>
                        <tr>
                          <td><input type="checkbox" class="custom-control-input" id="customSwitch6" name="form_data[0][on_off]">
                              <label class="custom-control-label" for="customSwitch6"></label>
                          </td>
                          <td><input type="text" name="form_data[5][opening_day]" id="saturday_off1" class="form-control" value="Saturday" readonly disabled></td>
                          <td><input type="time" name="form_data[5][start_time]" id="saturday_off2" class="form-control" value="" disabled></td>
                          <td><input type="time" name="form_data[5][end_time]" id="saturday_off3" class="form-control" value="" disabled></td>
                          <td><input type="text" name="form_data[5][minutes]" id="saturday_off4" class="form-control" value="" disabled></td>
                        </tr>
                        <tr>
                          <td><input type="checkbox" class="custom-control-input" id="customSwitch7" name="form_data[0][on_off]">
                              <label class="custom-control-label" for="customSwitch7"></label>
                          </td>
                          <td><input type="text" name="form_data[6][opening_day]" id="sunday_off1" class="form-control" value="Sunday" readonly disabled></td>
                          <td><input type="time" name="form_data[6][start_time]" id="sunday_off2" class="form-control" value="" disabled></td>
                          <td><input type="time" name="form_data[6][end_time]" id="sunday_off3" class="form-control" value="" disabled></td>
                          <td><input type="text" name="form_data[6][minutes]" id="sunday_off4" class="form-control" value="" disabled></td>
                        </tr>
                        <?php elseif($action == 'Edit'): ?>
                          <?php $__currentLoopData = $setting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                            <td><input type="checkbox" class="custom-control-input" id="customSwitch8" name="form_data[<?php echo e($key); ?>][on_off]">
                              <label class="custom-control-label" for="customSwitch8"></label>
                          </td>
                            <td><input type="text" name="form_data[<?php echo e($key); ?>][opening_day]" class="form-control" value="<?php echo e($data->opening_day); ?>" id="edit1" readonly ></td>
                            <td><input type="time" name="form_data[<?php echo e($key); ?>][start_time]" class="form-control" value="<?php echo e($data->start_time); ?>" id="edit2" ></td>
                            <td><input type="time" name="form_data[<?php echo e($key); ?>][end_time]" id="edit3"  class="form-control" value="<?php echo e($data->end_time); ?>" ></td>
                            <td><input type="text" name="form_data[<?php echo e($key); ?>][minutes]" class="form-control" value="<?php echo e($data->minutes); ?>" id="edit4" ></td>
                          </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                  </table>
                  <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<?php $__env->stopSection(); ?>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo e(asset('public/js/jquery.min.js')); ?>"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $("#customSwitch1").change(function(){
         if($('#customSwitch1').is(":checked")){
            $('#monday_off1').prop('disabled',false)
            $('#monday_off2').prop('disabled',false)
            $('#monday_off3').prop('disabled',false)
            $('#monday_off4').prop('disabled',false)
         }else{
            $('#monday_off1').prop('disabled',true)
            $('#monday_off2').prop('disabled',true)
            $('#monday_off3').prop('disabled',true)
            $('#monday_off4').prop('disabled',true)
         }
      });

    $("#customSwitch2").change(function(){
         if($('#customSwitch2').is(":checked")){
            $('#tuesday_off1').prop('disabled',false)
            $('#tuesday_off2').prop('disabled',false)
            $('#tuesday_off3').prop('disabled',false)
            $('#tuesday_off4').prop('disabled',false)
         }else{
            $('#tuesday_off1').prop('disabled',true)
            $('#tuesday_off2').prop('disabled',true)
            $('#tuesday_off3').prop('disabled',true)
            $('#tuesday_off4').prop('disabled',true)
         }
      });

    $("#customSwitch3").change(function(){
         if($('#customSwitch3').is(":checked")){
            $('#wednesday_off1').prop('disabled',false)
            $('#wednesday_off2').prop('disabled',false)
            $('#wednesday_off3').prop('disabled',false)
            $('#wednesday_off4').prop('disabled',false)
         }else{
            $('#wednesday_off1').prop('disabled',true)
            $('#wednesday_off2').prop('disabled',true)
            $('#wednesday_off3').prop('disabled',true)
            $('#wednesday_off4').prop('disabled',true)
         }
      });

    $("#customSwitch4").change(function(){
         if($('#customSwitch4').is(":checked")){
            $('#thursday_off1').prop('disabled',false)
            $('#thursday_off2').prop('disabled',false)
            $('#thursday_off3').prop('disabled',false)
            $('#thursday_off4').prop('disabled',false)
         }else{
            $('#thursday_off1').prop('disabled',true)
            $('#thursday_off2').prop('disabled',true)
            $('#thursday_off3').prop('disabled',true)
            $('#thursday_off4').prop('disabled',true)
         }
      });

    $("#customSwitch5").change(function(){
         if($('#customSwitch5').is(":checked")){
            $('#friday_off1').prop('disabled',false)
            $('#friday_off2').prop('disabled',false)
            $('#friday_off3').prop('disabled',false)
            $('#friday_off4').prop('disabled',false)
         }else{
            $('#friday_off1').prop('disabled',true)
            $('#friday_off2').prop('disabled',true)
            $('#friday_off3').prop('disabled',true)
            $('#friday_off4').prop('disabled',true)
         }
      });

    $("#customSwitch6").change(function(){
         if($('#customSwitch6').is(":checked")){
            $('#saturday_off1').prop('disabled',false)
            $('#saturday_off2').prop('disabled',false)
            $('#saturday_off3').prop('disabled',false)
            $('#saturday_off4').prop('disabled',false)
         }else{
            $('#saturday_off1').prop('disabled',true)
            $('#saturday_off2').prop('disabled',true)
            $('#saturday_off3').prop('disabled',true)
            $('#saturday_off4').prop('disabled',true)
         }
      });

    $("#customSwitch7").change(function(){
         if($('#customSwitch7').is(":checked")){
            $('#sunday_off1').prop('disabled',false)
            $('#sunday_off2').prop('disabled',false)
            $('#sunday_off3').prop('disabled',false)
            $('#sunday_off4').prop('disabled',false)
         }else{
            $('#sunday_off1').prop('disabled',true)
            $('#sunday_off2').prop('disabled',true)
            $('#sunday_off3').prop('disabled',true)
            $('#sunday_off4').prop('disabled',true)
         }
      });

    $("#customSwitch8").change(function(){
         if($('#customSwitch8').is(":checked")){
            $('#edit1').prop('disabled',false)
            $('#edit2').prop('disabled',false)
            $('#edit3').prop('disabled',false)
            $('#edit4').prop('disabled',false)
         }else{
            $('#edit1').prop('disabled',true)
            $('#edit2').prop('disabled',true)
            $('#edit3').prop('disabled',true)
            $('#edit4').prop('disabled',true)
         }
      });


  });
</script>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Laravel\backendGrovery\resources\views/superadmin/deliverySettings/form.blade.php ENDPATH**/ ?>