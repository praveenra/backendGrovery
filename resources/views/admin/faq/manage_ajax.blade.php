@forelse($senddata as $key=>$slider)
                     <tr>
                        <td>{{$key+1}}</td>
                        @if($slider->type == 1)
                          <td>Seller</td>
                        @elseif($slider->type == 2)
                          <td>Customer</td>
                        @elseif($slider->type == 3)
                          <td>Membership</td>
                        @endif
                        <td>{{$slider->question}}</td>
                        @if($slider->status == 1)
                        <td><label class="badge badge-success">Active</label></td>
                        @else
                        <td><label class="badge badge-danger">Inactive</label></td>
                        @endif
                        <td >
                           <a href="{{url($edit).'/'.$slider->id.'/edit'}}"><img src="{{asset('public/edit.svg')}}"></a>&nbsp;
                           <a class="delete" href="javascript:;" data-toggle="modal" data-id='{{$slider->id}}' data-target="#delete"><img src="{{asset('public/delete.svg')}}"></a> 
                         </td>
                     </tr>
                     @empty
                     <tr>
                        <td colspan="7" class="text-center">
                           {{$message}}
                        </td>
                     <tr>
                        @endforelse