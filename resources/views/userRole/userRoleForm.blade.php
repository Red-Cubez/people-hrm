 <div class="row ">
        <div class="col-xs-12 col-sm-7  ">
<div  class="form-group">
    <label for="role Name" >User Name</label>
    <div class="form-control">
           {{$user->name}}
    </div>
</div>
</div>
</div>
<div class="row ">
        <div class="col-xs-12 col-sm-7  ">
<div  class="form-group">
    <label for="role Name" >User Email</label>
    <div class="form-control">
           {{$user->email}}
    </div>
</div>
</div>
</div>
<div class="row ">
        <div class="col-xs-12 col-sm-7   ">
<div class="form-group">
    <label for="displayName"  >User Roles</label>
         
        <select name="roles[]" multiple class="form-control">
          @foreach($roles as $role)
          <option value="{{$role->id}}" @if(in_array($role->id,$userRoles)) selected @endif>
          {{$role->name}}
          </option>
          @endforeach
      </select>
     
</div>
</div>
</div>
<div class="row ">
<div class="col-xs-12 col-sm-7  ">
<div class="form-group"> 
<button type="submit" class="button button40 pull-right">
              {{isset($user)? "Update": "Add"}} User Roles
   </button>
    
</div>
</div>
</div>
