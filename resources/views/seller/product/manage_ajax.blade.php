 @forelse($senddata as $key=>$data)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->product_name}}</td>
                        <td>{{$data->product_category->cat_name}}</td>
                        <!--<td>{{$data->product_stock}}</td>-->
                        <td>{{$data->product_price}}</td>
                        <td>{{$data->product_tax}}</td>
                        <td>{{$data->product_sales_price}}</td>
                        @if($data->product_status == 1)
                        <td><label class="badge badge-success">Active</label></td>
                        @else
                        <td><label class="badge badge-danger">Inactive</label></td>
                        @endif
                        <td >
                           <a href="{{url($edit).'/'.$data->product_id.'/edit'}}"><img src="{{asset('public/edit.svg')}}"></a>&nbsp;
                           <a class="delete" href="javascript:;" data-toggle="modal" data-id='{{$data->product_id}}' data-target="#delete"><img src="{{asset('public/delete.svg')}}"></a>     								
                         </td>
                     </tr>
                     @empty
                     <tr>
                        <td colspan="7" class="text-center">
                           {{$message}}
                        </td>
                     <tr>
                        @endforelse