  <div class="form-group">
        <label for="contactPerson" class="col-sm-3 control-label">Street Line 1</label>
            <div class="col-sm-6">
                <input type="text" name="streetLine1" id="streetLine1" class="form-control" @if(isset($client->address) )
                 value="{{$client->address->streetLine1 }}" @elseif(isset($client) )
                     value="{{$client->streetLine1 }}" @elseif(isset($company->address) )
                     value="{{$company->address->streetLine1 }}" @elseif(isset($editEmployeeModel->streetLine1) )
                     value="{{$editEmployeeModel->streetLine1 }}" @else placeholder="Enter Street Line 1" @endif >
            </div>
 </div>
 <div class="form-group">
        <label for="contactPerson" class="col-sm-3 control-label">Street Line 2</label>
            <div class="col-sm-6">
                <input type="text" name="streetLine2" id="streetLine2" class="form-control" @if(isset($client->address))
                 value="{{$client->address->streetLine2}}"  @elseif(isset($client) )
                 value="{{$client->streetLine2 }}" @elseif(isset($company->address) )
                     value="{{$company->address->streetLine2 }}" @elseif(isset($editEmployeeModel->streetLine2) )
                     value="{{$editEmployeeModel->streetLine2 }}" @else placeholder="Enter Street Line 2" @endif >
            </div>
 </div>
  <div class="form-group">
        <label for="contactPerson" class="col-sm-3 control-label">Country</label>
            <div class="col-sm-6">
                <input type="text" name="country" id="country" class="form-control" @if(isset($client->address))
                 value="{{$client->address->country}}"  @elseif(isset($client) )
                 value="{{$client->country }}" @elseif(isset($company->address) )
                     value="{{$company->address->country }}" @elseif(isset($editEmployeeModel->country) )
                     value="{{$editEmployeeModel->country }}" @else placeholder="Enter Country" @endif  >
            </div>
 </div>
 <div class="form-group">
        <label for="contactPerson" class="col-sm-3 control-label">State / Province</label>
            <div class="col-sm-6">
                <input type="text" name="stateProvince" id="stateProvince" class="form-control" @if(isset($client->address))
                 value="{{$client->address->stateProvince}}"  @elseif(isset($client) )
                 value="{{$client->stateProvince }}" @elseif(isset($company->address) )
                     value="{{$company->address->stateProvince }}" @elseif(isset($editEmployeeModel->stateProvince) )
                     value="{{$editEmployeeModel->stateProvince }}" @else placeholder="State / Province" @endif >
            </div>
 </div>

 <div class="form-group">
        <label for="contactPerson" class="col-sm-3 control-label">City</label>
            <div class="col-sm-6">
                <input type="text" name="city" id="city" class="form-control" @if(isset($client->address))`
                 value="{{$client->address->city}}"  @elseif(isset($client) )
                 value="{{$client->city }}" @elseif(isset($company->address) )
                     value="{{$company->address->city }}" @elseif(isset($editEmployeeModel->city) )
                     value="{{$editEmployeeModel->city }}" @else placeholder="City" @endif >
            </div>
 </div>


