@extends('layouts.admin')
@section('title','Return Payment') 
@section('content')

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>


<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title">Return Payment</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Return Payment </li>
         </ol>
      </nav>
   </div>
   
   <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body table-responsive">
               <table class="table table-striped" id="delivery_boy_payment">
                  <thead>
                     <tr>
                        <th>S. No</th>
                        <th>Seller Name</th>
                        <th>Seller Address</th>
                        <th>Seller Bank</th>
                        <th>Seller Account Number</th>
                        <th>Ordered Customer Name</th>
                        <th>Refund Amount</th>
                        <th>Payment</th>
                     </tr>
                  </thead>
                  <tbody>
                      @forelse($return_status as $key => $data)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->sd_sname}}</td>
                        <td>{{$data->sd_address}},{{$data->sd_spincode}}</td>
                        <td>{{$data->bank_name}}</td>
                        <td>{{$data->acc_no}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->final_calculated_amount}}</td>
                        @if($data->return_payment_status == 1)
                        <td><a href="javascript:" class="badge badge-success active" data-id='{{$data->ord_id}}' style="cursor: pointer;">Payment Success</a></td>
                        @else
                        <td><a href="javascript:" class="badge badge-danger inactive" data-id='{{$data->ord_id}}' style="cursor: pointer;">Payment Pending </a></td>
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
        $('#delivery_boy_payment').DataTable({
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

     $(".active").click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
          type:"GET",
          url:"{{route('inactiveReturnPayments')}}?id="+id,
          success:function(res){
            window.location.reload();
          }
        });
      });

      $(".inactive").click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
          type:"GET",
          url:"{{route('activeReturnPayments')}}?id="+id,
          success:function(res){
            window.location.reload();
          }
        });
      });

    });



</script>