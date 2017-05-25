@if (count($companyProfileModel->employeesBirthday) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>BirthDay This Month</h3>
        </div>

        <div class="panel-body">
            <table class="table table-striped task-table">
                <!-- Table Headings -->
                <thead>
                <th>Employee First Name</th>
                <th>Employee Last Name</th>
                <th>Date of Birth</th>
                </thead>
                <!-- Table Body -->
                <tbody>
                {{--<ol type="1">--}}
                {{--@foreach($companyProfileModel->employeesBirthday as $employee)--}}
                {{--<li>{{$employee->firstName}}--}}
                {{--&nbsp--}}
                {{--{{$employee->lastName}}--}}

                {{--&nbsp ---}}
                {{--&nbsp--}}

                {{--({{date("d-M",strtotime(($employee->birthDate)))}})--}}
                {{--</li>--}}
                {{--@endforeach--}}

                {{--</ol>--}}
                @foreach ($companyProfileModel->employeesBirthday as $employee)
                    <tr>
                        <!--  Name -->
                        <td class="table-text">
                            <div>{{ $employee->firstName }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $employee->lastName}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ date("d-M",strtotime(($employee->birthDate))) }}</div>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endif



