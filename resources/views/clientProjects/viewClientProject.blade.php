
@extends('layouts.app')

@section('content')

@include('viewProject/viewProject')

 <form action="{{ url('clientprojects/'.$project->projectId.'/edit') }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('GET') }}

    <button type="submit" class="btn btn-primary">
      <i class="fa fa-trash"> Edit</i>
    </button>
</form>


@endsection