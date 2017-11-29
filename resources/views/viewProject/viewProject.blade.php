<section class="viewProjectSection">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel-body">
                     @include('common.errors')
                        <div class="col-md-4 ">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <label for="name" class="control-label">Project Name : </label>
                                          {{$project->name}}
                                </li>
                                <li class="list-group-item">
                                <label for="contactNumber" class="control-label">Expected Start Date : </label>
                                    {{$project->expectedStartDate}}
                                </li>
                                <li class="list-group-item">
                                    <label for="contactNumber" class="control-label">Expected End Date : </label>
                                      {{$project->expectedEndDate}}
                               </li>
                                <li class="list-group-item">
                                      <label for="contactNumber" class="control-label">Actual Start Date : </label>
                                        {{$project->actualStartDate}}
                               </li>
                               <li class="list-group-item">
                                    <label for="contactEmail" class="control-label">Actual End Date : </label>
                                        {{$project->actualEndDate}}
                                </li>
                                <li class="list-group-item">
                                      <label for="contactPerson" class="control-label">budget : </label>
                                             {{$currencySymbol.' '.$project->budget}}
                                </li>
                                <li class="list-group-item">
                                     <label for="contactPerson" class="control-label">Cost : </label>
                                           {{$currencySymbol.' '.$project->cost}}
                                </li>
                                <li class="list-group-item">
                                          Project is {{$project->isProjectOnTime }}
                                </li>
                                <li class="list-group-item">
                                    {{$project->isProjectOnBudget }}
                                </li>
            
                                
                                @permission([
                                             StandardPermissions::createEditCompanyProject,
                                             StandardPermissions::createEditClientProject
                                            ])
                                    <li class="list-group-item">
                                            <span class="group ">
                                                @if(isset($isClientProject))
                                              
                                                        <a href="/clientprojects/{{$project->projectId}}/edit">
                                                        <i class="fa fa-pencil-square-o fa-2x"></i>
                                                        </a>
                                        
                                                @else
                                                    <a href="/companyprojects/{{$project->projectId}}/edit">
                                                        <i class="fa fa-pencil-square-o fa-2x"></i>
                                                    </a>
                                                @endif
                                           </span>
                                    </li>    
                                @endpermission
                              
                           </ul>
                        </div>
               </div>  
            </div>
       </div>
    </div>   
    
</section>