@extends('layouts.app')

@section('content')

    @include('viewProject/viewProject')

    <form action="{{ url('companyprojects/'.$project->projectId.'/edit') }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('GET') }}

        <button type="submit" class="btn btn-primary">
            <i class="fa fa-trash"> Edit</i>
        </button>
    </form>

    <form action="{{ url('companyprojectresources/'.$project->projectId) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('GET') }}

        <button type="submit" class="btn btn-primary">
            <i class="fa fa-trash"> Add Resource</i>
        </button>
        @include('CompanyProjectResources/viewCompanyProjectResources')
    </form>



@endsection