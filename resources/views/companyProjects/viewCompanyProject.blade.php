
@extends('layouts.app')

@section('content')

@include('viewProject/viewProject')

<form action="{{ url('companyprojects/'.$project->projectId) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('GET') }}

    <button type="submit" class="btn btn-danger">
       <i class="fa fa-trash"> Edit</i>
    </button>
</form>

@endsection