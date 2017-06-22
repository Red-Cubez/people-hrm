

@if (count($availableEmployees) > 0)



    <div>


        <select name="employee_id" id="availableEmployeesList">
            <option></option>
            @foreach ($availableEmployees as $availableEmployee)
                <option value="{{$availableEmployee->id}}" id="availableEmployees_{{$availableEmployee->firtstName}}">
                    {{$availableEmployee->firstName}}    {{$availableEmployee->lastName}}
                </option>
            @endforeach
        </select>


    </div>

@endif
<script>
    function formSubmit() {
        var form = $('#resourceForm');
//            alert($('input[name=resource]:checked').val());

        if ($('input[name=resource]:checked').val() == 'employee') {
            $("#availableEmployeesList").prop('required', true);
        }
        if ($('input[name=resource]:checked').val() == ' ' || $('input[name=resource]:checked').val() == null) {
            alert("Select Resource Type");
        }
        else if (form.valid()) {
            if ($('input[name=resource]:checked').val() == 'fixed') {

                $("option:selected").prop("selected", false)

            }
            var areDatesValid = this.areDatesValid();

           // if (form.valid()) {

                // $(form).submit();
            //}


        }

    }
    function areDatesValid() {
        var form = $('#resourceForm');
        var expectedStartDate = $('#expectedStartDate').val();
        var expectedEndDate = $("#expectedEndDate").val();
        var actualStartDate = $("#actualStartDate").val();
        var actualEndDate = $("#actualEndDate").val();

        if ((expectedEndDate == '' || expectedEndDate==null )  && (actualEndDate=='' || actualEndDate==null)) {

            $("#expectedEndDate").prop('required', true);


        }
        form.valid();
//            alert(expectedStartDate);
//            alert(expectedEndDate);
//            alert(actualStartDate);
//            alert(actualEndDate);
//        alert(expectedStartDate);
    }


</script>