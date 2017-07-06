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
<script>

    function formSubmit() {
        var expectedStartDate = $('#expectedStartDate').val();
        var expectedEndDate = $("#expectedEndDate").val();
        var actualStartDate = $("#actualStartDate").val();
        var actualEndDate = $("#actualEndDate").val();
        var startDate=null;
        var endDate=null;

        //startDate

        if(actualStartDate.length != 0)
        {
            startDate=actualStartDate;
        }
        else if(expectedStartDate.length != 0)
        {
            startDate=expectedStartDate;
        }

        //endDate
        if(actualEndDate.length!= 0)
        {
            endDate=actualEndDate;
        }

        else if(expectedEndDate.length != 0)
        {
            endDate=expectedEndDate;
        }

        console.log('Actual: ' +actualStartDate);
        console.log('Expected: ' +expectedStartDate);
        console.log('StartDate: ' +startDate);


        //var form = $('#resourceForm');
//        form.validate().form();
        form.validate({
            rules: {
                expectedEndDate: {
                    required: function () {
                        if (endDate == null) {
                            return true;
                        }
                        else {
                            return false;
                        }
                    }
                },
                expectedStartDate: {
                    required: function () {
                        if (startDate == null) {
                            console.log('For true: StartDate: ' +startDate);
                            console.log('required: true');
                            return true;
                        }
                        else {
                            console.log('For False: StartDate: ' +startDate);
                            console.log('required: false');
                            return false;
                        }
                    }
                },
            },
            //////////////
            messages: {
                expectedEndDate: {
                    required: function () {
                        if (endDate == null) {
                            return "Enter Expected End Date or Actual End Date";
                        }

//                        if ((startDate != '' || startDate != null) && (endDate != '' || endDate != null))  {
                           else if(endDate < startDate)
                            {
                                return "End Date can not less than start Date";
                            }
//                            return "Enter Expected Start Date or Actual Start Date";
                   //     }
                    }

                },
                expectedStartDate:{
                    required: function () {
                        if (startDate == null) {
                            return "Enter Expected Start Date or Actual Start Date";
                        }
                    }
                },

            }

        });
//        form.validate().form();
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
//    function areDatesValid() {
//        var form = $('#resourceForm');
////        var expectedStartDate = $('#expectedStartDate').val();
//        //   var expectedEndDate = $("#expectedEndDate").val();
////        var actualStartDate = $("#actualStartDate").val();
////        var actualEndDate = $("#actualEndDate").val();
////
////        if ((expectedEndDate == '' || expectedEndDate==null )  && (actualEndDate=='' || actualEndDate==null)) {
////
////            $("#expectedEndDate").prop('required', true);
////
////        }
//
////            alert(expectedStartDate);
////            alert(expectedEndDate);
////            alert(actualStartDate);
////            alert(actualEndDate);
////        alert(expectedStartDate);
//    }


</script>