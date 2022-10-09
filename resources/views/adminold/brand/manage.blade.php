@extends('layouts.admin2')
@section('title','Brand') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> {{$page_details['page_name']}}</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$page_details['page_name']}} </li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        
         <div class="card">
            <div class="card-body table-responsive">
               <table class="table table-striped" id="brand">
                  <a href="javascript:" type="button" class="btn btn-primary" style="float: left;" data-toggle="modal" data-target="#filter">Filter</a>
                  <a href="javascript:" type="button" class="btn btn-warning" style="float: left; position: relative; left: 20px;" onclick="location.href='{{url('admin/brand/create')}}'">Add New</a> &nbsp;
                  <thead>
                     <tr>
                        <th>S. No</th>
                        <th>Category Name</th>
                        <th>Brand Name</th>
                        <!--<th>Sub Category Image</th>-->
                        <th>Brand Status</th>
                        <th>Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($senddata as $key=>$slider)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$category_list[$slider->cat_is_parent_id]}}</td>
                        <td>{{$slider->brand_name}}</td>
                        @if($slider->brand_status == 1)
                        <td><label class="badge badge-success">Active</label></td>
                        @else
                        <td><label class="badge badge-danger">Inactive</label></td>
                        @endif
                        <td>

                           <a href="{{url($edit).'/'.$slider->id.'/edit'}}"><img src="{{asset('public/edit.svg')}}"></a>&nbsp;
                           <a class="delete" href="javascript:;" data-toggle="modal" data-id='{{$slider->id}}' data-target="#delete"><img src="{{asset('public/delete.svg')}}"></a> 

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
              <form action="{{route('deleteAdminBrand')}}" method="post">
              @csrf
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Delete Brand</h4>
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
  });
   
   $(function () {
    $.noConflict();
        $('#brand').DataTable({
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
              url:"{{ url('admin/filter_brand')}}",
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