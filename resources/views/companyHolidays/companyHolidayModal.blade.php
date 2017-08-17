<form id="holidayModalForm">
    <div aria-labelledby="favoritesModalLasbel" class="modal fade" id="holidayModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                    </button>
                    <h4 class="modal-title" id="holidayModalLabel">
                        Holiday
                    </h4>
                </div>
                <input type="hidden" id="toBeUpdatedHoliday">
                <div id="holidayNameDiv" class="modal-body">
                    <div class="form-group">
                        <label for="usr">
                            Holiday Name:
                        </label>
                        <input class="form-control" id="holidayName" name="holidayName" type="text" required>
                        </input>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="usr">
                            Start Date:
                        </label>
                        <input type="date" name="startDate" id="startDate" class="form-control" required>
                        </input>
                    </div>
                </div>
                <div id="endDateDiv" class="modal-body">
                    <div class="form-group">
                        <label for="usr">
                            End Date:
                        </label>
                        <input type="date" name="endDate" id="endDate" class="form-control">
                        </input>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">
                        Close
                    </button>
                    <span class="pull-right">
                        <button class="btn btn-primary" id="addUpdateHolidayButton"  onclick="addUpdateHoliday();"
                                type="button">
                        </button>
                    </span>
                </div>
            </div>
        </div>

    </div>
</form>



