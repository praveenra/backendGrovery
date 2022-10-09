@extends('layouts.admin')
@section('title','Category') 
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
               <table class="table table-striped" id="category">
                <a href="javascript:" type="button" class="btn btn-primary" style="float: left;" data-toggle="modal" data-target="#filter">Filter</a>
                <a href="{{url('superadmin/category/create')}}" type="button" class="btn btn-info" style="float: left; position: relative; left: 10px;">Add New</a>
                  <thead>
                     <tr>
                        <th>S. No</th>
                        <th>Category Name</th>
                        <th>Category Image</th>
                        <th>Category Status</th>
                        <th>Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($sliders as $key=>$slider)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$slider->cat_name}}</td>
                        <td><img width="100px" src="{{asset('admin/images')}}/{{$slider->cat_image}}"></td>
                        @if($slider->cat_status == 1)
                        <td><a href="javascript:" class="badge badge-success active" data-id='{{$slider->cat_id}}' style="cursor: pointer;">Active</a></td>
                        @else
                        <td><a href="javascript:" class="badge badge-danger inactive" data-id='{{$slider->cat_id}}' style="cursor: pointer;">Inactive</a></td>
                        @endif
                        <td >
                           <a href="{{url($edit).'/'.$slider->cat_id.'/edit'}}"><img src="{{asset('public/edit.svg')}}"></a>&nbsp;
                           <a class="delete" href="javascript:;" data-toggle="modal" data-id='{{$slider->cat_id}}' data-target="#delete"><img src="{{asset('public/delete.svg')}}"></a> 
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
              <form action="{{route('deleteCategory')}}" method="post">
              @csrf
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Delete Category</h4>
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
        url:"{{route('inactiveCategory')}}?id="+id,
        success:function(res){
          window.location.reload();
        }
      });
    });

    $(".inactive").click(function(){
      var id = $(this).attr('data-id');
      $.ajax({
        type:"GET",
        url:"{{route('activeCategory')}}?id="+id,
        success:function(res){
          window.location.reload();
        }
      });
    });

  });


   $(function () {
    $.noConflict();
        $('#category').DataTable({
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
              url:"{{ url('superadmin/filter_category')}}",
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