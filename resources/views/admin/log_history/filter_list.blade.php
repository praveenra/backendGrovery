@forelse($activity_logs as $key => $data)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$data->first_name}}</td>
                      <td>{{$data->user_type_name}}</td>
                      <td>{{$data->module}}</td>
                      <td>{{$data->activity}}</td>
                      <td>{{$data->created_at}}</td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="7" class="text-center">
                        {{$message}}
                      </td>
                    <tr>
                    @endforelse