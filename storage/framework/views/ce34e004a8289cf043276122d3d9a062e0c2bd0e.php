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



<?php $__env->startSection('title','Banner'); ?> 
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Banner </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Banner</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Banner</h4>
               <?php echo Form::model($slider, ['method' => $method, 'route' => $route, 'enctype'=>'multipart/form-data']); ?>

                  <div class="form-group">
                     <label for="first_name">Banner Name</label>
                     <?php echo e(Form::text('banner_name', old('banner_name'), ['class' => 'form-control', 'placeholder' => 'Title'])); ?>

                     <?php if($errors->has('banner_name')): ?>
                     <div class="error_span help-text text-danger"><?php echo e($errors->first('banner_name')); ?></div>
                     <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <label>Current Image</label>
                    <?php if($slider->SliderImage()): ?>
                    <img src="<?php echo e($slider->SliderImage()); ?>" alt="" class="img-thumbnail"/>
                     <?php endif; ?>  
                </div>
                  <div class="form-group">
                    <label for="first_name">Banner Image</label>
                    <input type="file" name="banner_image" class="form-control" value="<?php echo e(old('banner_image')); ?>" onchange="loadImage(this);">
                    <div style="margin-left:10px;"><br>
                        <img src="" id="img_preview">
                    </div>

                     


                    <?php if($errors->has('banner_image')): ?>
                    <div class="error_span help-text text-danger"><?php echo e($errors->first('banner_image')); ?></div>
                    <?php endif; ?>
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
                    <input type="checkbox" name="default_image" value="default" id="customSwitch">
                    <span class="slider round"></span>
                  </label><label for="default_image">Default Banner</label>
                </div> 

                  <div id="banner_switch">
                 <div class="form-group" >
                    <label for="first_name">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="<?php echo e(old('start_date')); ?><?php echo e($slider->start_date); ?>">
                    <?php if($errors->has('start_date')): ?>
                    <div class="error_span help-text text-danger"><?php echo e($errors->first('start_date')); ?></div>
                    <?php endif; ?>
                 </div>
                 <div class="form-group">
                    <label for="first_name">End Date</label>
                    <input type="date" name="end_date" class="form-control" value="<?php echo e(old('end_date')); ?><?php echo e($slider->end_date); ?>">
                    <?php if($errors->has('end_date')): ?>
                    <div class="error_span help-text text-danger"><?php echo e($errors->first('end_date')); ?></div>
                    <?php endif; ?>
                 </div>
                 </div>
                 <div class="form-group">
                    <label for="first_name">Banner Status</label>
                    <div class="radio-list">
                        <label>
                        <?php echo e(Form::radio('banner_status', 1)); ?> Active</label> <br/>
                        <label>
                        <?php echo e(Form::radio('banner_status', 0)); ?> In Active</label>
                     </div>
                 </div>
                  <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>


<script src="<?php echo e(asset('public/js/jquery.min.js')); ?>"></script>
<script type="text/javascript">

$(document).ready(function(){
 $('#banner_switch').show()
    $("#customSwitch").change(function(){
         if($('#customSwitch').is(":checked")){
            $('#banner_switch').hide()
         }else{       
            $('#banner_switch').show()

         }
      });

    });
  
</script>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Laravel\backendGrovery\resources\views/superadmin/banner/addedit.blade.php ENDPATH**/ ?>