<article class="addressFormArticle">
    <div class="row ">
        <div class="col-xs-12 col-sm-7">
            <div class="form-group">
                <label for="contactPerson">Street Line 1</label>
                <input type="text" name="streetLine1" id="streetLine1" class="form-control" maxlength="255"
                       @if(isset($client->address) )
                       value="{{$client->address->streetLine1 }}" @elseif(isset($client) )
                       value="{{$client->streetLine1 }}" @elseif(isset($company->address) )
                       value="{{$company->address->streetLine1 }}"
                       @elseif(isset($editEmployeeModel->employeeProfile->streetLine1) )
                       value="{{$editEmployeeModel->employeeProfile->streetLine1 }}"
                       @else placeholder="Enter Street Line 1" @endif >
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-xs-12 col-sm-7">
            <div class="form-group">
                <label for="contactPerson">Street Line 2</label>
                <input type="text" name="streetLine2" id="streetLine2" class="form-control" maxlength="255"
                       @if(isset($client->address))
                       value="{{$client->address->streetLine2}}" @elseif(isset($client) )
                       value="{{$client->streetLine2 }}" @elseif(isset($company->address) )
                       value="{{$company->address->streetLine2 }}"
                       @elseif(isset($editEmployeeModel->employeeProfile->streetLine2) )
                       value="{{$editEmployeeModel->employeeProfile->streetLine2 }}"
                       @else placeholder="Enter Street Line 2" @endif >
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-7">
            <div class="form-group">
                <label for="contactPerson">City</label>
                <input type="text" name="city" id="city" class="form-control" maxlength="255"
                       @if(isset($client->address))`
                       value="{{$client->address->city}}" @elseif(isset($client) )
                       value="{{$client->city }}" @elseif(isset($company->address) )
                       value="{{$company->address->city }}" @elseif(isset($editEmployeeModel->employeeProfile->city) )
                       value="{{$editEmployeeModel->employeeProfile->city }}" @else placeholder="City" @endif >
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-xs-12 col-sm-7">
            <div class="form-group">
                <label for="contactPerson">State / Province</label>
                <input type="text" name="stateProvince" id="stateProvince" class="form-control" maxlength="255"
                       @if(isset($client->address))
                       value="{{$client->address->stateProvince}}" @elseif(isset($client) )
                       value="{{$client->stateProvince }}" @elseif(isset($company->address) )
                       value="{{$company->address->stateProvince }}"
                       @elseif(isset($editEmployeeModel->employeeProfile->stateProvince) )
                       value="{{$editEmployeeModel->employeeProfile->stateProvince }}"
                       @else placeholder="State / Province" @endif >
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-xs-12 col-sm-7">
            <div class="form-group">
                <label for="contactPerson">Country</label>
                <input type="text" name="country" id="country" class="form-control" maxlength="255"
                       @if(isset($client->address))
                       value="{{$client->address->country}}" @elseif(isset($client) )
                       value="{{$client->country }}" @elseif(isset($company->address) )
                       value="{{$company->address->country }}"
                       @elseif(isset($editEmployeeModel->employeeProfile->country) )
                       value="{{$editEmployeeModel->employeeProfile->country }}"
                       @else placeholder="Enter Country" @endif >
            </div>
        </div>
    </div>
</article>
