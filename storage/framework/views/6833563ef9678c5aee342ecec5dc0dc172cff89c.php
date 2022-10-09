
<?php $__env->startSection('title','Delivery Settings'); ?> 
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title">Delivery Settings</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Delivery Settings</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        
         <div class="card">
            <div class="card-body table-responsive">
               <table class="table table-striped" id="delivery_settings">
                  <!-- <a href="javascript:" type="button" class="btn btn-warning" style="float: left;" data-toggle="modal" data-target="#export">Export</a> &nbsp;
                  <a href="javascript:" type="button" class="btn btn-primary" style="float: left; position: relative; left: 20px;" data-toggle="modal" data-target="#filter">Filter</a> -->
                  <?php if($count == 0): ?>
                  <a href="<?php echo e(url('superadmin/delivery_settings_form')); ?>" type="button" class="btn btn-info" style="float: left;">Add New</a>
                  <?php endif; ?>
                  <thead>
                     <tr>
                        <th>S.No</th>
                        <th>Opening Day</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                      <tr>
                        <td><?php echo e($key+1); ?></td>
                        <td><?php echo e($data->opening_day); ?></td>
                        <td><?php echo e($data->start_time); ?></td>
                        <td><?php echo e($data->end_time); ?></td>
                        <td>
                          <a href="<?php echo e(url('superadmin/delivery_settings_form')); ?>/<?php echo e($data->id); ?>"><img src="<?php echo e(asset('public/edit.svg')); ?>"></a>&nbsp;
                          <a class="delete" href="javascript:;" data-toggle="modal" data-id='<?php echo e($data->id); ?>' data-target="#delete"><img src="<?php echo e(asset('public/delete.svg')); ?>"></a>
                        </td>
                      </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                      <tr>
                        <td colspan="7" class="text-center">
                          <?php echo e($message); ?>

                        </td>
                      <tr>
                    <?php endif; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<div id="filter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Filter</h4>
                </div>
                <div class="modal-body">
                  <div class="col-lg-12">
                    <label><strong>User Type</strong></label>
                      <select id='user_type' name="user_type" class="form-control" style="width: 100%;">
                        <option value="">--Select User Type--</option>
                        <option value="Admin">Admin</option>
                        <option value="Seller">Seller</option>
                      </select>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" id="filter" class="btn btn-danger waves-effect remove-data-from-delete-form filter" data-dismiss="modal">Filter</button>
                </div>
        </div>
    </div>
</div>

<div id="delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Delete Setting</h4>
                </div>
                <form action="<?php echo e(url('superadmin/delivery_settings_delete')); ?>" method="post">
                  <?php echo csrf_field(); ?>
                <div class="modal-body">
                  <input type="hidden" name="id" id="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" id="export" class="btn btn-danger waves-effect remove-data-from-delete-form export">Delete</button>
                </div>
              </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<script src="<?php echo e(asset('public/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script type="text/javascript">


    $(document).ready(function(){
      $(".delete").click(function(){
        var id = $(this).attr('data-id');
        $('#id').val(id); 
      });
    });

   $(function () {
    $.noConflict();
        $('#delivery_settings').DataTable({
            "pageLength": 10,
            "bSort": true,
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true,
        });        
    });

</script>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Laravel\backendGrovery\resources\views/superadmin/deliverySettings/list.blade.php ENDPATH**/ ?>