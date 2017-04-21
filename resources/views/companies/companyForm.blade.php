     <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-6">
                <input type="text" name="name" id="name" class="form-control" @if(isset($company)) 
                value="{{ $company->name }}" @else placeholder="Enter Name" @endif required >
            </div>
        </div>
      
         <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                <i class="fa fa-plus"></i> {{isset($company)? "Update": "Add"}} Company
                </button>
            </div>
        </div>
        
         



