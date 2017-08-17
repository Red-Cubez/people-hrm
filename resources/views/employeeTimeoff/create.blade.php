<div class="panel panel-default">
    @if(count($errors)>0)
    <div class="col-md-12 pull-left">
        <div class="form-group ">
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif
    <div class="panel-heading" id="timeoffDateDiv">
        <h3>
            Time Off
        </h3>
        Select Start Date:
        <input class="" id="startDate" name="startDate" required="" type="date">
        </input>
        <br/>
        Select End Date  :
        <input class="" id="endDate" name="endDate" required="" type="date">
        </input>
    </div>
    <input id="employeeId" name="employeeId" type="hidden" value="{{$employeeId}}">
        <button class="btn btn-primary" id="addTimeoffButton" name="addTimeoffButton" type="button">
            <i class="fa fa-trash">
                Add Time Off
            </i>
        </button>
    </input>
</div>
<script type="text/javascript">
    $(document).ready(function () {
      
        $("#addTimeoffButton").click(function () {
            var form=$(employeeTimeoffForm);
            if(form.valid())
            {
              if(validateStarAndEndDate())
              {
                 $("#endDateError").remove();
                 
                 var startDate = $("#startDate").val();
                 var endDate = $("#endDate").val();
                 var employeeId = $("#employeeId").val();
                 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

               $.ajax({
                 type: 'POST',
                 url: '/employeetimeoff/timeoff/validatetimeoffdates',
                 data: {
                        '_token': CSRF_TOKEN,
                        'startDate': startDate,
                        'endDate': endDate,
                        'employeeId': employeeId,
                       },
                 success: function (data) {
                    if (data.isAlreadyEntered == true) {
                        $("#startDate").val(null);
                         $("#endDate").val(null);
                        $("#alreadyEnteredMessage").remove();
                        html = '<div id="alreadyEnteredMessage">You Have already entered time Off for date ' + startDate + '</div>';
                        $("#timeoffDateDiv").before(html);
                      
                    }
                    if (data.isAlreadyEntered == false) {
                        form.submit();
                        $("#alreadyEnteredMessage").remove();
                       
                    }

                 },
                 error: function () {
                    alert("Bad submit ");
                 }
            });
          }
          else
          {
                     $("#endDate").val(null);
                     $("#endDateError").remove();
                     html = '<div id="endDateError">Start Date Can not be smaller than End Date </div>';
                     $("#timeoffDateDiv").before(html);
          }
        }
        });
    });
    function validateStarAndEndDate()
    {
            var startDate = $("#startDate").val();
            var endDate = $("#endDate").val();
            if(endDate<startDate)
            {
              return false;
            }
            else
            {
              return true;
            }
    }
</script>
@section('pageSpecificScripts')
@endsection
