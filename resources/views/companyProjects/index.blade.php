<?php
//dd($companies);
?>
@extends('layouts.app')

@section('content')
    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')
        <!-- New clientProject Form -->
        <form action="{{url('') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <!-- Project Name -->

            @include('projectForm/projectForm')

         </form>


    </div>
@endsection