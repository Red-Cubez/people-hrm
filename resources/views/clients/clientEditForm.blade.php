@extends('layouts.app')
@section('content')
    <section class="clientEditForm">
        <div class="container">
            <div class="row row-content">
                <div class="col-xs-12 col-md-9 col-md-offset-3">
                    @include('common.errors')
                    <form action="{{ url('clients/'.$client->id)}}" class="form-horizontal" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" name="companyId" value="{{$companyId}}">
                        @include('clients/clientForm')
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection