 <div class="form-group">
                <label for="companyproject" class="col-sm-3 control-label">Project</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="name" class="form-control">
                </div>
            </div>

            <!-- Add companyproject Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Project
                    </button>
                </div>
            </div>
        </form>
    </div>
        <!-- Current companyprojects -->
    @if (count($companyprojects) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Projects
            </div>
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <!-- Table Headings -->
                    <thead>
                        <th>Project</th>
                        <th>&nbsp;</th>
                    </thead>
                    <!-- Table Body -->
                    <tbody>
                        @foreach ($companyprojects as $companyproject)
                            <tr>
                                <!-- companyproject Name -->
                                <td class="table-text">
                                    <div>{{ $companyproject->name }}</div>
                                </td>
                                <!-- Delete Button -->
                                <td>
                                    <form action="{{ url('companyprojects/'.$companyproject->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

    @endif