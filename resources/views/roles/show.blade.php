@if (count($roles) > 0)
    <article class="show-role">
        <h3>Roles</h3>
        <div class="table-responsive">
            <table class="table table-condensed  table-bordered table-striped table-hover">
                <thead>
                <th>Name</th>
                <th>Display Name</th>
                <th>Description</th>
                <th>Permissions</th>
                <th>Options</th>
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
                            <form action="{{ route('roles.edit',$role->id) }}"
                                  method="POST">
                                {{ csrf_field() }}
                                {{ method_field('GET') }}
                                <button type="submit" class="pull-left button button10">
                                    <i class="fa fa-pencil-square-o"> Edit</i>
                                </button>
                            </form>
                            <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="pull-right button button10" data-toggle="confirmation" data-singleton="true">
                                    <i class="fa fa-trash"> Delete</i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </article>

 
@endif
<script type="text/javascript">
$('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  
});
</script>
