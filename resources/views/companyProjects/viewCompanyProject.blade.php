
@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                @include('viewProject/viewProject')
                @role(['manager','admin'])
                <a href="/companyprojects/{{$project->projectId}}/edit">

                    <button class="btn btn-primary"> Edit

                    </button></a>
                @endrole
            </div>

            <div class="col-sm-8">
                @include('showGraph/showProjectGraph')

            </div>
        </div>

        <div class="row">
            <div class="col-sm-11">
                <a href="{{route('companyprojectresources.show', $project->projectId)}}"> <button class="btn btn-primary"> Add Resource </button></a>
                @include('CompanyProjectResources/viewCompanyProjectResources')

            </div>
        </div>
    </div>
@endsection