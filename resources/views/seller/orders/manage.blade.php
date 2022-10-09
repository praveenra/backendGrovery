@extends('layouts.seller')
@section('title','Seller') 
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
            <div class="card-body">
               <table class="table" id="orders">
                  <thead>
                     <tr>
                        <th>S.No</th>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Order Status</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($senddata as $key=>$slider)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$slider->order_id}}</td>
                        <td>{{$slider->customer}}</td>
                        <td>{{$slider->product}}</td>
                        <td>{{$slider->quantity}}</td>
                        <td>{{$slider->total}}</td>
                        @if($slider->order_status == 1)
                           <td class="approve"><a href="javascript:;" class="btn-approve approve_order" data-id="{{$slider->id}}" data-toggle="modal" data-target="#approveOrReject">{{$slider->order_status_name}}</a></td>
                        @elseif($slider->order_status == 2)
                           <td class="approve"><a href="javascript:;" class="btn-approve progress_id" data-id="{{$slider->id}}" data-toggle="modal" data-target="#progress_order">{{$slider->order_status_name}}</a></td>
                        @elseif($slider->order_status == 3)
                           <td class="approve"><a href="javascript:;" class="btn-approve" data-id="{{$slider->id}}">{{$slider->order_status_name}}</a></td>
                        @elseif($slider->order_status == 4)
                           <td class="approve"><a href="javascript:;" class="btn-approve" data-id="{{$slider->id}}">{{$slider->order_status_name}}</a></td>
                        @elseif($slider->order_status == 5)
                           <td class="approve"><a href="javascript:;" class="btn-approve" data-id="{{$slider->id}}">{{$slider->order_status_name}}</a></td>
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


<style type="text/css">
   .approve a{
      color: #007bff;
      font-weight: 200;
   }
   .approve a:hover{
      text-decoration: none;
      font-weight: bolder;
   }
</style>


<div id="approveOrReject" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Approve or Reject Order</h4>
                </div>
                
                <div class="modal-body">
                    <form method="post" class="modal-content" action="{{ route('approveOrReject') }}" style="border: none;">
                    @csrf
                  <div class="row">
                  </div><br><br>
                  <div class="row">
                    <div class="col-lg-8">
                        <input type="hidden" name="approve_id" id="approve_id">
                        <label style="margin-left: 70px;">Approve or Reject Order</label><br>
                        <select class="form-control" name="order_status" id="order_status" style="margin-left: 70px;">
                            <option value="1">Approve</option>
                            <option value="5">Reject</option>
                        </select>
                    </div>
                </div><br><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger waves-effect">Proceed</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="progress_order" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Proceed to Delivery</h4>
                </div>
                
                <div class="modal-body">
                    <form method="post" class="modal-content" action="{{ route('progressOrder') }}" style="border: none;">
                    @csrf
                     <input type="hidden" name="progress_id" id="progress_id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger waves-effect">Proceed</button>
                </div>
                </form>
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
        $('#orders').DataTable({
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

        $(".approve_order").click(function(){
            var id = $(this).attr('data-id');
            $('#approve_id').val(id); 
        });

    });

    $(document).ready(function(){
        $(".progress_id").click(function(){
            var id = $(this).attr('data-id');
            $('#progress_id').val(id); 
        });
    });

</script>