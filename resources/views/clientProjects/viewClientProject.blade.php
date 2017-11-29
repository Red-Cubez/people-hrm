@extends('layouts.app')
@section('content')
    <div class="container-fluid">
         <div class=" display-flex">
            <div class="companyProject-item-1">

                @include('viewProject/viewProject')
                
               {{--  @permission(StandardPermissions::createEditClientProject)
                <a href="/clientprojects/{{$project->projectId}}/edit">
                    <button class="btn btn-primary"> Edit</button></a>
                @endpermission --}}
            </div>
            <div class="companyProject-item-2">
                @include('showGraph/showProjectGraph')

            </div>
        </div>
    </div>
@endsection