<section class="viewCompanyResourceSection" >
<div class="panel panel-default">
    @include('common.errors')
    @if (count($projectResources)>0 )
        <div class="panel-heading">
              <h3>Current Resources</h3>
            </div>
            <div class="panel-body">
                <div class="scroll-panel-table table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                    <th>Project</th>
                    @permission([StandardPermissions::createEditCompanyProjectResource,StandardPermissions::deleteCompanyProjectResource])
                    <th></th>
                    @endpermission
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($projectResources as $projectResource)
                        <tr>
                                 <td >{{ $projectResource->resourceName}}
                                </td> 
                                 @permission([StandardPermissions::createEditCompanyProjectResource,StandardPermissions::deleteCompanyProjectResource])
                         
                                    <td>
                                        <div  class="aParent">
                                        @permission(StandardPermissions::createEditCompanyProjectResource)
                                        <a href="/companyprojectresources/{{$projectResource->resourceId}}/edit">
                                            <i class="fa fa-pencil-square-o fa-2x"></i>
                                        </a>
                                        @endpermission
                                        @permission(StandardPermissions::deleteCompanyProjectResource)
                                            <form action="{{ url('companyprojectresources/'.$projectResource->resourceId) }}"
                                              method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="hidden" name="companyProjectId" class="button20" 
                                                   value="{{$projectResource->projectId}}">
                                                   <button class="button20" data-toggle="confirmation" data-singleton="true" type="submit">
                                            <i class="fa fa-trash fa-2x"></i>
                                            </form>
                                         @endpermission   
                                        </div>
                               
                                    </td>
                                    @endpermission             
                          
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>

</div>
@endif
</section>
<script type="text/javascript">
    $(document).ready(function () {

        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',

        });
    });
</script>