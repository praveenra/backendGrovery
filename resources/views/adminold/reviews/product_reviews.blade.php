@extends('layouts.admin2')
@section('title','Product Reviews') 
@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
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
          <a href="javascript:" type="button" class="btn btn-danger pull-right" style="float: right;" onclick="changeAllStatus()">Approve and Publish All</a>
               <table class="table table-striped" id="product_reviews">
                  <thead>
                     <tr>
                        <th>S.No</th>
                        <th>Product</th>
                        <th>Store</th>
                        <th>Customer</th>
                        <th>Review</th>
                        <th>Rating</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($reviews as $key=>$data)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->product_name}}</td>
                        <td>{{$data->sd_sname}}</td>
                        <td>{{$data->customer}}</td>
                        <td>{{$data->review}}</td>
                        <td>{{$data->rating}}&nbsp;<i class="fa fa-star" style="color:orange;font-size: 14px;"></i></td>
                        <td> 
                          <select class="form-control" id="{{$data->id}}" onchange="changestatus('{{$data->id}}')">
                              <option value="1">Approve & Publish</option>
                              <option value="2">Reject & Hide</option>
                          </select>

                          <script>
                              $("#{{$data->id}}").val("{{$data->status}}");
                              function changestatus(id){
                          
                                  var status= $("#"+id).val();
                           
                                  $.ajax({
                                      type:"GET",
                                      url:"{{url('admin/change_product_review_status')}}?id="+id+"&status="+status,
                                      success:function(res){}
                                  });     
                              }

                              function changeAllStatus(id){
                          
                                  $.ajax({
                                      type:"GET",
                                      url:"{{url('admin/change_all_product_review_status')}}",
                                      success:function(res){
                                        window.location.reload();
                                      }
                                  });     
                              }
                         </script></td>
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
        $('#product_reviews').DataTable({
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