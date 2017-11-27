<div class="row ">
    <div class="col-xs-12 col-sm-7   ">
        <div class="form-group">
            <label for="currencyname">Currency Name</label>
            <input type="text" name="currencyName" id="currencyname" class="form-control"
                       @if(isset($companySetting)) value="{{$companySetting->currencyName}}" @endif  required/>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xs-12 col-sm-7  ">
        <div class="form-group">
            <label for="currencysymbol">Currency Symbol</label>
            <input type="text" name="currencySymbol" id="currencysymbol" @if(isset($companySetting->currencySymbol))
            value="{{$companySetting->currencySymbol}}" @endif class="form-control"  required/>
        </div>
    </div>
</div>
<div class="row">
    <div class="row-content100">
        <div class="col-xs-12 col-sm-9 col-sm-3 col-sm-offset-3">
        <div class="form-group">
            <button type="submit" class="button button40">
                {{isset($companySetting)? "Update": "Add"}} Company Settings
            </button>
        </div>
    </div>
</div>
</div>


