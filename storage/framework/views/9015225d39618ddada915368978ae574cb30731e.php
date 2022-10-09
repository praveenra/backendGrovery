
<?php $__env->startSection('title','Main Category'); ?> 
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Main Category </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Main Category</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Main Category</h4>
               <?php echo Form::model($senddata, ['method' => $method, 'route' => $route, 'enctype'=>'multipart/form-data']); ?>

                  <div class="form-group">
                     <label for="mc_name">Main Category Name</label>
                     <?php echo e(Form::text('mc_name', old('mc_name'), ['class' => 'form-control', 'placeholder' => 'Title'])); ?>

                     <?php if($errors->has('mc_name')): ?>
                     <div class="error_span help-text text-danger"><?php echo e($errors->first('mc_name')); ?></div>
                     <?php endif; ?>
                  </div>
                  <!--<div class="form-group">
                    <label for="">Seller</label>
                    <?php echo Form::select('mc_seller_id', (['' => '--Select a Seller--'] + $Seller), ($senddata->mc_seller_id) ? $senddata->mc_seller_id : null ,['class' => 'form-control','data-error' => 'Choose City']); ?>                    
                    <div class="help-block form-text with-errors form-control-feedback"></div>
                    <?php if( $errors->has('mc_seller_id') ): ?>
                    <div class="error_span help-text text-danger"> <?php echo e($errors->first('mc_seller_id')); ?></div>
                    <?php endif; ?>
                 </div> -->
				
				 <div class="form-group">
                    <label for="mc_commision">Category Image</label>
                    <input type="file" name="image" class="form-control" value="<?php echo e(old('image')); ?>" onchange="loadImage(this);">
                    <div style="margin-left:10px;"><br>
                        <img src="" id="img_preview">
                    </div>
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
                   
                    <?php if($senddata->mc_id!=""): ?>
                    <img src="<?php echo e(url('/admin/images/category/')); ?>/<?php echo e($senddata->image); ?>" alt="" class="img-thumbnail" height="100" width="100" id="preview"/>
				<a style="cursor:pointer" onclick="removeimg()" id="remove">Remove</a>
						<input type="hidden" name="findremove" id="findremove">
                     <?php endif; ?>  
                </div>
				 <div class="form-group">
                    <label for="mc_commision">Commission Percentage</label>
                    <?php echo e(Form::text('mc_commision', old('mc_commision'), ['class' => 'form-control', 'placeholder' => 'Title'])); ?>

                    <?php if($errors->has('mc_commision')): ?>
                    <div class="error_span help-text text-danger"><?php echo e($errors->first('mc_commision')); ?></div>
                    <?php endif; ?>
                 </div>

                 <div class="form-group">
                    <label for="first_name">Main Category Status</label>
                    <div class="radio-list">
                        <label>
                        <?php echo e(Form::radio('mc_status', 1)); ?> Active</label> <br/>
                        <label>
                        <?php echo e(Form::radio('mc_status', 0)); ?> In Active</label>
                     </div>
                 </div>




                  <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
function removeimg()
{
	document.getElementById("preview").style.display="none";
	document.getElementById("remove").style.display="none";
	document.getElementById("findremove").value="1";
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Laravel\backendGrovery\resources\views/superadmin/maincategory/addedit.blade.php ENDPATH**/ ?>