
<div  class="form-group">
    <label for="role Name" class="col-sm-3 control-label">Currency Name</label>
    <div class="col-sm-6">
           <input type="text" name="currencyName" @if(isset($companySetting)) value="{{$companySetting->currencyName}}" @endif  required/> 
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-6">
        <button type="submit" class="btn btn-default">
            <i class="fa fa-plus"></i> {{isset($companySetting)? "Update": "Add"}} Company Settings
        </button>
    </div>
</div>

