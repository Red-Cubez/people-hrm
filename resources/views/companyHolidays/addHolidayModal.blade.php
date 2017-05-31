<div aria-labelledby="favoritesModalLabel" class="modal fade" id="holidayModal" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
                <h4 class="modal-title" id="holidayModal">
                    Holiday
                </h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="Holiday">
                        Holiday Name
                    </label>
                    <input class="form-control" id="holidayName" type="text">
                    </input>
                </div>
                <div class="form-group">
                    <label for="start date">
                        Start Date
                    </label>
                    <input class="form-control" id="startDate" type="date">
                    </input>
                </div>
                <div class="form-group">
                    <label for="end date">
                        Holiday Name
                    </label>
                    <input class="form-control" id="endDate" type="date">
                    </input>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" type="button">
                    Close
                </button>
                <span class="pull-right">
                    <button class="btn btn-default" id="save" onclick="formSubmit();" type="button">
                        <i class="fa fa-plus">
                        </i>
                        {{isset($holiday)? "Update": "Add"}} Holiday
                    </button>
                </span>
            </div>
        </div>
    </div>
</div>