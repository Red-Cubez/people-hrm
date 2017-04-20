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
     <th>Operations</th>
     </thead>
     <!-- Table Body -->
     <tbody>
       @foreach($companies as $company)
       <tr>
         <!-- Companies Names -->
         <td class="table-text">{{$company->name}}</td>
         <!-- Update Button -->
         <td>
           <form action="{{url('companies/'.$company->id) }}" method="POST">

             {{ csrf_field() }}
             {{ method_field('GET') }}
             <button type="submit" class="btn btn-danger">
               UPDATE
             </button>
           </form>
           <!-- Delete Button -->
           <form action="{{url('companies/'.$company->id) }}" method="POST">
             {{ csrf_field() }}
             {{ method_field('DELETE') }}
             <button type="submit" class="btn btn-danger">
               DELETE
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