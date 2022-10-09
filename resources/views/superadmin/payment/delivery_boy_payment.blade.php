@extends('layouts.admin')
@section('title','Delivery Boy Payment') 
@section('content')

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title">Delivery Boy Payment</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Delivery Boy Payment </li>
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
                        <th>Delivery Boy Name</th>
                        <th>Mobile Number</th>
                        <th>Bank</th>
                        <th>Account Number</th>
                        <th>Total</th>
                        <th>Payment</th>
                     </tr>
                  </thead>
                  <tbody>
                      @forelse($delivery_boy_payment as $key => $data)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->first_name}}</td>
                        <td>{{$data->mobile_number}}</td>
                        <td>{{$data->bank_name}}</td>
                        <td>{{$data->acc_no}}</td>
                        <td>{{$data->final_calculated_amount}}</td>
                        @if($data->delivery_boy_payment_status == 1)
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


   $(document).ready(function(){

     $(".active").click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
          type:"GET",
          url:"{{route('inactiveDeliveryBoy')}}?id="+id,
          success:function(res){
            window.location.reload();
          }
        });
      });

      $(".inactive").click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
          type:"GET",
          url:"{{route('activeDeliveryBoy')}}?id="+id,
          success:function(res){
            window.location.reload();
          }
        });
      });

    });
   
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
          url:"{{route('inactiveDeliveryBoy')}}?id="+id,
          success:function(res){
            window.location.reload();
          }
        });
      });

      $(".inactive").click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
          type:"GET",
          url:"{{route('activeDeliveryBoy')}}?id="+id,
          success:function(res){
            window.location.reload();
          }
        });
      });

    });

</script>