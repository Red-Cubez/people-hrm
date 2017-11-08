<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Birthdays in {{date('F')}}
        </h3>
    </div>
    <div class="panel-body">
        @if (count($employeesWithBirthday) >0)

            <table class="table table-fixed table-condensed table-border-grey">
                <thead>
                <tr>
                <th class="col-xs-4">First Name</th>
                <th class="col-xs-4">Last Name</th>
                <th class="col-xs-4">DoB</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($employeesWithBirthday as $employee)
                    <tr>
                        <td class="col-xs-4">
                            <div>
                                {{ $employee->firstName }}
                            </div>
                        </td>
                        <td class="col-xs-4">
                            <div>
                                {{ $employee->lastName}}
                            </div>
                        </td>
                        <td class="col-xs-4">
                            <div>
                                {{ date("d-M",strtotime(($employee->birthDate))) }}
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            No Record Found
        @endif
    </div>
</div>
