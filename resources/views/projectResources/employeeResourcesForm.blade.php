@if (count($availableEmployees) > 0)
    <div>
        <select name="employee_id" id="availableEmployeesList" >
            <option></option>
            @foreach ($availableEmployees as $availableEmployee)
                <option value="{{$availableEmployee->id}}" id="availableEmployees_{{$availableEmployee->firtstName}}">
                    {{$availableEmployee->firstName}}    {{$availableEmployee->lastName}}
                </option>
            @endforeach
        </select>
    </div>
@endif
