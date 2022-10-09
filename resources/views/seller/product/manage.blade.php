@extends('layouts.seller')
@section('title','Seller') 
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
            <div class="card-body">
              <div class="row">
                 <div class="col-lg-4">
                <label><strong>Category:</strong></label>
                <select id="category" name="category" class="form-control">
                  <option value="">--Select Category--</option>
                  @foreach($category as $data)
                    <option value="{{$data->cat_id}}">{{$data->cat_name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-lg-4">
                <label><strong>Status:</strong></label>
                <select id='status' name="status" class="form-control">
                    <option value="">--Select Status--</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
              </div>
              <div class="col-lg-4" style="margin-top: 26px;">
                <button type="button" class="btn btn-primary filter">Filter</button>
              </div>
            </div><br>
               <h4 class="card-title">{{$page_details['page_name']}} Details</h4>
               <table class="table" id="products">
                  <thead>
                     <tr>
                        <th>S. No</th>
                        <th>Product Name</th>
                        <th>Category Name</th>
                        <!--<th>Product Stock</th>-->
                        <th>Product Price</th>
                        <th>Product Tax</th>
                        <th>Product Sales Price</th>
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
                        <td>{{$data->product_price}}</td>
                        <td>{{$data->product_tax}}</td>
                        <td>{{$data->product_sales_price}}</td>
                        @if($data->product_status == 1)
                        <td><label class="badge badge-success">Active</label></td>
                        @else
                        <td><label class="badge badge-danger">Inactive</label></td>
                        @endif
                        <td >
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
  });

  
   $(function () {
    $.noConflict();
        $('#products').DataTable({
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

      function filter(status = '', category='') {
          $.ajax({
              url:"{{ url('seller/filter_products')}}",
              method:"GET",
              data:{
                status:status, category:category
              },
              success:function(data) {
                $('tbody').html(data);
              }
          })   
      }

      $('.filter').click(function() {
        var status = $('#status').val();
        var category = $('#category').val();
        filter(status,category);
      });
    });
</script>