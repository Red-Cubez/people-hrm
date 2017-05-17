
<div class="panel-body">
    @include('common.errors')
    <div>
        <label for="name" class="control-label">Project Name : </label>
            {{$project->name}}
    </div>
     <div>
        <label for="contactNumber" class="control-label">Expected Start Date : </label>
            {{$project->expectedStartDate}}
    </div>
     <div>
        <label for="contactNumber" class="control-label">Expected End Date : </label>
            {{$project->expectedEndDate}}
    </div>
    <div>
        <label for="contactNumber" class="control-label">Actual Start Date : </label>
            {{$project->actualStartDate}}
    </div>

    <div>
        <label for="contactEmail" class="control-label">Actual End Date : </label>
            {{$project->actualEndDate}}
    </div>

    <div>
        <label for="contactPerson" class="control-label">budget : </label>
            {{$project->budget}}
    </div>

    <div>
        <label for="contactPerson" class="control-label">Cost : </label>
            {{$project->cost }}
    </div>
    <div>
            Project is {{$project->isProjectOnTime }}
    </div>
    <div>
             {{$project->isProjectOnBudget }}
    </div>