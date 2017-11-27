@extends('layouts.app')
@section('content')
    <section class="role-section">
        <div class="container">
            <h1 class="text-center">Roles</h1>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row row-content">
                        <div class="col-xs-12 col-md-9 col-md-offset-3">
                            @include('common.errors')
                            <form action="{{ route('roles.store') }}" id='roleForm' method="POST"
                                  class="form-horizontal">
                                {{ csrf_field() }}
                                {{ method_field('POST') }}
                                @include('roles.roleForm')
                            </form>
                        </div>
                    </div>
                    <div class="row row-content">
                        <div class="col-xs-12 ">
                            @include("roles.show")
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
