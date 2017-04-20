  <div class="form-group">
        <label for="contactPerson" class="col-sm-3 control-label">Street Line 1</label>
            <div class="col-sm-6">
                <input type="text" name="streetLine1" id="streetLine1" class="form-control" @if(isset($client))
                 value="{{$client->address->streetLine1 }}" @else placeholder="Enter Street Line 1" @endif >
            </div>
 </div>
 <div class="form-group">
        <label for="contactPerson" class="col-sm-3 control-label">Street Line 2</label>
            <div class="col-sm-6">
                <input type="text" name="streetLine2" id="streetLine2" class="form-control" @if(isset($client))
                 value="{{$client->address->streetLine2}}" @else placeholder="Enter Street Line 2" @endif >
            </div>
 </div>
  <div class="form-group">
        <label for="contactPerson" class="col-sm-3 control-label">Country</label>
            <div class="col-sm-6">
                <input type="text" name="country" id="country" class="form-control" @if(isset($client))
                 value="{{$client->address->country}}" @else placeholder="Enter Country" @endif  >
            </div>
 </div>
 <div class="form-group">
        <label for="contactPerson" class="col-sm-3 control-label">State / Province</label>
            <div class="col-sm-6">
                <input type="text" name="stateProvince" id="stateProvince" class="form-control" @if(isset($client))
                 value="{{$client->address->stateProvince}}" @else placeholder="State / Province" @endif >
            </div>
 </div>

 <div class="form-group">
        <label for="contactPerson" class="col-sm-3 control-label">City</label>
            <div class="col-sm-6">
                <input type="text" name="city" id="city" class="form-control" @if(isset($client))
                 value="{{$client->address->city}}" @else placeholder="City" @endif >
            </div>
 </div>


