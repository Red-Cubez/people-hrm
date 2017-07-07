<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Current Employees
        </h3>
    </div>
    <div class="panel-body">
        @if (count($companyProfileModel->companyEmployees) > 0)
            <table class="table table-striped task-table">
                <!-- Table Headings -->
                <thead>
                <th>
                    First Name
                </th>
                <th>
                    Last Name
                </th>
                <th>
                    Hire Date
                </th>
                <th>
                    Operation
                </th>
                </thead>
                <!-- Table Body -->
                <tbody>
                @foreach ($companyProfileModel->companyEmployees as $employee)
                    <tr>
                        <!--  Name -->
                        <td class="table-text">
                            <div>
                                {{ $employee->firstName }}
                            </div>
                        </td>
                        <td class="table-text">
                            <div>
                                {{ $employee->lastName}}
                            </div>
                        </td>
                        <td class="table-text">
                            <div>
                                {{ $employee->hireDate}}
                            </div>
                        </td>
                        <td>
                            <form action="{{ url('employees/'.$employee->employeeId) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('GET') }}
                                <input name="companyId" type="hidden" value="{{$companyProfileModel->companyId}}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-trash">
                                        View
                                    </i>
                                </button>
                                </input>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            No Record Found
        @endif
    </div>
    <form action="{{ url('employees/') }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('GET') }}
        <input name="companyId" type="hidden" value="{{$companyProfileModel->companyId}}">
        <button class="btn btn-primary" type="submit">
            <i class="fa fa-trash">
                Add new Employee
            </i>
        </button>
        </input>
    </form>
</div>