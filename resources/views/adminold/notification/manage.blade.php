@extends('layouts.admin2')
@section('title','Notifications') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Notifications </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Notifications </li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body table-responsive">
                <div class="row">
                    <div class="col-lg-12">
                        <a href="javascript:;" type="button" class="btn btn-danger" style="float: right;" data-toggle="modal" data-target="#send"> Send </a>
                    </div>
                </div>
               <table class="table table-striped" id="notifications">
                  <thead>
                     <tr>
                        <th>Title</th>
                        <th>Message</th>
                        <th>Customer</th>
                     </tr>
                  </thead>
                  <tbody>
                    @foreach($notifications as $notification)
                     <tr>
                        <td>{{$notification->title}}</td>
                        <td>{{$notification->message}}</td>
                        <td>{{$notification->customer}}</td>
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
              <form action="{{route('sendAdminNotification')}}" method="post" enctype="multipart/form-data">
              @csrf
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Send Notification</h4>
                </div>
                <div class="modal-body">
                    <input type="text" name="title" class="form-control" placeholder="Title"><br>
                    <input type="text" name="message" class="form-control" placeholder="Message"><br>
                    <input type="file" name="image" class="form-control">
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
            "bFilter": false,
            "bInfo": false,
            "bAutoWidth": true,
        });        
    });

</script>