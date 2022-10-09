
<?php $__env->startSection('title','Log History'); ?> 
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Log History</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Log History </li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        
         <div class="card">
            <div class="card-body table-responsive">
               <table class="table table-striped" id="log_history">
                  <a href="javascript:" type="button" class="btn btn-warning" style="float: left;" data-toggle="modal" data-target="#export">Export</a> &nbsp;
                  <a href="javascript:" type="button" class="btn btn-primary" style="float: left; position: relative; left: 20px;" data-toggle="modal" data-target="#filter">Filter</a>
                  <thead>
                     <tr>
                        <th>S.No</th>
                        <th>User</th>
                        <th>User Type</th>
                        <th>Module</th>
                        <th>Activity</th>
                        <th>Date and Time</th>
                     </tr>
                  </thead>
                  <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $activity_logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                      <td><?php echo e($key+1); ?></td>
                      <td><?php echo e($data->first_name); ?></td>
                      <td><?php echo e($data->user_type_name); ?></td>
                      <td><?php echo e($data->module); ?></td>
                      <td><?php echo e($data->activity); ?></td>
                      <td><?php echo e($data->created_at); ?></td>
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


<div id="export" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Export</h4>
                </div>
                <form action="<?php echo e(url('superadmin/export_log')); ?>" method="get">
                <div class="modal-body">
                  <div class="col-lg-12">
                    <label><strong>User Type</strong></label>
                      <select id='export_user_type' name="export_user_type" class="form-control" style="width: 100%;">
                        <option value="">All</option>
                        <option value="Admin">Admin</option>
                        <option value="Seller">Seller</option>
                      </select>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" id="export" class="btn btn-danger waves-effect remove-data-from-delete-form export">Export</button>
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

   $(function () {
    $.noConflict();
        $('#log_history').DataTable({
            "pageLength": 10,
            "bSort": true,
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true,
        });        
    });

   $(document).ready(function(){

      function filter(user_type = '') {
          $.ajax({
              url:"<?php echo e(url('superadmin/filter_log')); ?>",
              method:"GET",
              data:{
                user_type:user_type
              },
              success:function(data) {
                $('tbody').html(data);
              }
          })   
      }

      $('.filter').click(function() {
        var user_type = $('#user_type').val();
        filter(user_type);
      });
    });


</script>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Laravel\backendGrovery\resources\views/superadmin/log_history/list.blade.php ENDPATH**/ ?>