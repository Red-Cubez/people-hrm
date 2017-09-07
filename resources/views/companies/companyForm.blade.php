@role('admin')
<div class="form-group">
    <label for="name" class="col-sm-3 control-label">Name</label>
    <div class="col-sm-6">
        <input type="text" name="name" id="name" class="form-control" @if(isset($company))
        value="{{ $company->name }}" @else placeholder="Enter Name" @endif required>
    </div>
</div>
<div class="form-group">

    <label for="normalHoursPerWeek" class="col-sm-3 control-label">Normal Hours / Week</label>
    <div class="col-sm-6">
        <input type="number" step="any" name="normalHoursPerWeek" id="normalHoursPerWeek" class="form-control"
               @if(isset($company))
               value="{{ $company->normaHoursPerWeek }}" @else placeholder="Enter Normal Hours Per Week" @endif >
    </div>
</div>
<div class="form-group">
    <label for="applyOverTimeRule" class="col-sm-3 control-label">Apply Over Time Rule</label>
    <div class="checkbox-inline">
        <input type="checkbox" value="1" name="applyOverTimeRule" id="applyOverTimeRule"
               @if(isset($company))
               @if(($company->applyOverTimeRule)==1)
               value="1" checked

                @endif
                @endif >
    </div>
</div>
@include('address/addressForm');

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-6">
        <button type="submit" class="btn btn-default">

            <i class="fa fa-plus"></i> {{isset($company)? "Update": "Add"}} Company
        </button>
    </div>
</div>
@endrole





