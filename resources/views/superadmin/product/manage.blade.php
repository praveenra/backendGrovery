@extends('layouts.admin')
@section('title','Product') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> {{$page_details['page_name']}}</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$page_details['page_name']}} </li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        
         <div class="card">
            <div class="card-body table-responsive">
               <table class="table table-striped" id="product">
                <a href="javascript:" type="button" class="btn btn-primary" style="float: left;" data-toggle="modal" data-target="#filter">Filter</a>
                <a href="{{url('superadmin/products/create')}}" type="button" class="btn btn-info" style="float: left; position: relative; left: 10px;">Add New</a>
                <a href="{{url('superadmin/products/uploadview')}}" type="button" class="btn btn-warning" style="float: left; position: relative; left: 20px;">Upload</a>
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
                     @forelse($senddata as $key=>$data)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->product_name}}</td>
                        <td>{{$data->product_category->cat_name}}</td>
                        <!--<td>{{$data->product_stock}}</td>-->
                        <!-- <td>{{$data->product_price}}</td> -->
                        <!-- <td>{{$data->product_sales_price}}</td> -->
                        <td>{{$data->sd_sname}}</td>
                        @if($data->product_status == 1)
                        <td><a href="javascript:" class="badge badge-success active" data-id='{{$data->product_id}}' style="cursor: pointer;">Active</a></td>
                        @else
                        <td><a href="javascript:" class="badge badge-danger inactive" data-id='{{$data->product_id}}' style="cursor: pointer;">Inactive</a></td>
                        @endif
                        <td>

                           <a href="{{url($edit).'/'.$data->product_id.'/edit'}}"><img src="{{asset('public/edit.svg')}}"></a>&nbsp;
                           <a class="delete" href="javascript:;" data-toggle="modal" data-id='{{$data->product_id}}' data-target="#delete"><img src="{{asset('public/delete.svg')}}"></a> 
                         </td>
                     </tr>
                     @empty
                     <tr>
                        <td colspan="7" class="text-center">
                           {{$message}}
                        </td>
                     <tr>
                        @endforelse
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
              <form action="{{route('deleteProduct')}}" method="post">
              @csrf
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
                      @foreach($category as $data)
                        <option value="{{$data->cat_id}}">{{$data->cat_name}}</option>
                      @endforeach
                    </select>
                  </div><br>

                  <div class="form-group">
                     <label><strong>Sub Category</strong></label>
                     <select id="sub_category" name="sub_category_id" class="form-control">
                       <option value="">--Select Sub Category--</option>
                        @foreach($subcategory as $subcategory)
                          <option value="{{$subcategory->cat_id}}" {{$subcategory->cat_id == $data->sub_category_id ? 'selected' : ''}}>{{$subcategory->cat_name}}</option>
                        @endforeach
                       
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

@endsection

<script src="{{asset('public/js/jquery.min.js')}}"></script>
<script src="{{asset('public/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/js/dataTables.bootstrap4.min.js')}}"></script>
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
        url:"{{route('inactiveProducts')}}?id="+id,
        success:function(res){
          window.location.reload();
        }
      });
    });

    $(".inactive").click(function(){
      var id = $(this).attr('data-id');
      $.ajax({
        type:"GET",
        url:"{{route('activeProducts')}}?id="+id,
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
              url:"{{ url('superadmin/filter_products')}}",
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