@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                @include('viewProject/viewProject')

                <form action="{{ url('clientprojects/'.$project->projectId.'/edit') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('GET') }}

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-trash"> Edit</i>
                    </button>
                </form>
            </div>
            <div class="col-sm-8">
                @include('showGraph/showProjectGraph')

            </div>
        </div>
    </div>

@endsection