@extends('layouts.app')

@section('content')

<div class="panel-body">
 <a class="btn btn-primary" role="button" data-toggle="collapse" href="#employees" aria-expanded="false" aria-controls="collapseExample"> Employees 
 </a>
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#fixedResources" aria-expanded="false" aria-controls="collapseExample"> Fixed Resources
  </button>

    <div class="collapse" id="employees">
      <div class="well">
         @include('projectResources/employeeResourcesForm')
      </div>
    </div>
    <div class="collapse" id="fixedResources">
      <div class="well">
        @include('projectResources/fixedResourcesForm') 
    </div>
    </div>
</div>
<div class="panel-body">
<!-- Display Validation Errors -->
@include('common.errors')
<!-- New clientProject Form -->
<form action="{{url('projectresources') }}" method="POST" class="form-horizontal">
{{ csrf_field() }}
<!-- Resource Name -->



@if (count($projectResources) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        Current Resources
    </div>
    <div class="panel-body">
        <table class="table table-striped task-table">
            <!-- Table Headings -->
            <thead>
                <th>Project</th>
                <th>&nbsp;</th>
            </thead>
            <!-- Table Body -->
            <tbody>
                @foreach ($projectResources as $projectResource)
                <tr>
                    <!-- clientProject Name -->
                    <td class="table-text">
                        @if(isset($projectResource->employee->firstName))
                        <div>{{ $projectResource->employee->firstName}}  {{$projectResource->employee->lastName}}</div>

                        @elseif (isset($projectResource->title))  
                        <div>{{ $projectResource->title}}</div>
                        @endif
                    </td>
                    <!-- Delete Button -->
                    <td>

                        <form action="{{ url('projectresources/'.$projectResource->id.'/updateResource') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('GET') }}

                          
                            
                            <button type="submit" class="btn btn-danger">
                             <input type="hidden" name="projectResourceId" value="{{$projectResource->id}}">
                             
                                <i class="fa fa-trash"> EDIT </i>

                            </button>
                        </form>
                        <form action="{{ url('projectresources/'.$projectResource->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash"> Delete </i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection