<div class="row ">
        <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
<div  class="form-group">
    <label for="role Name" >Currency Name</label>
    <div class="col-sm-6">
           <input type="text" name="currencyName" @if(isset($companySetting)) value="{{$companySetting->currencyName}}" @endif  required/> 
    </div>
</div>
</div>
</div>
<div class="row ">
        <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
<div  class="form-group">
    <label for="role Name" >Currency Symbol</label>
    <div class="col-sm-6">
           <input type="text" name="currencySymbol" @if(isset($companySetting->currencySymbol)) value="{{$companySetting->currencySymbol}}" @endif  required/> 
    </div>
</div>
</div>
</div>
<div class="row ">
        <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
<div class="form-group">
    
        <button type="submit" class="btn btn-default">
            <i class="fa fa-plus"></i> {{isset($companySetting)? "Update": "Add"}} Company Settings
        </button>
     
</div>
</div>
</div>


