
@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                @include('internalProjectGraphs/monthlyCostGraph')

            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                @include('internalProjectGraphs/monthlyProfitGraph')

            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                @include('internalProjectGraphs/netTotalGraph')

            </div>
        </div>

    
    </div>
@endsection