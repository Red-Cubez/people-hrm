@extends('layouts.app')
@section('content')
    <section class="role-edit-section">
        <div class="container">
            <div class="row row-content">
                <div class="col-xs-12 col-md-9 col-md-offset-3">
                <!-- Display Validation Errors -->
                @include('common.errors')
                <form action="{{ route('roles.update',$role->id) }}" id='roleForm' method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    @include('roles.roleForm')
                </form>
            </div>
            </div>
        </div>
    </section>
@endsection
