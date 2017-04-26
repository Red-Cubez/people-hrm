<!-- Current Companies -->
@if(count($companies)>0)
<div class="panel panel-default">
  <div class="panel-heading">
    {{-- display all Companies --}}
    <h3>Current Companies</h3>
  </div>

  <div class="panel-body">
   <table class="table table-striped task-table">
    <!-- Table Headings -->
    <thead>
     <th>Name</th>
     <th>Street Line 1</th>
     <th>Street Line 2</th>
      <th>Country</th>
     <th>State / Province</th>
     <th>City</th>

     <th>Operations</th>
     </thead>
     <!-- Table Body -->
     <tbody>
       @foreach($companies as $company)
       <tr>
         <!-- Companies Names -->
         <td class="table-text">{{$company->name}}</td>

         @if(isset($company->address))


         <td class="table-text">{{ $company->address->streetLine1 }}</td>
         <td class="table-text">{{$company->address->streetLine2}}</td>
         <td class="table-text">{{$company->address->country}}</td>
         <td class="table-text">{{$company->address->stateProvince}}</td>
         <td class="table-text">{{$company->address->city}}</td>
         @else
         <td class="table-text"></td>
         <td class="table-text"></td>
         <td class="table-text"></td>
         <td class="table-text"></td>
         <td class="table-text"></td>
         @endif

         <!-- Update Button -->
         <td>
           <form action="{{url('companies/'.$company->id) }}" method="POST">

             {{ csrf_field() }}
             {{ method_field('GET') }}
             <button type="submit" class="btn btn-danger">
               Edit
             </button>
           </form>
           <!-- Delete Button -->
           <form action="{{url('companies/'.$company->id) }}" method="POST">
             {{ csrf_field() }}
             {{ method_field('DELETE') }}
             <button type="submit" class="btn btn-danger">
               Delete
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