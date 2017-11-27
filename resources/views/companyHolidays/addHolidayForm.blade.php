<div class="row ">
    <div class="col-xs-12  col-md-6 col-md-offset-3 col-sm-7 ">
        <div class="form-group">
            <label for="companyproject">Holiday Name</label>
            <input type="text" name="name" id="name" class="form-control" @if(isset($holiday->name))
            value="{{$holiday->name}}" @else placeholder="Enter Name" @endif required>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xs-12  col-md-6 col-md-offset-3 col-sm-7 ">
        <div class="form-group">
            <label for="companyproject">Start Date</label>
            <input type="date" name="startDate" id="startDate" class="form-control" @if(isset($holiday->startDate))
            value="{{$holiday->startDate}}" @else placeholder="Enter expected Start Date" @endif required>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xs-12  col-md-6 col-md-offset-3 col-sm-7 ">
        <div id="endDateDiv" class="form-group">
            <label for="companyproject">End Date</label>
            <input type="date" name="endDate" id="endDate" class="form-control" @if(isset($holiday->endDate))
            value="{{$holiday->endDate}}" @else placeholder="Enter Expected End Date" @endif >
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xs-12  col-md-6 col-md-offset-3 col-sm-7 ">
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="button" id="save" class="btn btn-default" onclick="formSubmit();">
                    <i class="fa fa-plus"></i> {{isset($holiday)? "Update": "Add"}} Holiday
                </button>
            </div>
        </div>
    </div>
</div>
@section('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
@endsection