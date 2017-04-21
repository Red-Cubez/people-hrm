<div class="form-group">
                <label for="name" class="col-sm-3 control-label">Name</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="name" class="form-control" @if(isset($client)) value="{{$client->name}}"
                    @else placeholder="Enter Name" @endif  required>

                </div>
            </div>

            <div class="form-group">
                <label for="contactNumber" class="col-sm-3 control-label">Contact Number</label>

                <div class="col-sm-6">
                    <input type="Number" name="contactNumber" id="contactNumber" class="form-control" @if(isset($client))
                    value="{{$client->contactNumber}}" @else placeholder="Enter Contact Number" @endif  >

                </div>
            </div>

            <div class="form-group">
                <label for="contactEmail" class="col-sm-3 control-label">Contact Email</label>

                <div class="col-sm-6">
                    <input type="Email" name="contactEmail" id="contactEmail" class="form-control" @if(isset($client))
                    value="{{$client->contactEmail}}" @else placeholder="Enter contact Email" @endif  >

                </div>
            </div>

            <div class="form-group">
                <label for="contactPerson" class="col-sm-3 control-label">Contact Person</label>

                <div class="col-sm-6">
                    <input type="text" name="contactPerson" id="contactPerson" class="form-control" @if(isset($client))
                    value="{{$client->contactPerson}}" @else placeholder="Enter Contact Person" @endif  >

                </div>
            </div>
            @include('address/addressForm')



            <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                <i class="fa fa-plus"></i> {{isset($client)? "Update": "Add"}} client
                </button>
            </div>
        </div>