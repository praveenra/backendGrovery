@extends('layouts.admin2')
@section('title','Customers') 
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
            <a href="javascript:" type="button" class="btn btn-warning" style="float: left;" onclick="location.href='{{url('admin/export_customers')}}'">Export</a>
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
                        <td><label class="badge badge-success">Active</label></td>
                        @else
                        <td><label class="badge badge-danger">Inactive</label></td>
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

@endsection

<script src="{{asset('public/js/jquery.min.js')}}"></script>
<script src="{{asset('public/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/js/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
  
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
   
</script>