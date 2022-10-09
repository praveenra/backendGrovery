
<?php $__env->startSection('title','Notifications'); ?> 
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Notifications </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Notifications </li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body table-responsive">
               
               <table class="table table-striped" id="notifications">
                <!-- <a href="javascript:" type="button" class="btn btn-primary" style="float: left;" onclick="location.href='<?php echo e(url('superadmin/notification_list')); ?>'">Export</a> -->
                <a href="javascript:;" type="button" class="btn btn-info" style="float: left; position: relative; left: 10px;" data-toggle="modal" data-target="#send">Send</a>
                  <thead>
                     <tr>
                        <th>S. No</th>
                        <th>Title</th>
                        <th>Message</th>
                        <th>User Type</th>
                     </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                        <td><?php echo e($key+1); ?></td>
                        <td><?php echo e($notification->title); ?></td>
                        <td><?php echo e($notification->message); ?></td>
                        <td><?php echo e($notification->members); ?></td>
                     </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<div id="send" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
              <form action="<?php echo e(route('sendNotification')); ?>" method="post" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Send Notification</h4>
                </div>
                <div class="modal-body">

                     <select name="members" id="cars">
                        <option value="all" name="members" for="members">All</option>
                        <option value="membership_users" name="members" for="members">Membership Users</option>
                        <option value="delivery_boy" name="members" for="members">Delivery Boy</option>
                      </select>

                    <input type="text" name="title" class="form-control" placeholder="Title"><br>
                    <input type="text" name="message" class="form-control" placeholder="Message"><br>
                    <input type="file" name="image" class="form-control" required="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" id="delete" class="btn btn-danger waves-effect remove-data-from-delete-form delete_data">Send</button>
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
        $('#notifications').DataTable({
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

      function filter(status = '') {
          $.ajax({
              url:"<?php echo e(url('superadmin/filter_measurement')); ?>",
              method:"GET",
              data:{
                status:status
              },
              success:function(data) {
                $('tbody').html(data);
              }
          })   
      }

      $('.filter').click(function() {
        var status = $('#status').val();
        filter(status);
      });
    });
</script>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Laravel\backendGrovery\resources\views/superadmin/notification/manage.blade.php ENDPATH**/ ?>