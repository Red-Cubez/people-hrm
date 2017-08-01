<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Timesheets
        </h3>
    </div>
    <div class="panel-body">
        @if (isset($timesheets) && count($timesheets)>0)
        <table class="table table-striped task-table">
            <!-- Table Headings -->
            <thead>
            <th>
                Week No and Year
            </th>
            <th>
               Billable
            </th>
            <th>
               Non Billable
            </th>

            <th>
                Operations
            </th>
            </thead>
            <!-- Table Body -->
            <tbody>
            @foreach ($timesheets as $timesheet)
            <tr>
                <!-- company->project Name -->
                <td class="table-text">
                    <div>
                        {{ $timesheet->weekNoAndYear }}
                    </div>
                </td>
                <td class="table-text">
                    <div>
                        <?php  $billableDays = $timesheet->billableWeeklyTimeSheet; ?>
                        {{$billableDays['friday']}}
                    </div>
                </td>
                <td class="table-text">
                    <div>
                        {{ $timesheet->nonBillableWeeklyTimesheet }}
                    </div>
                </td>
                <td>

                    <form action="{{ url('companyprojects/')}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button class="btn btn-danger" type="submit">
                            <i class="fa fa-trash">
                                EDIT
                            </i>
                        </button>

                    </form>
                    {{--<a href="/companyprojects/">--}}
                        {{--<button class="btn btn-primary"> View--}}

                        {{--</button>--}}
                    {{--</a>--}}
                    {{--<form action="{{ url('companyprojects/'.$project->projectId) }}" method="POST">--}}
                    {{--{{ csrf_field() }}--}}
                    {{--{{ method_field('GET') }}--}}
                    {{--<button class="btn btn-primary" type="submit">--}}
                    {{--<i class="fa fa-trash">--}}
                    {{--View--}}
                    {{--</i>--}}
                    {{--</button>--}}
                    {{--</form>--}}
                </td>
            </tr>
            @endforeach
            @else
            No Record Found
            @endif
            </tbody>
        </table>
    </div>

    {{--<form action="{{ url('/companies/'.$companyProfileModel->companyId.'/companyprojects') }}" method="POST">--}}
    {{--{{ csrf_field() }}--}}
    {{--{{ method_field('GET') }}--}}
    {{--<button class="btn btn-primary" type="submit">--}}
    {{--<i class="fa fa-trash">--}}
    {{--Add New Projects--}}
    {{--</i>--}}
    {{--</button>--}}
    {{--</form>--}}
</div>