@extends('layouts.admin')
@section('title','Notifications') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Notifications </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Notifications </li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body table-responsive">
               
               <table class="table table-striped" id="notifications">
                <!-- <a href="javascript:" type="button" class="btn btn-primary" style="float: left;" onclick="location.href='{{url('superadmin/notification_list')}}'">Export</a> -->
                <a href="javascript:;" type="button" class="btn btn-info" style="float: left; position: relative; left: 10px;" data-toggle="modal" data-target="#send">Send</a>
                  <thead>
                     <tr>
                        <th>S. No</th>
                        <th>Title</th>
                        <th>Message</th>
                        <th>User Type</th>
                     </tr>
                  </thead>
                  <tbody>
                    @foreach($notifications as $key=>$notification)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$notification->title}}</td>
                        <td>{{$notification->message}}</td>
                        <td>{{$notification->members}}</td>
                     </tr>
                    @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<div id="send" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
              <form action="{{route('sendNotification')}}" method="post" enctype="multipart/form-data">
              @csrf
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Send Notification</h4>
                </div>
                <div class="modal-body">

                     <select name="members" id="cars">
                        <option value="all" name="members" for="members">All</option>
                        <option value="membership_users" name="members" for="members">Membership Users</option>
                        <option value="delivery_boy" name="members" for="members">Delivery Boy</option>
                      </select>

                    <input type="text" name="title" class="form-control" placeholder="Title" required="" ><br>
                    <input type="text" name="message" class="form-control" placeholder="Message" required=""><br>
                    <input type="file" name="image" class="form-control" >
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" id="delete" class="btn btn-danger waves-effect remove-data-from-delete-form delete_data">Send</button>
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
        $('#notifications').DataTable({
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
              url:"{{ url('superadmin/filter_measurement')}}",
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