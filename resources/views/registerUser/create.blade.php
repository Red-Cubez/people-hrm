@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    @if(count($nonRegisteredEmployees)>0)
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="{{url('register-user') }}">
                                {{ csrf_field() }}
                                <div class="row ">
                                    <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label for="name">Name</label>
                                            <input id="name" type="text" class="form-control" name="name"
                                                   value="{{ old('name') }}" required autofocus>
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email">E-Mail Address</label>
                                            <input id="email" type="email" class="form-control" name="email"
                                                   value="{{ old('email') }}" required>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
                                        <div class="form-group{{ $errors->has('employee') ? ' has-error' : '' }}">
                                            <label for="employee">Select Employee</label>
                                            <select class="form-control" id="employee" name="employee" required>
                                                <option></option>
                                                @foreach($nonRegisteredEmployees as $employee)
                                                    <option value="{{$employee->id}}">
                                                        {{$employee->firstName.' '.$employee->lastName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('employee'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('employee') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password">Password</label>
                                            <input id="password" type="password" class="form-control" name="password"
                                                   required>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
                                        <div class="form-group">
                                            <label for="password-confirm">Confirm Password</label>
                                            <input id="password-confirm" type="password" class="form-control"
                                                   name="password_confirmation" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Register</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="panel-body">
                            No Employees To Show
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
