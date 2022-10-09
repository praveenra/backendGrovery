
<?php $__env->startSection('title','Product'); ?> 
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
               <table class="table table-striped" id="product">
                <a href="javascript:" type="button" class="btn btn-primary" style="float: left;" data-toggle="modal" data-target="#filter">Filter</a>
                <a href="<?php echo e(url('superadmin/products/create')); ?>" type="button" class="btn btn-info" style="float: left; position: relative; left: 10px;">Add New</a>
                <a href="<?php echo e(url('superadmin/products/uploadview')); ?>" type="button" class="btn btn-warning" style="float: left; position: relative; left: 20px;">Upload</a>
                  <thead>
                     <tr>
                        <th>S. No</th>
                        <th>Product Name</th>
                        <th>Category Name</th>
                        <!--<th>Product Stock</th>-->
                        <!-- <th>Product Price</th> -->
                        <!-- <th>Product Sales Price</th> -->
                        <th>Store Name</th>
                        <th>Product Status</th>
                        <th>Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $__empty_1 = true; $__currentLoopData = $senddata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                     <tr>
                        <td><?php echo e($key+1); ?></td>
                        <td><?php echo e($data->product_name); ?></td>
                        <td><?php echo e($data->product_category->cat_name); ?></td>
                        <!--<td><?php echo e($data->product_stock); ?></td>-->
                        <!-- <td><?php echo e($data->product_price); ?></td> -->
                        <!-- <td><?php echo e($data->product_sales_price); ?></td> -->
                        <td><?php echo e($data->sd_sname); ?></td>
                        <?php if($data->product_status == 1): ?>
                        <td><a href="javascript:" class="badge badge-success active" data-id='<?php echo e($data->product_id); ?>' style="cursor: pointer;">Active</a></td>
                        <?php else: ?>
                        <td><a href="javascript:" class="badge badge-danger inactive" data-id='<?php echo e($data->product_id); ?>' style="cursor: pointer;">Inactive</a></td>
                        <?php endif; ?>
                        <td>

                           <a href="<?php echo e(url($edit).'/'.$data->product_id.'/edit'); ?>"><img src="<?php echo e(asset('public/edit.svg')); ?>"></a>&nbsp;
                           <a class="delete" href="javascript:;" data-toggle="modal" data-id='<?php echo e($data->product_id); ?>' data-target="#delete"><img src="<?php echo e(asset('public/delete.svg')); ?>"></a> 
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
              <form action="<?php echo e(route('deleteProduct')); ?>" method="post">
              <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Delete Product</h4>
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
                    <label><strong>Category</strong></label>
                    <select id="category" name="category" class="form-control">
                      <option value="">--Select Category--</option>
                      <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($data->cat_id); ?>"><?php echo e($data->cat_name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div><br>

                  <div class="form-group">
                     <label><strong>Sub Category</strong></label>
                     <select id="sub_category" name="sub_category_id" class="form-control">
                       <option value="">--Select Sub Category--</option>
                        <?php $__currentLoopData = $subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($subcategory->cat_id); ?>" <?php echo e($subcategory->cat_id == $data->sub_category_id ? 'selected' : ''); ?>><?php echo e($subcategory->cat_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       
                     </select>
                  </div><br>


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

    $(".active").click(function(){
      var id = $(this).attr('data-id');
      $.ajax({
        type:"GET",
        url:"<?php echo e(route('inactiveProducts')); ?>?id="+id,
        success:function(res){
          window.location.reload();
        }
      });
    });

    $(".inactive").click(function(){
      var id = $(this).attr('data-id');
      $.ajax({
        type:"GET",
        url:"<?php echo e(route('activeProducts')); ?>?id="+id,
        success:function(res){
          window.location.reload();
        }
      });
    });

  });

   $(function () {
    $.noConflict();
        $('#product').DataTable({
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

      function filter(status = '', category='', subcategory='') {
          $.ajax({
              url:"<?php echo e(url('superadmin/filter_products')); ?>",
              method:"GET",
              data:{
                status:status, category:category, subcategory:subcategory
              },
              success:function(data) {
                $('tbody').html(data);
              }
          })   
      }

      $('.filter').click(function() {
        var status = $('#status').val();
        var category = $('#category').val();
        var subcategory = $('#subcategory').val();
        filter(status,category,subcategory);
      });
    });
</script>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\Laravel\backendGrovery\resources\views/superadmin/product/manage.blade.php ENDPATH**/ ?>