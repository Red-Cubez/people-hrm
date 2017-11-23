@extends('layouts.app')
@section('content')
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