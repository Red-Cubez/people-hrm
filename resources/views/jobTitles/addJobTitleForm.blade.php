<div class="form-group">
    <label for="Job Title" class="col-sm-3 control-label">Job Title</label>
    <div class="col-sm-6">

        <input type="text" name="jobTitle" id="jobTitle" class="form-control"
               @if(isset($jobTitle)) value="{{ $jobTitle->title }}"
               @else placeholder="Title"
               @endif required>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-6">
        <button type="submit" class="btn btn-default">
            <i class="fa fa-plus"></i> {{isset($jobTitle)? "Update": "Add"}} Job Title
        </button>
    </div>
</div>

