<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Birthdays in {{date('F')}}
        </h3>
    </div>
    <div class="panel-body">
        @if (count($employeesWithBirthday) >0)
            <div class="scroll-panel-table table-responsive">
            <table class="table table-border-grey">
                <thead>
                <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>DoB</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($employeesWithBirthday as $employee)
                    <tr>
                        <td>{{ $employee->firstName }}</td>
                        <td >{{ $employee->lastName}}</td>
                        <td>{{ date("d-M",strtotime(($employee->birthDate))) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            No Record Found
        @endif
    </div>
</div>
</div>