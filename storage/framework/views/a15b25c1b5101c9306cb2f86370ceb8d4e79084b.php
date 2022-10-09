
<?php $__env->startSection('title','Admin'); ?> 
<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> <?php echo e($page_details['page_name']); ?></h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e($page_details['page_name']); ?> </li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        
         <div class="card">
            <div class="card-body table-responsive">
              <table class="table table-striped" id="admin">
                <a href="<?php echo e(url('superadmin/admindata/create')); ?>" type="button" class="btn btn-info" style="float: left;">Add New</a>
                  <thead>
                     <tr>
                        <th>S. No</th>
                        <th>Admin Id</th>
                        <th>Admin Name</th>
                        <th>Admin MobileNo</th>
                        <th>Admin EmailId</th>
                        <th>Admin Status</th>
                        <th>Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $__empty_1 = true; $__currentLoopData = $senddata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                     <tr>
                        <td><?php echo e($key+1); ?></td>
                        <td><?php echo e($data->user_id); ?></td>
                        <td><?php echo e($data->first_name); ?></td>
                        <td><?php echo e($data->mobile_number); ?></td>
                        <td><?php echo e($data->email); ?></td>
                        <?php if($data->user_status == 1): ?>
                        <td><a href="javascript:" class="badge badge-success active" data-id='<?php echo e($data->id); ?>' style="cursor: pointer;">Active</a></td>
                        <?php else: ?>
                        <td><a href="javascript:" class="badge badge-danger inactive" data-id='<?php echo e($data->id); ?>' style="cursor: pointer;">Inactive</a></td>
                        <?php endif; ?>
                        <td >
                           <a href="<?php echo e(url($edit).'/'.$data->id.'/edit'); ?>"><img src="<?php echo e(asset('public/edit.svg')); ?>"></a>&nbsp;
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

<div id="delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
             <form action="<?php echo e(route('deleteAdmin')); ?>" method="post">
               <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Delete Admin</h4>
                </div>
                <div class="modal-body">
                    <h4>You Want You Sure Delete This Record?</h4>
                    <input type="hidden" name="delete_id" id="delete_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" id="delete" class="btn btn-danger waves-effect remove-data-from-delete-form delete_data">Delete</button>
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
      $('#delete_id').val(id); 
    });

    $(".active").click(function(){
      var id = $(this).attr('data-id');
      $.ajax({
        type:"GET",
        url:"<?php echo e(route('inactiveData')); ?>?id="+id,
        success:function(res){
          window.location.reload();
        }
      });
    });

    $(".inactive").click(function(){
      var id = $(this).attr('data-id');
      $.ajax({
        type:"GET",
        url:"<?php echo e(route('activeData')); ?>?id="+id,
        success:function(res){
          window.location.reload();
        }
      });
    });

  });

   $(function () {
    $.noConflict();
        $('#admin').DataTable({
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Laravel\backendGrovery\resources\views/superadmin/admin/manage.blade.php ENDPATH**/ ?>