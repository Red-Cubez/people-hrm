@extends('layouts.app')

@section('content')

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

         <form action="{{ url('clients/'.$client->id)}}" class="form-horizontal" method="POST">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
       <input type="hidden" name="companyId" value="{{$companyId}}">
      <!-- Client Name -->
      @include('clients/clientForm')
    </form>
  </div>
  @endsection