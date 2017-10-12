
<div  class="form-group">
    <label for="role Name" class="col-sm-3 control-label">User Name</label>
    <div class="col-sm-6">
           {{$user->name}}
    </div>
</div>
<div  class="form-group">
    <label for="role Name" class="col-sm-3 control-label">User Email</label>
    <div class="col-sm-6">
           {{$user->email}}
    </div>
</div>
<div class="form-group">
    <label for="displayName" class="col-sm-3 control-label">User Roles</label>
    <div class="col-sm-6">
        <select name="roles[]" multiple>
          @foreach($roles as $role)
          <option value="{{$role->id}}" @if(in_array($role->id,$userRoles)) selected @endif>
          {{$role->name}}
          </option>
          @endforeach
</select>
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-3 col-sm-6">
        <button type="submit" class="btn btn-default">
            <i class="fa fa-plus"></i> {{isset($user)? "Update": "Add"}} User Roles
        </button>
    </div>
</div>

