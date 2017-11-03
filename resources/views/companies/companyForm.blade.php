 <div class="row ">
        <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" @if(isset($company))
        value="{{ $company->name }}" @else placeholder="Enter Name" @endif required />
            </div>
        </div>
    </div>
     <div class="row ">
        <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
            <div class="form-group">
               <label for="normalHoursPerWeek">Normal Hours / Week</label>
               <input type="number" step="any" name="normalHoursPerWeek" id="normalHoursPerWeek" class="form-control"
               @if(isset($company))
               value="{{ $company->normaHoursPerWeek }}" @else placeholder="Enter Normal Hours Per Week" @endif />
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
<div class="form-group">
    <label for="applyOverTimeRule" >Apply Over Time Rule</label>
     
        <input type="checkbox" value="1" name="applyOverTimeRule" id="applyOverTimeRule" class="checkbox-inline"
               @if(isset($company))
               @if(($company->applyOverTimeRule)==1)

               value="1" checked

                @endif
                @endif 
        />
   
</div>
</div>
</div>
@include('address/addressForm')

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-6">
        <button type="submit" class="btn btn-default">

            <i class="fa fa-plus"></i> {{isset($company)? "Update": "Add"}} Company
        </button>
    </div>
</div>






