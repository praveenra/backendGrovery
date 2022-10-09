@forelse($senddata as $key=>$data)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->mc_name}}</td>
                        
                        <td>{{$data->mc_commision}}</td>
                        <td><img src="{{url('public/admin/images/category/')}}/{{$data->image}}"></td>
                        @if($data->mc_status == 1)
                        <td><label class="badge badge-success">Active</label></td>
                        @else
                        <td><label class="badge badge-danger">Inactive</label></td>
                        @endif
                        <td >
                           <a href="{{url($edit).'/'.$data->mc_id.'/edit'}}"><img src="{{asset('public/edit.svg')}}"></a>&nbsp;
                           <a class="delete" href="javascript:;" data-toggle="modal" data-id='{{$data->mc_id}}' data-target="#delete"><img src="{{asset('public/delete.svg')}}"></a> 
                         </td>
                     </tr>
                     @empty
                     <tr>
                        <td colspan="7" class="text-center">
                           {{$message}}
                        </td>
                     <tr>
                        @endforelse