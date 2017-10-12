<div class="panel-body">
    <!-- Display Validation Errors -->
@include('common.errors')

    @if (count($projectResources)>0 )
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Resources
            </div>
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <!-- Table Headings -->
                    <thead>
                    <th>Resource Name</th>
                  
        @permission([StandardPermissions::createEditClientProjectResource,StandardPermissions::deleteClientProjectResource])
                    <th>Operations</th>
        @endpermission

                    </thead>
                    
                    <tbody>
                    @foreach ($projectResources as $projectResource)
                        <tr>
                            <!-- clientProject Name -->
                            <td class="table-text">
                                <div>
                                    {{ $projectResource->resourceName}}
                                </div>

                            </td>

                            <td>
                             
        @permission(StandardPermissions::createEditClientProjectResource)
                                  <a href="/projectresources/{{$projectResource->resourceId}}/updateResource"> 
                                  <button class="btn btn-primary">
                                   Edit
                                    </button>
                                  </a>
        @endpermission
        
        @permission(StandardPermissions::deleteClientProjectResource)  
                                <form action="{{ url('projectresources/'.$projectResource->resourceId) }}"
                                      method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button class="btn btn-danger" data-toggle="confirmation" data-singleton="true" type="submit">
                                    <i class="fa fa-trash">
                                        Delete
                                    </i>
                                     </button>
                                   
                                </form>
        @endpermission 
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>

@endif
<script type="text/javascript">
$(document).ready(function(){ 

$('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  
});
    });
</script>
