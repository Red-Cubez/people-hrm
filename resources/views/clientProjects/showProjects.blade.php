<div class="row row-content">
    <div class="col-xs-12">
        
    
<section class="showClientProjectsSection">
@permission(StandardPermissions::showClientProjects)
@if (count($clientProjects) > 0)
 <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Current Projects</h3>
        </div>
        <div class="panel-body">
        <div class="scroll-panel-table table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                <th>Names</th>
                <th>Expected Start Date</th>
                <th>Expected End Date</th>
                <th>Actual Start Date</th>
                <th>Actual End Date</th>
                <th>Budget</th>
                <th>Cost</th>

                @permission([
                    StandardPermissions::viewClientProject,
                    StandardPermissions::deleteClientProject,
                    StandardPermissions::showClientProjects
                    ])
                <th></th>
                @endpermission
                </tr>
                </thead>
                <tbody>
                @foreach ($clientProjects as $clientProject)
                    <tr>
                        <td>{{ $clientProject->name }} </td>
                        <td>{{ $clientProject->expectedStartDate }} </td>
                        <td>{{ $clientProject->expectedEndDate }} </td>
                        <td>{{ $clientProject->actualStartDate }} </td>
                        <td>{{ $clientProject->actualEndDate }} </td>
                        <td>{{ $clientProject->budget}} </td>
                        <td>{{ $clientProject->cost }} 
                        </td>
                        <td>
                        <div class="aParent">
                            @permission(StandardPermissions::viewClientProject)
                            <a href="/clientprojects/{{$clientProject->id}}">
                                <button class="button20">  
                                  <i class="fa fa-info-circle fa-2x" aria-hidden="true"></i>
                                </button>
                            </a>
                            @endpermission
                            @permission(StandardPermissions::deleteClientProject)
                            <form action="{{ url('clientprojects/'.$clientProject->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="button20" data-toggle="confirmation"
                                        data-singleton="true">
                                  <i class="fa fa-trash fa-2x"></i>
                                </button>
                            </form>
                            @endpermission
                            @permission(StandardPermissions::createEditClientProjectResource)
                            <a href="/clientprojects/{{$clientProject->id}}/projectresources">
                                <button class="button button40"> Manage Resources</button>
                            </a>
                            @endpermission
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
        @endif
        @endpermission
        </section>
        </div>
</div>
        <script type="text/javascript">
            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',

            });
        </script>