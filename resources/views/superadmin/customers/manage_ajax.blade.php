 @forelse($customers as $key=>$data)
 <tr>
    <td>{{$key+1}}</td>
    <td>{{$data->name}}</td>
    <td>{{$data->email}}</td>
    <td>{{$data->phone_no}}</td>
    

    @if($data->status == 1)
    <td><a href="javascript:" class="badge badge-success active" data-id='{{$data->id}}' style="cursor: pointer;">Active</a></td>
    @else
    <td><a href="javascript:" class="badge badge-danger inactive" data-id='{{$data->id}}' style="cursor: pointer;">Inactive</a></td>
    @endif

 </tr>
 @empty
 <tr>
    <td colspan="7" class="text-center">
       {{$message}}
    </td>
 <tr>
    @endforelse

    <script src="{{asset('public/js/jquery.min.js')}}"></script>
<script type="text/javascript">


   $(document).ready(function(){
    
    $(".active").click(function(){
      var id = $(this).attr('data-id');
      $.ajax({
        type:"GET",
        url:"{{route('inactiveCustomer')}}?id="+id,
        success:function(res){
          window.location.reload();
        }
      });
    });

    $(".inactive").click(function(){
      var id = $(this).attr('data-id');
      $.ajax({
        type:"GET",
        url:"{{route('activeCustomer')}}?id="+id,
        success:function(res){
          window.location.reload();
        }
      });
    });

  });
  

</script>