<form id="departmentModalForm">
    <div aria-labelledby="favoritesModalLasbel" class="modal fade" id="departmentModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                    </button>
                    <h4 class="modal-title" id="departmentModalLabel">
                        Department
                    </h4>
                </div>
                <input type="hidden" id="toBeUpdatedDepartment">
                <div id="departmentNameDiv" class="modal-body">
                    <div class="form-group">
                        <label for="usr">
                            Department Name:
                        </label>
                        <input class="form-control" id="departmentName" name="departmentName" type="text" required>
                        </input>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">
                        Close
                    </button>
                    <span class="pull-right">
                        <button class="btn btn-primary" id="addUpdateDepartmentButton"  onclick="addUpdateDepartment();"
                                type="button">
                        </button>
                    </span>
                </div>
            </div>
        </div>

    </div>
</form>



