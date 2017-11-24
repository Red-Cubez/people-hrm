@extends('layouts.app')
@section('content')
<article class="main-heading">
        <div class="container">
            <div class="row-content100">
                <div class="col-xs-12">
                    <h1 class="text-center">Register</h1>
                </div>
            </div>
        </div>
    </article>
    <section>
    <div class="container">
        <div class="row row-content">
            <div class="col-xs-12 col-md-9 col-md-offset-3">
                @if(count($nonRegisteredEmployees)>0)
                      <form class="form-horizontal" role="form" method="POST" action="{{url('register-user') }}">
                                {{ csrf_field() }}
                                <div class="row ">
                                    <div class="col-xs-12 col-sm-7   ">
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
                                    <div class="col-xs-12 col-sm-7   ">
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
                                    <div class="col-xs-12 col-sm-7  ">
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
                                    <div class="col-xs-12 col-sm-7   ">
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
                                    <div class="col-xs-12 col-sm-7">
                                        <div class="form-group">
                                            <label for="password-confirm">Confirm Password</label>
                                            <input id="password-confirm" type="password" class="form-control"
                                                   name="password_confirmation" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-xs-12 col-sm-7  ">
                                        <div  class="padTop20">
                                            <button type="submit" class="button button40 pull-right">Register</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        
                    @else
                         <div> 
                            No Employees To Show
                        </div>
                    @endif
               
            </div>
        </div>
    </div>
    </section>
@endsection
