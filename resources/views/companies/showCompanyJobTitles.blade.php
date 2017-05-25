@if (count($companyProfileModel->jobTitles) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Company Job Titles</h3>
        </div>

        <div class="panel-body">
            <table class="table table-striped task-table">
                <!-- Table Headings -->
                <thead>
                <th>Job Title Name</th>
                </thead>
                <!-- Table Body -->
                <tbody>

                @foreach ($companyProfileModel->jobTitles as $companyJobTitle)
                    <tr>
                        <!--  Name -->
                        <td class="table-text">
                            <div>{{$companyJobTitle }}</div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>



@endif







