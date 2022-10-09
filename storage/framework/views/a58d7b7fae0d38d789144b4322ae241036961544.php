
<?php $__env->startSection('title','Product Reviews'); ?> 
<?php $__env->startSection('content'); ?>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
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
          <a href="javascript:" type="button" class="btn btn-danger pull-right" style="float: right;" onclick="changeAllStatus()">Approve and Publish All</a>
               <table class="table table-striped" id="product_reviews">
                  <thead>
                     <tr>
                        <th>S.No</th>
                        <th>Product</th>
                        <th>Store</th>
                        <th>Customer</th>
                        <th>Review</th>
                        <th>Rating</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                     <tr>
                        <td><?php echo e($key+1); ?></td>
                        <td><?php echo e($data->product_name); ?></td>
                        <td><?php echo e($data->sd_sname); ?></td>
                        <td><?php echo e($data->customer); ?></td>
                        <td><?php echo e($data->review); ?></td>
                        <td><?php echo e($data->rating); ?>&nbsp;<i class="fa fa-star" style="color:orange;font-size: 14px;"></i></td>
                        <td> 
                          <select class="form-control" id="<?php echo e($data->id); ?>" onchange="changestatus('<?php echo e($data->id); ?>')">
                              <option value="1">Approve & Publish</option>
                              <option value="2">Reject & Hide</option>
                          </select>

                          <script>
                              $("#<?php echo e($data->id); ?>").val("<?php echo e($data->status); ?>");
                              function changestatus(id){
                          
                                  var status= $("#"+id).val();
                           
                                  $.ajax({
                                      type:"GET",
                                      url:"<?php echo e(url('superadmin/change_product_review_status')); ?>?id="+id+"&status="+status,
                                      success:function(res){}
                                  });     
                              }

                              function changeAllStatus(id){
                          
                                  $.ajax({
                                      type:"GET",
                                      url:"<?php echo e(url('superadmin/change_all_product_review_status')); ?>",
                                      success:function(res){
                                        window.location.reload();
                                      }
                                  });     
                              }
                         </script></td>
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

<?php $__env->stopSection(); ?>

<script src="<?php echo e(asset('public/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script type="text/javascript">
  
   $(function () {
    $.noConflict();
        $('#product_reviews').DataTable({
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Laravel\backendGrovery\resources\views/superadmin/reviews/product_reviews.blade.php ENDPATH**/ ?>