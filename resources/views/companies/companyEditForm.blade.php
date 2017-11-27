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
    <section class="edit-company-section">
        <div class="container">
            <div class="row row-content">
                <div class="col-xs-12 col-md-9 col-md-offset-3">
                    @include('common.errors')
                    <form action="{{ url('companies/'.$company->id)}}" class="form-horizontal" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        @include('companies/companyForm')
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection