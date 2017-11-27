@extends('layouts.app')
@section('content')
    <article class="main-heading">
        <div class="container">
            <div class="row-content100">
                <div class="col-xs-12">
                    <h1 class="text-center">Employee Update</h1>
                </div>
            </div>
        </div>
    </article>
    <section class="editEmployeeSection">
        <div class="container">
            <div class="row row-content">
                <div class="col-xs-12 col-md-9 col-md-offset-3">
                    @include('common.errors')
                    <form id="employeeForm" name="employeeForm" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" name="action" id="action" value="update">
                        <input type="hidden" name="employeeId" id="employeeId"
                               value="{{$editEmployeeModel->employeeProfile->employeeId}}">
                        @include('employees/employeeForm')
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection