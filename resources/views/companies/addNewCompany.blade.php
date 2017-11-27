@extends('layouts.app')
@section('content')
    <article class="main-heading">
        <div class="container">
            <div class="row-content100">
                <div class="col-xs-12">
                    <h1 class="text-center">Company</h1>
                </div>
            </div>
        </div>
    </article>
    <section class="company-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="row row-content">
                        <div class="col-xs-12 col-md-9 col-md-offset-3">
                            @include('common.errors')
                            <form action="{{url('companies') }}" method="POST" class="form-horizontal">
                                {{ csrf_field() }}
                                @include('companies/companyForm')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection