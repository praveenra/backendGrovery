
<?php $__env->startSection('title','Sub Category'); ?> 
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Sub Category </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sub Category</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Sub Category</h4>
               <?php echo Form::model($slider, ['method' => $method, 'route' => $route, 'enctype'=>'multipart/form-data']); ?>

               <div class="form-group">
                     <label for="">Category</label>
                     <?php echo Form::select('cat_is_parent_id', (['' => '--Select a Category--'] + $category), ($slider->cat_is_parent_id) ? $slider->cat_is_parent_id : null ,['class' => 'form-control','data-error' => 'Choose category']); ?>                    
                     <div class="help-block form-text with-errors form-control-feedback"></div>
                     <?php if( $errors->has('cat_is_parent_id') ): ?>
                     <div class="error_span help-text text-danger"> <?php echo e($errors->first('cat_is_parent_id')); ?></div>
                     <?php endif; ?>
                  </div>
                  
                  <div class="form-group">
                     <label for="first_name">Sub Category Name</label>
                     <?php echo e(Form::text('cat_name', old('cat_name'), ['class' => 'form-control', 'placeholder' => 'Category Name'])); ?>

                     <?php if($errors->has('cat_name')): ?>
                     <div class="error_span help-text text-danger"><?php echo e($errors->first('cat_name')); ?></div>
                     <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <label>Current Image</label>
                    <?php if($slider->SliderImage()): ?>
                    <img src="<?php echo e($slider->SliderImage()); ?>" alt="" class="img-thumbnail"/>
                     <?php endif; ?>  
                </div>
                  <div class="form-group">
                    <label for="first_name">Sub Category Image</label>
                    <input type="file" name="cat_image" class="form-control" value="<?php echo e(old('cat_image')); ?>" onchange="loadImage(this);">
                    <div style="margin-left:10px;"><br>
                        <img src="" id="img_preview">
                    </div>
                    <?php if($errors->has('cat_image')): ?>
                    <div class="error_span help-text text-danger"><?php echo e($errors->first('cat_image')); ?></div>
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
                    <label for="first_name">Sub Category Status</label>
                    <div class="radio-list">
                        <label>
                        <?php echo e(Form::radio('cat_status', 1)); ?> Active</label> <br/>
                        <label>
                        <?php echo e(Form::radio('cat_status', 0)); ?> In Active</label>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Laravel\backendGrovery\resources\views/superadmin/subcategory/addedit.blade.php ENDPATH**/ ?>