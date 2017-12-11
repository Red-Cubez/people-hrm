@extends('layouts.app')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
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
                <div class="row">
               
                    <form action="{{url('company/'.$companyId.'/projects/report')}}" class="form-horizontal" id="dateForm" method="POST" name="dateForm" role="form">
                        {{ csrf_field() }}
                        <a href="/company/{{$companyId}}/all-projects/report">
                            <button class="button button40 btn-form-align">
                                All Projects Report
                            </button>
                        </a>
                        @include('reports/dateForm')
                    </form>
                    
                </div>
            @endpermission
            @permission(StandardPermissions::showInternalProjectsReport)
                <div class="row">
                    <form action="{{url('company/'.$companyId.'/internal-projects/report')}}" class="form-horizontal" id="dateForm" method="POST" name="dateForm" role="form">
                        {{ csrf_field() }}
                        <a href="/company/{{$companyId}}/internal-projects/report">
                            <button class="button button40 btn-form-align">
                                Internal Projects Report
                            </button>
                        </a>
                        @include('reports/dateForm')
                    </form>
                </div>
            @endpermission
            @permission(StandardPermissions::showClientProjectsReport)
                <div class="row">
                    <form action="{{url('company/'.$companyId.'/client-projects/report')}}" class="form-horizontal" id="dateForm" method="POST" name="dateForm" role="form">
                        {{ csrf_field() }}
                        
                        <a href="/company/{{$companyId}}/client-projects/report">
                            <button class="button button40 btn-form-align">
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
            </div>
        </div>
    </div>
</section>

@endsection
