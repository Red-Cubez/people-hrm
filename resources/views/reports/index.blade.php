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
                <div>
                   <form class="form-horizontal" role="form" name="dateForm" id="dateForm" method="POST" action="{{url('company/'.$companyId.'/all-projects/report')}}">
                        {{ csrf_field() }}
                    <a href="/company/{{$companyId}}/all-projects/report">
                        <button class="btn btn-primary">
                            All Projects Report
                        </button>
                    </a>
                    @include('reports/dateForm')

                </form>
                </div>
                <div>
              
             <form class="form-horizontal" role="form" name="dateForm" id="dateForm" method="POST" action="{{url('company/'.$companyId.'/internal-projects/report')}}">
                        {{ csrf_field() }}

                <a href="/company/{{$companyId}}/internal-projects/report">
                    <button class="btn btn-primary">
                        Internal Projects Report
                    </button>
                </a>
                @include('reports/dateForm')
            </form>
            </div>
            <div>
                 <form class="form-horizontal" role="form" name="dateForm" id="dateForm" method="POST" action="{{url('company/'.$companyId.'/client-projects/report')}}">
                        {{ csrf_field() }}
                <a href="/company/{{$companyId}}/client-projects/report">
                    <button class="btn btn-primary">
                        Client Projects Report
                    </button>
                </a>
                @include('reports/dateForm')
            </form>
            </div>
            </table>
        </div>
    </div>
</div>
@endsection
