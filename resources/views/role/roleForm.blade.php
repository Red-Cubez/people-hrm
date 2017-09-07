
<div  class="form-group">
    <label for="role Name" class="col-sm-3 control-label">Name</label>
    <div class="col-sm-6">
        <input type="text" name="name" id="name" class="form-control"
               @if(isset($role->name)) value="{{$role->name}}"
               @else placeholder="Role Name" @endif required>
    </div>
</div>
<div class="form-group">
    <label for="displayName" class="col-sm-3 control-label">Display Name</label>
    <div class="col-sm-6">
        <input type="text" name="displayName" id="displayName" class="form-control"
               @if(isset($role->display_name)) value="{{$role->display_name}}"
               @else placeholder="Display Name" @endif  required>
    </div>
</div>
<div class="form-group">
    <label for="roleDescription" class="col-sm-3 control-label">Description</label>
    <div class="col-sm-6">
            <textarea name="description" id="description" rows="5" cols="50">
                @if(isset($role->description)) 
                {{$role->description}}
                @endif 
            </textarea>
          
    </div>
</div>



<div class="form-group">
    <div class="col-sm-offset-3 col-sm-6">
        <button type="submit" class="btn btn-default">
            <i class="fa fa-plus"></i> {{isset($role)? "Update": "Add"}} Role
        </button>
    </div>
</div>