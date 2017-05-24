<label for="birthdate">Birthday This Month:</label>

    <ol type="1">
        @foreach($companyProfileModel->employeesBirthday as $employee)
            <li>{{$employee->firstName}}
                &nbsp
                {{$employee->lastName}}

                &nbsp -
                &nbsp

                ({{date("d-M",strtotime(($employee->birthDate)))}})
            </li>
        @endforeach

    </ol>
