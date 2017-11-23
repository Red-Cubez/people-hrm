<article class="companyAddForm">
    <div class="row">
        <div class="col-xs-12  col-sm-7">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" maxlength="255" @if(isset($company))
                value="{{ $company->name }}" @else placeholder="Enter Name" @endif required/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-7 ">
            <div class="form-group">
                <label for="normalHoursPerWeek">Normal Hours / Week</label>
                <input type="number" step="any" name="normalHoursPerWeek" id="normalHoursPerWeek" class="form-control"
                       @if(isset($company))
                       value="{{ $company->normaHoursPerWeek }}"
                       @else placeholder="Enter Normal Hours Per Week" @endif />
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-xs-12 col-sm-7 ">
            <div class="form-group">
                <label for="applyOverTimeRule">Apply Over Time Rule</label>
                <input type="checkbox" value="1" name="applyOverTimeRule" id="applyOverTimeRule" class="checkbox-inline"
                       @if(isset($company))
                       @if(($company->applyOverTimeRule)==1) value="1" checked @endif @endif/>
            </div>
        </div>
    </div>
    @include('address/addressForm')
    <div class="row">
        <div class="row-content100">
            <div class="col-xs-12 col-sm-3 col-sm-offset-4">
                <div class="form-group">
                    <button type="submit" class="button button40">

                        <i class="fa fa-plus"></i> {{isset($company)? "Update": "Add"}} Company
                    </button>
                </div>
            </div>
        </div>
    </div>
</article>
 





