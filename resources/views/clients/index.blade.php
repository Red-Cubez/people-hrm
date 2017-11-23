@extends('layouts.app')
@section('content')
    <article class="main-heading">
        <div class="container">
            <div class="row-content100">
                <div class="col-xs-12">
                    <h1 class="text-center">Client</h1>
                </div>
            </div>
        </div>
    </article>
    <section class="clientSection">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="row row-content">
                        <div class="col-xs-12 col-md-9 col-md-offset-3">
                            @include('common.errors')
                            <form action="{{url('clients') }}" method="POST" class="form-horizontal">
                                {{ csrf_field() }}
                                <input type="hidden" name="companyId" value="{{$companyId}}">
                                @include('clients/clientForm')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection