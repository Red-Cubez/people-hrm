
<div class="form-group">
        <label for="clientProject" class="col-sm-3 control-label">Name</label>
        <div class="col-sm-6">
            <input type="text" name="name" id="name" class="form-control" @if(isset($clientProject)) value="cleient" @elseif(isset($companyproject)) value="{{$companyproject->name}}" @else placeholder="Enter Name" @endif required>
        </div>
</div>

    <div class="form-group">
        <label for="clientProject" class="col-sm-3 control-label">Expected Start Date</label>

        <div class="col-sm-6">
            <input type="date" name="expectedStartDate" id="expectedStartDate" class="form-control"
            @if(isset($clientProject)) value="{{$clientProject->expectedStartDate}}" @elseif(isset($companyproject)) value="{{$companyproject->expectedStartDate}}" @else placeholder="Enter expected Start Date" @endif>
        </div>
    </div>
    <div class="form-group">
        <label for="clientProject" class="col-sm-3 control-label">Expected End Date</label>

        <div class="col-sm-6">
            <input type="date" name="expectedEndDate" id="expectedEndDate" class="form-control" @if(isset($clientProject)) value="{{$clientProject->expectedEndDate}}" @elseif(isset($companyproject)) value="{{$companyproject->expectedEndDate}}" @else placeholder="Enter Expected End Date" @endif >
        </div>
    </div>
    <div class="form-group">
        <label for="clientProject" class="col-sm-3 control-label">Actual Start Date</label>

        <div class="col-sm-6">
            <input type="date" name="actualStartDate" id="actualStartDate" class="form-control" @if(isset($clientProject)) value="{{$clientProject->actualStartDate}}" @elseif(isset($companyproject)) value="{{$companyproject->actualStartDate}}" @else placeholder="Enter Actual Start Date" @endif >
        </div>
    </div>
    <div class="form-group">
        <label for="clientProject" class="col-sm-3 control-label">Actual End Date</label>

        <div class="col-sm-6">
            <input type="date" name="actualEndDate" id="actualEndDate" class="form-control" @if(isset($clientProject)) value="{{$clientProject->actualEndDate}}" @elseif(isset($companyproject)) value="{{$companyproject->actualEndDate}}" @else placeholder="Enter Actual End Date" @endif>
        </div>
    </div>
    <div class="form-group">
        <label for="clientProject" class="col-sm-3 control-label">Budget</label>

        <div class="col-sm-6">
            <input type="number" name="budget" id="budget" class="form-control" @if(isset($clientProject)) value="{{$clientProject->budget}}" @elseif(isset($companyproject)) value="{{$companyproject->budget}}" @else placeholder="Enter budget" @endif >
        </div>
    </div>
    <div class="form-group">
        <label for="clientProject" class="col-sm-3 control-label">Cost</label>

        <div class="col-sm-6">
            <input type="number" name="cost" id="cost" class="form-control" @if(isset($clientProject)) value="{{$clientProject->cost}}" @elseif(isset($companyproject)) value="{{$companyproject->cost}}" @else placeholder="Enter cost" @endif >
        </div>
    </div>
          <!-- Add clientProject Button -->
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-default">
                <i class="fa fa-plus"></i> {{isset($companyproject)? "Update": "Add"}} Project
            </button>
        </div>
    </div>
</div>