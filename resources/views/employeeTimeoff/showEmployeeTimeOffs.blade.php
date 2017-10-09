<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Time Offs
        </h3>
    </div>
    <div class="panel-body">
        @if (count($timeoffs)>0)
        <table class="table table-striped task-table">
            <!-- Table Headings -->
            <thead>
                <th>
                    Start Date
                </th>
                <th>
                    End Date
                </th>
                <th>
                    # Of Days
                </th>
                <th>
                    Aprroved
                </th>
                <th>
                    Operation
                </th>
            </thead>
            <tbody>
                @foreach ($timeoffs as $timeoff)
                <tr>
                    <td class="table-text">
                        <div>
                            {{--
                            <a href="/employeetimesheet/{{$timesheet->id}}/edit">
                                --}}
                                {{$timeoff->start_date}}
                           {{--
                            </a>
                            --}}
                        </div>
                    </td>
                    <td class="table-text">
                        <div>
                            {{$timeoff->end_date}}
                        </div>
                    </td>
                    <td class="table-text">
                        <div>
                            {{$timeoff->total_count}}
                        </div>
                    </td>
                    <td class="table-text">
                        <div>
                            @if($timeoff->is_approved==1)
                               Yes
                            @elseif($timeoff->is_approved==0)
                               No
                            @endif
                        </div>
                    </td>
                    <td>
                      @if($timeoff->is_approved==0)
                        <a href="/employeetimeoff/{{$timeoff->id}}/edit">
                            <button class="btn btn-primary">
                                EDIT
                            </button>
                        </a>
                         @permission('delete-timeoff')
                        <form action="{{ url('employeetimeoff/'.$timeoff->id) }}" method="POST">
                            {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                            <button class="btn btn-danger" data-toggle="confirmation" data-singleton="true" type="submit">
                                <i class="fa fa-trash">
                                    DELETE
                                </i>
                            </button>
                        @endif
                        </form>
                         @endpermission
                    </td>
                </tr>
                @endforeach
            @else
            No Record Found
            @endif
            </tbody>
        </table>
    </div>
   
</div>
<script type="text/javascript">
$('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  
});
</script>