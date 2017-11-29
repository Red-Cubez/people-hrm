@extends('layouts.app')
@section('content')
 <article class="main-heading">
        <div class="container">
            <div class="row-content100">
                <div class="col-xs-12">
                    <h1 class="text-center">Client Project</h1>
                </div>
            </div>
        </div>
    </article>
     <section class="edit-company-section">
        <div class="container">
            <div class="row row-content">
                <div class="col-xs-12 col-md-9 col-md-offset-3">

        @include('common.errors')
        <form id="projectForm" name="projectForm" class="form-horizontal" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="action" id="action" value="update">
            <input type="hidden" name="clientProjectId" id="clientProjectId" value="{{$clientProject->id}}">
            @include('clientProjects/clientProjectForm')
        </form>
        </div>
        </div>
        </div>
        </section>
  
@endsection