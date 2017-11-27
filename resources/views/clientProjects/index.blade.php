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
     <section class="clientProjectFormSection">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="row row-content">
                        <div class="col-xs-12 col-md-9 col-md-offset-3">
                          @include('common.errors')
                          <form id="projectForm" name="projectForm" class="form-horizontal">
                             {{ csrf_field() }}
                             <div class="form-group" >
                               <input type="hidden" name="clientId" value=" {{$clientId}}">
                               <input type="hidden" name="action" id="action" value="save">

                              {{-- <input type="hidden" name="companyId" value="s{{$companyId}} "> --}}
                              </div>
                            @include('clientProjects/clientProjectForm')

                            </form>
                            </div>
                       </div>
                    </div>
                </div>
           </div>
    </section>
@endsection