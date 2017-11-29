<article class="role-form">
    <div class="row ">
        <div class="col-xs-12 col-sm-7">
            <div class="form-group">
                <label for="name"  >Name</label>
                <input type="text" name="name" id="name" class="form-control"
                           @if (isset($role->name)) value="{{ $role->name }}"
                           @else placeholder="Enter Name" @endif required />
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-xs-12 col-sm-7">
            <div class="form-group">
                <label for='display_name' >Display Name</label>
                <input type="text" name="display_name" id="display_name" class="form-control"
                           @if (isset($role->display_name)) value="{{ $role->display_name }}"
                           @else placeholder="Enter Display Name" @endif required />
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-xs-12 col-sm-7">
            <div class="form-group">
                <label for='description'  >Description</label>
                <textarea name="description" form="roleForm" id="description"
                              class="form-control"/>@if(isset($role->description))
                        {{$role->description}}
                    @else  @endif</textarea>
            </div>
        </div>
    </div>

    @if (count($permissions) > 0)
        <div class="row ">
            <div class="col-xs-12 col-sm-7">
        <div class="form-group">
            <h3 >Permissions</h3>
            @foreach ($permissions as $key=>$permission)
                <div >
                    <input type="checkbox" name="permissions[]" value="{{ $key }}"
                           @if(isset($role->perms))
                           @foreach ($role->perms as $perm)
                           @if($perm->id == $key)
                           checked
                            @endif
                            @endforeach
                            @endif
                    /> {{ $permission}}
                </div>
            @endforeach

        </div>
            </div>
        </div>
    @endif
    <button type="submit" class="button button40 ">
        <i class=""></i> {{isset($role)? "Update": "Add"}} Role
    </button>

</article>
