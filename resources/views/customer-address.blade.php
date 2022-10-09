@extends('layouts.web')
@section('title','Grovery') 
@section('content')
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <div class="container">
        <div class="breadcrumb">
            <ul>
                <li><a href="">Account</a></li>
                <li><a href="">Add new address</a></li>
            </ul>
        </div>
        <div class='newaddress'>
            <div class="addressdet">
                <h3>Add New Address</h3>
                @foreach($cust_addresses as $cust_address)
                    @if($cust_address->address_type == 'Home')
                    <div class="addresshme">
                    @else
                    <div class="addresshme addoffice">
                    @endif
                  <h5>{{$cust_address->address_type}} <span><a class="editCustomerAddress" href="javascript:;" data-toggle="modal" data-id='{{$cust_address->id}}' data-target="#editCustomerAddress"><img src="public/edit.svg"></a> | <a class="deleteCustomerAddress" href="javascript:;" data-toggle="modal" data-id='{{$cust_address->id}}' data-target="#deleteCustomerAddress"><img src="public/delete.svg"></a>&nbsp;&nbsp;<input type="radio" name="select" value="{{$cust_address->id}}" class="select" id="select{{$cust_address->id}}"></span></h5>
                  <p>{{$cust_address->address}} <br>{{$cust_address->mobile_no}} <br> Landmark: {{$cust_address->landmark}}</p>
                </div>
                <script>
                  if("{{$cust_address->select}}"==1)
                  {
                    $("#select{{$cust_address->id}}").attr('checked', true);
                  }
        </script>
                @endforeach
                <form action="{{route('saveCustomerAddress')}}" method="post">
                @csrf
                    <input type="text" name="address" placeholder="Flat No / Floor / Building Name">
                    <input type="text" name="landmark" placeholder="Nearby Landmark">
                    <input type="text" name="mobile_no" placeholder="Mobile Number">
                    <select id="address_type" name="address_type">
                        <option value="">Address Type</option>
                        <option value="Home">Home</option>
                        <option value="Office">Office</option>
                        <option value="Others">Others</option>
                    </select>
                    <input type="submit" value="Save Address">
                </form>
            </div>
            <div class="clear"></div>
        </div>
    </div>

<!-- Edit -->
<div class="modal modal-left fade edit" id="editCustomerAddress" tabindex="-1" role="dialog" aria-labelledby="left_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('saveCustomerAddress')}}" method="post">
            @csrf
            <input type="hidden" name="id" id="id" class="form-control">
            <input type="text" name="address" id="address" class="form-control"><br>
            <input type="text" name="landmark" id="landmark" class="form-control"><br>
            <input type="text" name="mobile_no" id="mobile_no" class="form-control"><br>
            <select id="address_type" name="address_type" id="address_type" class="form-control">
                <option value="">Address Type</option>
                <option value="Home">Home</option>
                <option value="Office">Office</option>
                <option value="Others">Others</option>
            </select>
      </div>
      <div class="modal-footer modal-footer-fixed">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete -->
<div id="deleteCustomerAddress" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
            <form action="{{route('deleteCustomerAddress')}}" method="POST" class="remove-record-model">
               {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Delete Address</h4>
                </div>
                <div class="modal-body">
                    <h4>Are You Sure to Delete This Record?</h4>
                    <input type="hidden" name="delete_id" id="delete_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger waves-effect remove-data-from-delete-form">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".deleteCustomerAddress").click(function(){
            var customer_id = $(this).attr('data-id');
            $('#delete_id').val(customer_id); 
        });

        $(".select").click(function()
{ 
var id=$(this).val();
   $.ajax({
      type:"GET",
      url:"{{url('setaddress')}}?id="+id,
      success:function(res){        
      
      }
    });
});
    });

     $(document).on('click','.editCustomerAddress',function(){
        var id= $(this).attr('data-id');
         $.ajax({
                url: "{{url('/edit_address')}}" + '/' + id,
                type: "GET",
                data: {
                    id: id,
                    _token: '{{csrf_token()}}' 
                },
                dataType : 'json',
                success: function(data){
                  console.log(data);
                  $('#id').val(data.data.id);
                  $('#address').val(data.data.address);
                  $('#landmark').val(data.data.landmark);
                  $('#mobile_no').val(data.data.mobile_no);
                  $(`#address_type option[value='${data.data.address_type}']`).prop('selected', true);
                }
          });
       
      });

     


</script>

