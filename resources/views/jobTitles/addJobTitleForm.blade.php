<div class="row ">
    <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
        <div class="form-group">
            <label for="Job Title">Job Title</label>
            <input type="text" name="jobTitle" id="jobTitle" class="form-control" @if(isset($jobTitle))
            value="{{ $jobTitle->title }}" @else placeholder="Title" @endif required>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
        <div class="form-group">
            <button type="submit" class="btn btn-default">
                {{isset($jobTitle)? "Update": "Add"}} Job Title
            </button>
        </div>
    </div>
</div>

