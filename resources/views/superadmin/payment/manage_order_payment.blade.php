@extends('layouts.admin')
@section('title','Seller Payment') 
@section('content')

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>


<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Seller Payment</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Seller Payment </li>
         </ol>
      </nav>
   </div>

   <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">

          <div class="col-lg-2 col-3">
          <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                  <h3>{{$payment_count}}</h3>
                  <p>Completed Payment</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-3">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{$total_amount}}<sup style="font-size: 18px">Rs</sup></h3>
              <p>Order <br> Earnings</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          
      </div>
   </div>
   
   <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body table-responsive">
               <table class="table table-striped" id="order_payment">
                  <thead>
                     <tr>
                        <th>S. No</th>
                        <th>Seller Name</th>
                        <th>Seller Address</th>
                        <th>Seller Bank</th>
                        <th>Seller Account Number</th>
                        <th>Ordered Customer Name</th>
                        <th>Product Name</th>
                        <th>Total</th>
                        <th>Delivery Man Earning</th>
                        <th>Earning</th>
                        <th>Payment</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($orders_payment as $key => $data)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->sd_sname}}</td>
                        <td>{{$data->sd_address}},{{$data->sd_spincode}}</td>
                        <td>{{$data->bank_name}}</td>
                        <td>{{$data->acc_no}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->product_name}}</td>
                        <td>{{$data->total_amount}}</td>
                        <td>{{$data->delivery_man_amount}}</td>
                        <td>{{$data->final_calculated_amount}}</td>
                        @if($data->seller_payment_status == 1)
                        <td><a href="javascript:" class="badge badge-success active" data-id='{{$data->ord_id}}' style="cursor: pointer;">Payment Success</a></td>
                        @else
                        <td><a href="javascript:" class="badge badge-danger inactive" data-id='{{$data->ord_id}}' style="cursor: pointer;">Payment Pending </a></td>
                        @endif
                        <td>
                          <a href="javascript:;" class="order_payment_modal" data-id="{{$data->ord_id}}" data-toggle="modal" data-target="#view" title="view"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
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

<div id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
      <div class="modal-content" style="left: 100%;height: 100%;top: -28px; position: static;">
          <div class="modal-header row d-flex justify-content-between mx-1 mx-sm-3 mb-0 pb-0 border-0">
              <div class="tabs active" id="tab01">
                  <h6 class="font-weight-bold">Details</h6>
              </div>
          </div>
          <div class="line"></div>
          <div class="modal-body p-0">
              <fieldset class="show" id="tab011">
                  <div class="bg-light">
                      <h6>Seller Name</h6>
                      <span class="px-4" id="seller_name"></span>
                      <h6>Seller Address</h6>
                      <span class="px-4" id="seller_address"></span><br>
                      <h6>Seller Bank</h6>
                      <span class="px-5" id="seller_bank"></span>
                      <h6>Seller Account Number</h6>
                      <span class="px-5" id="seller_account_number"></span>
                      <h6>Ordered Customer Name</h6>
                      <span class="px-5" id="customer_name"></span><br>
                      <h6>Product Name</h6>
                      <span class="px-5" id="product_name"></span><br>
                      <h6>Total</h6>
                      <span class="px-5" id="total"></span>
                  </div>
              </fieldset>
          </div>
          <div class="line"></div>
          <div class="modal-footer d-flex justify-content-center border-0">
              <button type="button" class="btn btn-default btn-sm btn-outline-danger" data-dismiss="modal">Cancel</button>
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

    $('.order_payment_modal').click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url: "{{url('superadmin/view_order_payments')}}" + '/' + id,
            type: 'GET',
            dataType: 'json',
        }).done(function(response) {
            $('#seller_name').html(response.orders_payment_details_display.sd_sname);
            $('#seller_address').html(response.orders_payment_details_display.sd_address);
            $('#seller_address').html(response.orders_payment_details_display.sd_spincode);
            $('#seller_bank').html(response.orders_payment_details_display.bank_name);
            $('#seller_account_number').html(response.orders_payment_details_display.acc_no);
            $('#customer_name').html(response.orders_payment_details_display.name);
            $('#product_name').html(response.orders_payment_details_display.product_name);

            $('#total').html('Total: ???' + response.final_calculated_amount_display);
        });
    });

  });

   $(function () {
    $.noConflict();
        $('#order_payment').DataTable({
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
          url:"{{route('inactiveOrderPayments')}}?id="+id,
          success:function(res){
            window.location.reload();
          }
        });
      });

      $(".inactive").click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
          type:"GET",
          url:"{{route('activeOrderPayments')}}?id="+id,
          success:function(res){
            window.location.reload();
          }
        });
      });

    });

</script>