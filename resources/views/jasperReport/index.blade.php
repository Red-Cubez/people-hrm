@extends('layouts.app')

@section('content')
<div class="panel-body">
    @include('common.errors')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>
                Company Reports
            </h1>
        </div>
        <div class="panel-body">
            <table class="table table-striped task-table">
                <div>
                   {{--  <form action="{{url('company/projects/report')}}" class="form-horizontal" id="dateForm" method="GET" name="dateForm" role="form">
                        {{ csrf_field() }} --}}
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" type="button">
                                Employees With Houlry Rate
                                <span class="caret">
                                </span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/company-reports/employees-with-hourly-rate/pdf">
                                        pdf
                                    </a>
                                </li>
                                <li>
                                    <a href="/company-reports/employees-with-hourly-rate/xls">
                                        excel
                                    </a>
                                </li>
                                <li>
                                    <a href="/company-reports/employees-with-hourly-rate/docx">
                                        word
                                    </a>
                                </li>
                            </ul>
                        </div>
                   {{--  </form> --}}
                </div>
            </table>
        </div>
    </div>
</div>
@endsection
