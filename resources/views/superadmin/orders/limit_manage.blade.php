@extends('layouts.admin')
@section('title','Orders') 
@section('content')

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Orders Limit</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Orders </li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body table-responsive">
               <table class="table table-striped" id="orders">
                <a href="{{url('superadmin/orders_limit_form')}}" type="button" class="btn btn-info" style="float: left;">Add New</a>
                  <thead>
                     <tr>
                        <th>S.No</th>
                        <th>City</th>
                        <th>Area</th>
                        <th>Order Limit</th>
                        <th>Start Date</th>
                        <th>End Date</th>                       
                     </tr>
                  </thead>
                  <tbody>
                    @foreach($limits as $key => $limit)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$limit->city}}</td>
                      <td>{{$limit->area}}</td>
                      <td>{{$limit->order_limit}}</td>
                      <td>{{$limit->start_date}}</td>
                      <td>{{$limit->end_date}}</td>   
                      <td >
                        <a href="{{url('superadmin/limit_form_edit')}}/{{$limit->id}}"><img src="{{asset('public/edit.svg')}}"></a>&nbsp;

                        <a class="delete" href="javascript:;" data-toggle="modal" data-id='{{$limit->id}}' data-target="#delete"><img src="{{asset('public/delete.svg')}}"></a> 

                      </td>                   
                    </tr>
                    @endforeach     
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>


<div id="delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
              <form action="{{route('deleteOrderlimit')}}" method="post">
              @csrf
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    <h4>You Want You Sure Delete This Record?</h4>
                    <input type="hidden" name="delete_id" id="delete_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" id="delete" class="btn btn-danger waves-effect remove-data-from-delete-form delete_data">Delete</button>
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
      $('#delete_id').val(id); 
    });

  });


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

</script>