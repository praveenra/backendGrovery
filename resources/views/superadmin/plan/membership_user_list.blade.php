@extends('layouts.admin')
@section('title','Membership User') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Membership User</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Membership User </li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body table-responsive">
               <table class="table table-striped" id="plan">
                  <thead>
                     <tr>
                        <th>S. No</th>
                        <th>Customer Name</th>
                        <th>Customer Phone Number</th>
                        <th>Plan Name</th>
                        <th>Plan Duration</th>
                        <th>Plan Limit</th>
                        <th>Original Plan Amount</th>
                        <th>Plan Amount</th>
                        <th>Description</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($mebership_user_list as $key => $data)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->phone_no}}</td>
                        <td>{{$data->plan_name}}</td>
                        <td>{{$data->plan_duration}}</td>
                        <td>{{$data->plan_limit}}</td>
                        <td>{{$data->original_plan_amount}}</td>
                        <td>{{$data->plan_amount}}</td>
                        <td>{{$data->description}}</td>
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


@endsection

<script src="{{asset('public/js/jquery.min.js')}}"></script>
<script src="{{asset('public/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/js/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">

   $(function () {
    $.noConflict();
        $('#plan').DataTable({
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