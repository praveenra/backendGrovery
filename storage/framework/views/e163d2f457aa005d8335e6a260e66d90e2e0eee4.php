<?php $__env->startSection('title','Product'); ?>
<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="//unpkg.com/alpinejs" defer></script>
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Product </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Product</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Product</h4>
                        <?php echo Form::model($senddata, ['method' => $method, 'route' => $route, 'enctype'=>'multipart/form-data']); ?>

                        <div class="form-group">
                            <label for="first_name">Product Name</label>
                            <?php echo e(Form::text('product_name', old('product_name'), ['class' => 'form-control', 'placeholder' => 'Product Name'])); ?>

                            <?php if($errors->has('product_name')): ?>
                                <div class="error_span help-text text-danger"><?php echo e($errors->first('product_name')); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="">Category</label>
                            <?php echo Form::select('product_category_id', (['' => '--Select a Category--'] + $category), ($senddata->product_category_id) ? $senddata->product_category_id : null ,['class' => 'form-control','data-error' => 'Choose Category','id' => 'product_category_id']); ?>

                            <div class="help-block form-text with-errors form-control-feedback"></div>
                            <?php if( $errors->has('product_category_id') ): ?>
                                <div
                                    class="error_span help-text text-danger"> <?php echo e($errors->first('product_category_id')); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="">Sub Category</label>
                            <?php echo Form::select('sub_category_id', (['' => '--Select a Sub Category--']+ $subcategory), ($senddata->sub_category_id) ? $senddata->sub_category_id : null ,['class' => 'form-control','data-error' => 'Choose Sub Category','id' => 'sub_category_id']); ?>

                            <div class="help-block form-text with-errors form-control-feedback"></div>

                        </div>
                        <div class="form-group">
                            <label for="">Sub Sub Category</label>
                            <?php echo Form::select('sub_sub_category_id', (['' => '--Select a Sub Sub Category--']+ $subsubcategory), ($senddata->sub_sub_category_id) ? $senddata->sub_sub_category_id : null ,['class' => 'form-control','data-error' => 'Choose Sub Sub Category','id' => 'sub_sub_category_id']); ?>

                            <div class="help-block form-text with-errors form-control-feedback"></div>

                        </div>

                        <div class="form-group">
                            <label for="">Brand</label>
                            <?php echo Form::select('brand_id', (['' => '--Select a Brand--']+ $brand), ($senddata->brand_id) ? $senddata->brand_id : null ,['class' => 'form-control','data-error' => 'Choose Sub Category','id' => 'brand_id']); ?>

                            <div class="help-block form-text with-errors form-control-feedback"></div>

                        </div>

                        <div class="form-group">
                            <label for="">Seller</label>
                            <?php echo Form::select('seller_id', (['' => '--Select a Seller--'] + $seller), ($senddata->seller_id) ? $senddata->seller_id : null ,['class' => 'form-control','data-error' => 'Choose Seller']); ?>

                            <div class="help-block form-text with-errors form-control-feedback"></div>
                            <?php if( $errors->has('seller_id') ): ?>
                                <div class="error_span help-text text-danger"> <?php echo e($errors->first('seller_id')); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="first_name">Product Short Description</label>
                            <?php echo e(Form::text('product_short_description', old('product_short_description'), ['class' => 'form-control', 'placeholder' => 'Product Short Description'])); ?>

                            <?php if($errors->has('product_short_description')): ?>
                                <div
                                    class="error_span help-text text-danger"><?php echo e($errors->first('product_short_description')); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="first_name">Product Long Description</label>
                            <?php echo e(Form::textarea('product_long_description', old('product_long_description'), ['class' => 'form-control', 'id' => 'product_long_description', 'placeholder' => 'Product Long Description'])); ?>

                            <?php if($errors->has('product_long_description')): ?>
                                <div
                                    class="error_span help-text text-danger"><?php echo e($errors->first('product_long_description')); ?></div>
                            <?php endif; ?>
                        </div>




                    <!-- <div class="form-group">
                    <label for="first_name">Product Stock</label>
                    <?php echo e(Form::text('product_stock', old('product_stock'), ['class' => 'form-control', 'placeholder' => 'Product Stock'])); ?>

                        <?php if($errors->has('product_stock')): ?>
                        <div class="error_span help-text text-danger"><?php echo e($errors->first('product_stock')); ?></div>





                    <?php endif; ?>
                        </div>-->
                        <div class="form-group">
                            <div class="row" style="margin-left: 0px;">
                                <div class="col-md-9">
                                    <label for="first_name">Product Details</label>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" id="add_more" class="btn btn-danger pull-right">Add More
                                    </button>
                                </div>
                            </div>
                            <br><br>
                            <table id="product_details">
                                <thead>
                                <tr style="font-size: 14px;">
                                    <td>Availability</td>
                                    <td>Measurement</td>
                                    <td>Price</td>
                                    <td>Sales Price</td>
                                    <td>Offer %</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($action == 'Add'): ?>
                                    <tr>
                                        <td><input type="checkbox" name="form_data[0][availability]"></td>
                                        <td><input type="text" class="form-control" name="form_data[0][measurement]"
                                                   placeholder="Measurement"></td>
                                        <td><input type="text" class="form-control price" name="form_data[0][price]"
                                                   placeholder="Price"></td>
                                        <td><input type="text" class="form-control sales_price"
                                                   name="form_data[0][sales_price]" placeholder="Sales Price" required>
                                        </td>
                                        <td><input type="text" class="form-control offer" name="form_data[0][offer]"
                                                   placeholder="Offer" readonly></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if($action == 'Edit'): ?>
                                    <?php $__currentLoopData = $product_quantity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <input type="hidden" name="form_data[<?php echo e($key); ?>][id]" value="<?php echo e($data->id); ?>">
                                            <td><input type="checkbox"
                                                       name="form_data[<?php echo e($key); ?>][availability]" <?php echo e($data->availability == "on" ? "checked" : ""); ?>>
                                            </td>
                                            <td><input type="text" class="form-control"
                                                       name="form_data[<?php echo e($key); ?>][measurement]" placeholder="Measurement"
                                                       value="<?php echo e($data->measurement); ?>"></td>
                                            <td><input type="text" class="form-control price"
                                                       name="form_data[<?php echo e($key); ?>][price]" placeholder="Price"
                                                       value="<?php echo e($data->price); ?>" required></td>
                                            <td><input type="text" class="form-control sales_price"
                                                       name="form_data[<?php echo e($key); ?>][sales_price]" placeholder="Sales Price"
                                                       value="<?php echo e($data->sales_price); ?>" required></td>
                                            <td><input type="text" class="form-control offer"
                                                       name="form_data[<?php echo e($key); ?>][offer]" placeholder="Offer"
                                                       value="<?php echo e($data->offer); ?>" readonly></td>
                                            <td><i class="fa fa-times btn_remove" name="remove"
                                                   style="cursor: pointer; color: red; font-size: 20px;"></i></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" name="quantity_count" id="quantity_count" value="<?php echo e($quantity_count); ?>">
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
                        <script type="text/javascript">

                            $(document).ready(function () {

                                var i = $("#quantity_count").val();

                                $("#add_more").click(function () {
                                    i++;
                                    $('#product_details').append('<tr class="dynamic-added"><input type="hidden" name="form_data[' + i + '][id]" value=""><td><input type="checkbox" name="form_data[' + i + '][availability]"></td><td><input type="text" class="form-control" name="form_data[' + i + '][measurement]" placeholder="Measurement"></td><td><input type="text" class="form-control price" name="form_data[' + i + '][price]" placeholder="Price" required></td><td><input type="text" class="form-control sales_price" name="form_data[' + i + '][sales_price]" placeholder="Sales Price" required><td><input type="text" class="form-control offer" name="form_data[' + i + '][offer]" placeholder="Offer" readonly></td></td><td><i class="fa fa-times btn_remove" name="remove" style="cursor: pointer; color: red; font-size: 20px; "></i></td></tr>');
                                });
                                $("body").on("keyup", ".sales_price", function () {
                                    var a = $(this).closest('td').siblings().find('.price').val();
                                    var b = $(this).val();
                                    var output = 100 - (parseInt(b) * 100 / parseInt(a));
                                    var r = $(this).closest('td').siblings().find('.offer').val(output);
                                });
                            });

                            $(document).on('click', '.btn_remove', function () {
                                var remove = $(this).closest("tr").remove();
                            });
                        </script>

                        <div class="form-group">
                            <label for="first_name">Product Tax</label>
                            <?php echo e(Form::text('product_tax', old('product_tax'), ['class' => 'form-control', 'placeholder' => 'Product Tax'])); ?>

                            <?php if($errors->has('product_tax')): ?>
                                <div class="error_span help-text text-danger"><?php echo e($errors->first('product_tax')); ?></div>
                            <?php endif; ?>
                        </div>


                        <div class="form-group">
                            <label for="first_name">Main Image</label><br><br>
                            <input type="file" name="main_image" value="<?php echo e(old('main_image')); ?>" class="form-control"
                                   onchange="loadImage(this);">
                            <div style="margin-left:10px;">
                                <img src="" id="img_preview">
                            </div>
                        <!-- <?php echo e(Form::file('main_image', old('main_image'), ['class' => 'form-control'])); ?> -->
                            <?php if($errors->has('main_image')): ?>
                                <div class="error_span help-text text-danger"><?php echo e($errors->first('main_image')); ?></div>
                            <?php endif; ?>
                            <?php if($senddata['main_image']!=""): ?>
                                <img src="<?php echo e(url('admin/images/products/')); ?>/<?php echo e($senddata['main_image']); ?>" height="100"
                                     width="100" id="preview"><a style="cursor:pointer" onclick="removeimg()"
                                                                 id="remove">Remove</a>
                                <input type="hidden" name="findremove" id="findremove">
                            <?php endif; ?>
                        </div>
                        <br>
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
                            <label class="form-control-label" for="input-email">Additional Images</label><br><br>
                            <!-- <input type="text" id="address" name="address" class="form-control" placeholder="Address">-->
                            <input type="file" name="images[]" id="images" multiple>
                        </div>
                        <?php if($senddata['product_id']!=""): ?>
                            <div class="form-group">
                                <div class="box">

                                    <?php $__currentLoopData = $upload; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uploads): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <div id="div_<?php echo e($uploads['id']); ?>"><img
                                                src="<?php echo e(url('/admin/images/products/')); ?>/<?php echo e($uploads['image_name']); ?>"
                                                height="100" width="100" id="preview_<?php echo e($uploads['id']); ?>"><a
                                                style="cursor:pointer" onclick="removeimages(<?php echo e($uploads['id']); ?>)"
                                                id="remove">Remove</a></div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                            </div>
                        <?php endif; ?>



                        <div x-data="{ open: false }">
                            <a x-on:click="open = ! open" class="btn btn-primary">Color & Size Options </a>

                            <div x-show="open">

                        <div class="row m-t-50">
                            <div class="col-md-6" style="margin-top:30px;">

                                <div class="form-group">

                                    <?php
                                        use App\Models\ProductColor;
                                     $ProductColor = ProductColor::pluck('colorName', 'id');


                                    ?>

                                    <label for="productColor">Product Color</label>
                                    <?php echo Form::select('colorName[]', $ProductColor, json_decode($productColors ?? null)  ,  ['class' => 'form-control selectMultiple', 'multiple' => 'multiple']); ?>


                                </div>

                            </div>
                            <div class="col-md-6" style="margin-top:30px;">
                                <?php
                                    use App\Models\ProductSize;
                                   $ProductSize = ProductSize::pluck('sizeName', 'id');


                                ?>
                                <label for="productSize">Product Size</label>
                                <?php echo Form::select('sizeName[]', $ProductSize, json_decode($productSizes ?? null) , ['class' => 'form-control selectMultipleSize', 'multiple' => 'multiple']); ?>


                            </div>
                        </div>

                            </div>
                        </div>


                        <div class="form-group" style="margin-top: 30px;">
                            <label for="first_name">Product Status</label>
                            <div class="radio-list">
                                <label>
                                    <?php echo e(Form::radio('product_status', 1)); ?> Active</label> <br/>
                                <label>
                                    <?php echo e(Form::radio('product_status', 0)); ?> In Active</label>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .box {
            display: flex;
            flex-wrap: wrap;
        }

        .box > * {
            flex: 1 1 160px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

    <script>

        $(document).ready(function() {
            $('.selectMultiple').select2();
            $('.selectMultipleSize').select2();
            $('.select2-container').css("width","100%");
        });

        CKEDITOR.replace('product_long_description');
        $('#product_category_id').on('change', function () {
            var cate_id = $(this).val();   //alert(stateID);
            if (cate_id) {
                $.ajax({
                    type: "GET",
                    url: "<?php echo e(url('superadmin/products/get_subcategory')); ?>?cate_id=" + cate_id,
                    success: function (res) {
                        if (res) {
                            $("#sub_category_id").empty();
                            $("#sub_category_id").append('<option value="" disabled selected>Select</option>');
                            console.log(res);
                            $.each(res, function (key, value) {
                                $("#sub_category_id").append('<option value="' + key + '">' + value + '</option>');
                            });
                        } else {
                            $("#sub_category_id").empty();
                        }
                    }
                });
            } else {
                $("#sub_category_id").empty();
            }

            var cate_id = $(this).val();   //alert(stateID);
            if (cate_id) {
                $.ajax({
                    type: "GET",
                    url: "<?php echo e(url('superadmin/products/get_brand')); ?>?cate_id=" + cate_id,
                    success: function (res) {
                        if (res) {
                            $("#brand_id").empty();
                            $("#brand_id").append('<option value="" disabled selected>Select</option>');
                            console.log(res);
                            $.each(res, function (key, value) {
                                $("#brand_id").append('<option value="' + key + '">' + value + '</option>');
                            });

                        } else {
                            $("#brand_id").empty();
                        }
                    }
                });
            } else {
                $("#brand_id").empty();
            }
        });

        $('#sub_category_id').on('change', function () {
            var sub_id = $(this).val();
            if (sub_id) {
                $.ajax({
                    type: "GET",
                    url: "<?php echo e(url('superadmin/products/get_subsubcategory')); ?>?sub_id=" + sub_id,
                    success: function (res) {
                        if (res) {
                            $("#sub_sub_category_id").empty();
                            $("#sub_sub_category_id").append('<option value="" disabled selected>Select</option>');
                            console.log(res);
                            $.each(res, function (key, value) {
                                $("#sub_sub_category_id").append('<option value="' + key + '">' + value + '</option>');
                            });

                        } else {
                            $("#sub_sub_category_id").empty();
                        }
                    }
                });
            } else {
                $("#sub_sub_category_id").empty();
            }

        });

        function removeimages(id) {
            document.getElementById('div_' + id).style.display = "none";
            $.ajax({
                type: "GET",
                url: "<?php echo e(url('superadmin/products/remove_images')); ?>?id=" + id,
                success: function (res) {
                }
            });
        }

        function removeimg() {
            document.getElementById("preview").style.display = "none";
            document.getElementById("remove").style.display = "none";
            document.getElementById("findremove").value = "1";
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\Laravel\backendGrovery\resources\views/superadmin/product/addedit.blade.php ENDPATH**/ ?>