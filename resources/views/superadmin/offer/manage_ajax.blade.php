@forelse($offers as $key=>$offer)
 <tr>
    <td>{{$key+1}}</td>
    <td>{{$offer->name}}</td>
    <td>{{$offer->type}}</td>
    <td>{{$offer->coupon_for}}</td>
    <td>{{$offer->value}}</td>
    <td>{{$offer->city_name}}</td>
    <td>{{$offer->promo}}</td>
    @if($offer->active == "on")
      <td><a href="javascript:" class="badge badge-success active" data-id='{{$offer->id}}' style="cursor: pointer;">Active</a></td>
    @else
      <td><a href="javascript:" class="badge badge-danger inactive" data-id='{{$offer->id}}' style="cursor: pointer;">Inactive</a></td>
    @endif
    <td>
       <a href="{{url('superadmin/offer_form')}}/{{$offer->id}}"><img src="{{asset('public/edit.svg')}}"></a>&nbsp;
       <a class="delete" href="javascript:;" data-toggle="modal" data-id='{{$offer->id}}' data-target="#delete"><img src="{{asset('public/delete.svg')}}"></a> 
    </td>
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

    $(".delete").click(function(){
      var id = $(this).attr('data-id');
      $('#delete_id').val(id); 
    });
    
    $(".active").click(function(){
      var id = $(this).attr('data-id');
      $.ajax({
        type:"GET",
        url:"{{route('inactiveOffer')}}?id="+id,
        success:function(res){
          window.location.reload();
        }
      });
    });

    $(".inactive").click(function(){
      var id = $(this).attr('data-id');
      $.ajax({
        type:"GET",
        url:"{{route('activeOffer')}}?id="+id,
        success:function(res){
          window.location.reload();
        }
      });
    });

  });

</script>