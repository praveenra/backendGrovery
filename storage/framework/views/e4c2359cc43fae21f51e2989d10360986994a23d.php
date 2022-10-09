
<?php $__env->startSection('title','Delivery Fee'); ?> 
<?php $__env->startSection('content'); ?>
<style type="text/css">
  
  .on{
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: green;
  }
  .off{
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: red;
  } 
</style>
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Delivery Fee</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Delivery Fee </li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body table-responsive">
               <table class="table table-striped" id="delivery_info">
                <!-- <a href="javascript:" type="button" class="btn btn-primary" style="float: left;" data-toggle="modal" data-target="#filter">Filter</a> -->
                <a href="<?php echo e(url('superadmin/delivery_info')); ?>" type="button" class="btn btn-info" style="float: left;">Add New</a>
                  <thead>
                     <tr>
                        <th>S.No</th>
                        <th>Delivery Type</th>
                        <th>City</th>
                        <th>Vehicle</th>
                        <th>Business</th>
                        <th>Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $__empty_1 = true; $__currentLoopData = $senddata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                     <tr>
                        <td><?php echo e($key+1); ?></td>
                        <td><?php echo e($slider->delivery_type); ?></td>
                        <td><?php echo e($slider->city_name); ?></td>
                        <td><?php echo e($slider->vehicle_name); ?></td>
                        <?php if($slider->buisness == "on"): ?>
                          <td><div class="on"></div></td>
                        <?php else: ?>
                          <td><div class="off"></td>
                        <?php endif; ?>
                        <td>

                            <a href="<?php echo e(url('superadmin/delivery_info_edit')); ?>/<?php echo e($slider->id); ?>"><img src="<?php echo e(asset('public/edit.svg')); ?>"></a>&nbsp;
                           <a class="delete" href="javascript:;" data-toggle="modal" data-id='<?php echo e($slider->id); ?>' data-target="#delete"><img src="<?php echo e(asset('public/delete.svg')); ?>"></a> 
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
              <form action="<?php echo e(route('deleteDeliveryInfo')); ?>" method="post">
              <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Delete</h4>
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

<div id="filter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Filter</h4>
                </div>
                <div class="modal-body">
                  <div class="col-lg-12">
                    <label><strong>Status</strong></label>
                      <select id='status' name="status" class="form-control" style="width: 100%;">
                        <option value="">--Select Status--</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
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

  });

   $(function () {
    $.noConflict();
        $('#delivery_info').DataTable({
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
              url:"<?php echo e(url('superadmin/filter_delivery_info')); ?>",
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ubuntu/Documents/mahe/latestcodeteam/GroveryVThree/Grovery/resources/views/superadmin/delivery_info/manage.blade.php ENDPATH**/ ?>