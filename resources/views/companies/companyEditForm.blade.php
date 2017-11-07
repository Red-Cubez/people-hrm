@extends('layouts.app')
@section('content')
   <section class="edit-company-section">
        <div class="container">
            <div class="row row-content">
                <div class="col-xs-12 col-md-9 col-md-offset-3">
        <!-- Display Validation Errors -->
    @include('common.errors')
    <!-- Update Company Form -->
        <form action="{{ url('companies/'.$company->id)}}" class="form-horizontal" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <!-- Company Names -->
            @include('companies/companyForm')

        </form>
        </div>
        </div>
        </div>
        </section>
    
@endsection