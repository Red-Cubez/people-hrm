@extends('layouts.app')

@section('content')
<div class="panel-body">
    @include('common.errors')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>
                Reports
            </h1>
        </div>
        <div class="panel-body">
            <table class="table table-striped task-table">

            @permission(StandardPermissions::showAllProjectsReport)
                <div>
                    <form action="{{url('company/'.$companyId.'/projects/report')}}" class="form-horizontal" id="dateForm" method="POST" name="dateForm" role="form">
                        {{ csrf_field() }}
                        <a href="/company/{{$companyId}}/all-projects/report">
                            <button class="btn btn-primary">
                                All Projects Report
                            </button>
                        </a>
                        @include('reports/dateForm')
                    </form>
                </div>
            @endpermission
            @permission(StandardPermissions::showInternalProjectsReport)
                <div>
                    <form action="{{url('company/'.$companyId.'/internal-projects/report')}}" class="form-horizontal" id="dateForm" method="POST" name="dateForm" role="form">
                        {{ csrf_field() }}
                        <a href="/company/{{$companyId}}/internal-projects/report">
                            <button class="btn btn-primary">
                                Internal Projects Report
                            </button>
                        </a>
                        @include('reports/dateForm')
                    </form>
                </div>
            @endpermission
            @permission(StandardPermissions::showClientProjectsReport)
                <div>
                    <form action="{{url('company/'.$companyId.'/client-projects/report')}}" class="form-horizontal" id="dateForm" method="POST" name="dateForm" role="form">
                        {{ csrf_field() }}
                        <a href="/company/{{$companyId}}/client-projects/report">
                            <button class="btn btn-primary">
                                Client Projects Report
                            </button>
                        </a>
                        @include('reports/dateForm')
                    </form>
                </div>
            @endpermission
            </table>
        </div>
    </div>
</div>
@endsection
