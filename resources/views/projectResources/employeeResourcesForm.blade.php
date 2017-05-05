 <form action="{{ url('projectresources/') }}" method="POST" class="form-horizontal">
   {{ csrf_field() }}
   {{ method_field('POST') }}

   @if (count($availableEmployees) > 0)
    <div class="panel panel-default">
     <div class="panel-heading">
       Current Available Employees
     </div>
    
    <div class="panel-body">
       <table class="table table-striped task-table">
          <!-- Table Headings -->
          <thead>
             <th>Employees</th>
             <th>&nbsp;</th>
          </thead>
          <!-- Table Body -->
          <tbody>
             <select class="form-control" name="employee_id" id="availableEmployeesList">
               @foreach ($availableEmployees as $availableEmployee)
                 <option  value="{{$availableEmployee->id}}" id="availableEmployees_{{$availableEmployee->firtstName}}">
                   {{$availableEmployee->firstName}}
                 </option>
               @endforeach
            </select>
          </tbody>
        </table>
    </div>

           <input type="hidden" name="clientProjectid" value="{{ $clientProjectid }}">
              @include('projectResources/fixedResourcesForm') 

  </form>
  </div>    
   @endif