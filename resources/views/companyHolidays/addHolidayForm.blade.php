
<div class="form-group">
    <label for="companyproject" class="col-sm-3 control-label">Holiday Name</label>
    <div class="col-sm-6">
        <input type="text" name="name" id="name" class="form-control" @if(isset($holiday->name)) value="{{$holiday->name}}"  @else placeholder="Enter Name" @endif required>
    </div>
</div>
<div class="form-group">
    <label for="companyproject" class="col-sm-3 control-label">Start Date</label>

    <div class="col-sm-6">
        <input type="date" name="startDate" id="startDate" class="form-control"
               @if(isset($holiday->startDate)) value="{{$holiday->startDate}}" @else placeholder="Enter expected Start Date" @endif required >
    </div>
</div>
<div class="form-group">
    <label for="companyproject" class="col-sm-3 control-label">End Date</label>

    <div class="col-sm-6">
        <input type="date" name="endDate" id="endDate" class="form-control" @if(isset($holiday->endDate)) value="{{$holiday->endDate}}" @else placeholder="Enter Expected End Date" @endif >
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-6">
        <button type="button" id="save" class="btn btn-default" onclick="formSubmit();">
            <i class="fa fa-plus"></i> {{isset($holiday)? "Update": "Add"}} Holiday

        </button>

    </div>
</div>

@section('page-scripts')
<script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>

<script type="text/javascript">

function formSubmit()
{
    var areDatesValid = this.areDatesValid();
    if(areDatesValid)
    {
        var formValid = $('#saveForm').validate();
         if (formValid) {
            $("#saveForm").submit();
         }
         else
         {
            alert('form has errors');
         }
    }
    else
    {
         alert("Enter Corrrect End Date");
    }
}
function areDatesValid()
{
     var startDate = $("#startDate").value;
    var endDate = $("#endDate").value;
    if(endDate<startDate)
    {
     return false;
    }
    return true;
}
</script>
@endsection