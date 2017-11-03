 <div class="row ">
        <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
<div  class="form-group">
    <label for="role Name" >User Name</label>
    <div class="form-control">
           {{$user->name}}
    </div>
</div>
</div>
</div>
<div class="row ">
        <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
<div  class="form-group">
    <label for="role Name" >User Email</label>
    <div class="form-control">
           {{$user->email}}
    </div>
</div>
</div>
</div>
<div class="row ">
        <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
<div class="form-group">
    <label for="displayName"  >User Roles</label>
    <div class="form-control">
        <select name="roles[]" multiple>
          @foreach($roles as $role)
          <option value="{{$role->id}}" @if(in_array($role->id,$userRoles)) selected @endif>
          {{$role->name}}
          </option>
          @endforeach
</select>
    </div>
</div>
</div>
</div>
<div class="row ">
        <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">

<div class="form-group">
     
        <button type="submit" class="btn btn-default">
            <i class="fa fa-plus"></i> {{isset($user)? "Update": "Add"}} User Roles
        </button>
    
</div>
</div>
</div>
