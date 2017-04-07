@extends('layouts.app')

@section('content')

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New client Form -->
        <form action="{{url('clients/'.$client->id)}}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <!-- client Name -->
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Name</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="name" class="form-control" value="{{$client->name}}" >

                </div>
            </div>
            
            <div class="form-group">
                <label for="contactNumber" class="col-sm-3 control-label">Contact Number</label>

                <div class="col-sm-6">
                    <input type="Number" name="contactNumber" id="contactNumber" class="form-control" 
                    value="{{$client->contactNumber}}">
                    
                </div>
            </div>

            <div class="form-group">
                <label for="contactEmail" class="col-sm-3 control-label">Contact Email</label>

                <div class="col-sm-6">
                    <input type="Email" name="contactEmail" id="contactEmail" class="form-control"
                    value="{{$client->contactEmail}}">
                    
                </div>
            </div>

            <div class="form-group">
                <label for="contactPerson" class="col-sm-3 control-label">Contact Person</label>

                <div class="col-sm-6">
                    <input type="text" name="contactPerson" id="contactPerson" class="form-control"
                    value="{{$client->contactPerson}}">
                    
                </div>
            </div>

            <!-- Add client Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus">Update client</i> 
                    </button>
                </div>
            </div>
        
        </form>
    </div>
       