<div class="row ">
    <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control"
                   @if(isset($department)) value="{{ $department->name }}" @else placeholder="Name" @endif required>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
        <div class="form-group">
            <button type="submit" class="btn btn-default">
                {{isset($department)? "Update": "Add"}} Department
            </button>
        </div>
    </div>
</div>

