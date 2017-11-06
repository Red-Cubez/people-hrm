@permission(StandardPermissions::createEditClient)
<div class="row ">
        <div class="col-xs-12 col-sm-7   ">
<div class="form-group">
    <label for="name"  >Name</label>

     
        <input type="text" name="name" id="name" class="form-control" @if(isset($client)) value="{{$client->name}}"
               @else placeholder="Enter Name" @endif  required>

    
</div>
</div>
</div>
<div class="row ">
        <div class="col-xs-12 col-sm-7   ">
<div class="form-group">
    <label for="contactPerson"  >Contact Person</label>

    
        <input type="text" name="contactPerson" id="contactPerson" class="form-control" @if(isset($client))
        value="{{$client->contactPerson}}" @else placeholder="Enter Contact Person" @endif >

    
</div>
</div>
</div>
<div class="row ">
        <div class="col-xs-12 col-sm-7   ">
<div class="form-group">
    <label for="contactNumber"  >Contact Number</label>

    
        <input type="Number" name="contactNumber" id="contactNumber" class="form-control" @if(isset($client))
        value="{{$client->contactNumber}}" @else placeholder="Enter Contact Number" @endif >

   
</div>
</div>
</div>
<div class="row ">
        <div class="col-xs-12 col-sm-7   ">
<div class="form-group">
    <label for="contactEmail"  >Contact Email</label>

     
        <input type="Email" name="contactEmail" id="contactEmail" class="form-control" @if(isset($client))
        value="{{$client->contactEmail}}" @else placeholder="Enter contact Email" @endif >

     
</div>
</div>
</div>

@include('address/addressForm')
<div class="row">
        <div class="row-content100">
 <div class="col-xs-12 col-sm-3 col-sm-offset-4">
<div class="form-group">
    
        <button type="submit" class="button button40">
            <i class="fa fa-plus"></i> {{isset($client)? "Update": "Add"}} client
        </button>
    
</div>
</div>
</div>
</div>
@endpermission