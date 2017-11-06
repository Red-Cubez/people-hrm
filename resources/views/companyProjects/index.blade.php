@extends('layouts.app')
@section('content')
<article class="main-heading">
        <div class="container">
            <div class="row-content100">
                <div class="col-xs-12">
                    <h1 class="text-center">Company Projects</h1>
                </div>
            </div>
        </div>
    </article>
 
     <section class="companyProjectSection">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="row row-content">
                        <div class="col-xs-12 col-md-9 col-md-offset-3">
        <!-- Display Validation Errors -->
        @include('common.errors')
        <!-- New company Project Form -->
        <form id="projectForm" name="projectForm" class="form-horizontal">
            {{ csrf_field() }}

               <input type="hidden"  name="companyid" value="{{$companyid}}">
               <input type="hidden" name="action" id="action" value="save">

            <!-- Project Name -->
            @include('companyProjects/companyProjectForm')
         </form>
         </div>
         </div>
         </div>
         </div>
         </div>
         </section>
@endsection