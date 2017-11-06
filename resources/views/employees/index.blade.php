@extends('layouts.app')
@section('content')
<article class="main-heading">
        <div class="container">
            <div class="row-content100">
                <div class="col-xs-12">
                    <h1 class="text-center">Employee</h1>
                </div>
            </div>
        </div>
    </article>
     <section class="employeeSection">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="row row-content">
                        <div class="col-xs-12 col-md-9 col-md-offset-3">
        <!-- Display Validation Errors -->
    @include('common.errors')
  
        <form id="employeeForm" name="employeeForm" class="form-horizontal">
            {{ csrf_field() }}
            <input type="hidden" name="companyId" value="{{$companyId}}">
            <input type="hidden" name="action" id="action" value="save">
            @include('employees/employeeForm')

        </form>
        </div>
        </div>
        </div>
        </div>
        </div>
        </section>
@endsection