@extends('layouts.admin2')
@section('title','Log History') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Log History</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Log History </li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        
         <div class="card">
            <div class="card-body table-responsive">
               <table class="table table-striped" id="log_history">
                  <a href="javascript:" type="button" class="btn btn-warning" style="float: left;" data-toggle="modal" data-target="#export">Export</a> &nbsp;
                  <a href="javascript:" type="button" class="btn btn-primary" style="float: left; position: relative; left: 20px;" data-toggle="modal" data-target="#filter">Filter</a>
                  <thead>
                     <tr>
                        <th>S.No</th>
                        <th>User</th>
                        <th>User Type</th>
                        <th>Module</th>
                        <th>Activity</th>
                        <th>Date and Time</th>
                     </tr>
                  </thead>
                  <tbody>
                      @forelse($activity_logs as $key => $data)
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->first_name}}</td>
                        <td>{{$data->user_type_name}}</td>
                        <td>{{$data->module}}</td>
                        <td>{{$data->activity}}</td>
                        <td>{{$data->created_at}}</td>
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
                    <label><strong>User Type</strong></label>
                      <select id='user_type' name="user_type" class="form-control" style="width: 100%;">
                        <option value="">Select User Type</option>
                        <option value="Admin">Admin</option>
                        <option value="Seller">Seller</option>
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

<div id="export" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Export</h4>
                </div>
                <form action="{{ url('admin/export_log') }}" method="get">
                <div class="modal-body">
                  <div class="col-lg-12">
                    <label><strong>User Type</strong></label>
                      <select id='export_user_type' name="export_user_type" class="form-control" style="width: 100%;">
                        <option value="">All</option>
                        <option value="Admin">Admin</option>
                        <option value="Seller">Seller</option>
                      </select>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" id="export" class="btn btn-danger waves-effect remove-data-from-delete-form export">Export</button>
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

   $(function () {
    $.noConflict();
        $('#log_history').DataTable({
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

      function filter(user_type = '') {
          $.ajax({
              url:"{{ url('admin/filter_log')}}",
              method:"GET",
              data:{
                user_type:user_type
              },
              success:function(data) {
                $('tbody').html(data);
              }
          })   
      }

      $('.filter').click(function() {
        var user_type = $('#user_type').val();
        filter(user_type);
      });

    });

</script>