@extends('layouts.admin')
@section('title','Customers') 
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
            <a href="javascript:" type="button" class="btn btn-primary" style="float: left;" data-toggle="modal" data-target="#filter">Filter</a>
            <a href="javascript:" type="button" class="btn btn-warning"  style="float: left; position: relative; left: 10px;" onclick="location.href='{{url('superadmin/export_customers')}}'">Export</a>
               <table class="table table-striped" id="customers">
                  <thead>
                     <tr>
                        <th>S. No</th>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Status</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($customers as $key=>$data)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->phone_no}}</td>
                        

                        @if($data->status == 1)
                        <td><a href="javascript:" class="badge badge-success active" data-id='{{$data->id}}' style="cursor: pointer;">Active</a></td>
                        @else
                        <td><a href="javascript:" class="badge badge-danger inactive" data-id='{{$data->id}}' style="cursor: pointer;">Inactive</a></td>
                        @endif

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
    
    $(".active").click(function(){
      var id = $(this).attr('data-id');
      $.ajax({
        type:"GET",
        url:"{{route('inactiveCustomer')}}?id="+id,
        success:function(res){
          window.location.reload();
        }
      });
    });

    $(".inactive").click(function(){
      var id = $(this).attr('data-id');
      $.ajax({
        type:"GET",
        url:"{{route('activeCustomer')}}?id="+id,
        success:function(res){
          window.location.reload();
        }
      });
    });

  });
  
   $(function () {
    $.noConflict();
        $('#customers').DataTable({
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
              url:"{{ url('superadmin/filter_customer')}}",
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