@extends('layouts.app')
@section('content')
    <article class="main-heading">
        <div class="container">
            <div class="row-content100">
                <div class="col-xs-12">
                    <h1 class="text-center">Company Setting </h1>
                </div>
            </div>
        </div>
    </article>
    <section class="company-setting-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="row row-content">
                        <div class="col-xs-12 col-md-9 col-md-offset-3">
        @include('common.errors')
        <form action="{{url('company-settings/'.$companySetting->id) }}" class="form-horizontal" method="POST">
            {{ csrf_field() }}
            {{method_field('PUT')}}
            @include('companySettings/companySettingsForm')
        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
