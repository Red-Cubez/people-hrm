<div class="panel panel-default">
    <div class="panel-heading">
        <h3> Time Offs </h3>
    </div>
    <div class="panel-body">
        @if (count($timeoffs)>0)
         <div class="scroll-panel-table table-responsive">
        <table class="table table-bordered table-hover table-striped">
             <thead>
             <tr>
                <th> Start Date </th>
                <th>  End Date </th>
                <th> # Of Days </th>
                <th> Aprroved </th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($timeoffs as $timeoff)
                <tr>
                    <td >  {{$timeoff->start_date}} </td>
                    <td > {{$timeoff->end_date}} </td>
                    <td >  {{$timeoff->total_count}} </td>
                    <td>
                          @if($timeoff->is_approved==1)
                               Yes
                            @elseif($timeoff->is_approved==0)
                               No
                            @endif 
                    </td>
                    <td>
                    <div class="aParent">
                      @if($timeoff->is_approved==0)
                        <a href="/employeetimeoff/{{$timeoff->id}}/edit">
                            <i class="fa fa-pencil-square-o fa-2x"></i>
                        </a>
                         @permission(StandardPermissions::deleteTimeoff)
                        <form action="{{ url('employeetimeoff/'.$timeoff->id) }}" method="POST">
                            {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                            <button    type="submit" class="button20">
                       <i data-toggle="confirmation" data-singleton="true" class="fa fa-trash fa-2x"></i>
                            </button>
                        @endif
                        </form>
                    @endpermission
                    </div>
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