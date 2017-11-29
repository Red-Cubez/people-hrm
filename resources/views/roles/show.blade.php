@if (count($roles) > 0)
    <article class="show-role">
    <div class="panel panel-default">
     <div class="panel-heading">
        <h3>Roles</h3>
        </div>
        <div class="scroll-panel-table table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                <th>Name</th>
                <th>Display Name</th>
                <th>Description</th>
                <th>Permissions</th>
                <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->display_name }}</td>
                        <td>{{ $role->description }}</td>
                        <td>
                            @foreach ($role->perms as $permissions)
                                {{ $permissions->name }}
                                <br />
                            @endforeach
                        </td>
                        <td>
                        <div class="aParent">
                            <form action="{{ route('roles.edit',$role->id) }}"
                                  method="POST">
                                {{ csrf_field() }}
                                {{ method_field('GET') }}
                                <button type="submit" class="pull-left button20">
                                    <i class="fa fa-pencil-square-o fa-2x"></i>
                                </button>
                            </form>
                            <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="pull-right button20" data-toggle="confirmation" data-singleton="true">
                                    <i class="fa fa-trash fa-2x"></i>
                                </button>
                            </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </article>

 
@endif
<script type="text/javascript">
$('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  
});
</script>
