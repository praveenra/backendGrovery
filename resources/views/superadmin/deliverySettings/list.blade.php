@extends('layouts.admin')
@section('title','Delivery Settings') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title">Delivery Settings</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Delivery Settings</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        
         <div class="card">
            <div class="card-body table-responsive">
               <table class="table table-striped" id="delivery_settings">
                  <!-- <a href="javascript:" type="button" class="btn btn-warning" style="float: left;" data-toggle="modal" data-target="#export">Export</a> &nbsp;
                  <a href="javascript:" type="button" class="btn btn-primary" style="float: left; position: relative; left: 20px;" data-toggle="modal" data-target="#filter">Filter</a> -->
                  @if($count == 0)
                  <a href="{{url('superadmin/delivery_settings_form')}}" type="button" class="btn btn-info" style="float: left;">Add New</a>
                  @endif
                  <thead>
                     <tr>
                        <th>S.No</th>
                        <th>Opening Day</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                    @forelse($settings as $key => $data)
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->opening_day}}</td>
                        <td>{{$data->start_time}}</td>
                        <td>{{$data->end_time}}</td>
                        <td>
                          <a href="{{url('superadmin/delivery_settings_form')}}/{{$data->id}}"><img src="{{asset('public/edit.svg')}}"></a>&nbsp;
                          <a class="delete" href="javascript:;" data-toggle="modal" data-id='{{$data->id}}' data-target="#delete"><img src="{{asset('public/delete.svg')}}"></a>
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
                        <option value="">--Select User Type--</option>
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

<div id="delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Delete Setting</h4>
                </div>
                <form action="{{ url('superadmin/delivery_settings_delete') }}" method="post">
                  @csrf
                <div class="modal-body">
                  <input type="hidden" name="id" id="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" id="export" class="btn btn-danger waves-effect remove-data-from-delete-form export">Delete</button>
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
        $('#id').val(id); 
      });
    });

   $(function () {
    $.noConflict();
        $('#delivery_settings').DataTable({
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