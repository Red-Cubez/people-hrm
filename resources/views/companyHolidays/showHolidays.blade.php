<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Company Holidays
        </h3>
    </div>
    <div class="panel-body">
        @if (count($companyProfileModel->companyHolidays) > 0)
        <table class="table table-striped task-table">
            <!-- Table Headings -->
            <thead>
                <th>
                    Holiday Name
                </th>
                <th>
                    Start Date
                </th>
                <th>
                    End Date
                </th>
                <th>
                    Total Holidays
                </th>
                <th>
                    Operations
                </th>
                <th>
                </th>
            </thead>
            <!-- Table Body -->
            <tbody>
                @foreach ($companyProfileModel->companyHolidays as $companyHoliday)
                <tr>
                    <!--  Name -->
                    <td class="table-text">
                        <div>
                            {{ $companyHoliday->holidayName }}
                        </div>
                    </td>
                    <td class="table-text">
                        <div>
                            {{ $companyHoliday->startDate }}
                        </div>
                    </td>
                    <td class="table-text">
                        <div>
                            {{ $companyHoliday->endDate }}
                        </div>
                    </td>
                    <td class="table-text">
                        <div>
                            {{ $companyHoliday->countHolidays }}
                        </div>
                    </td>
                    <td>
                        <form action="{{ url('companyholidays/'.$companyHoliday->holidayId.'/edit') }}" method="POST">
                            {{ csrf_field() }}
                                {{ method_field('GET') }}
                            <button class="btn btn-danger" type="submit">
                                <i class="fa fa-trash">
                                    Edit
                                </i>
                            </button>
                        </form>
                    </td>
                    <!-- Delete Button -->
                    <td>
                        <form action="{{ url('companyholidays/'.$companyHoliday->holidayId) }}" method="POST">
                            {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            <input name="companyId" type="hidden" value="{{$companyProfileModel->companyId}}">
                                <button class="btn btn-danger" type="submit">
                                    <i class="fa fa-trash">
                                        Delete
                                    </i>
                                </button>
                            </input>
                        </form>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <form action="{{ url('companyholidays/') }}" method="POST">
        {{ csrf_field() }}
            {{ method_field('GET') }}
        <input name="companyId" type="hidden" value="{{$companyProfileModel->companyId}}">
            <button class="btn btn-danger" type="submit">
                <i class="fa fa-trash">
                    Add Holidays
                </i>
            </button>
        </input>
    </form>
</div>
