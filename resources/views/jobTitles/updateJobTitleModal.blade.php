<div aria-labelledby="favoritesModalLabel" class="modal fade" id="editJobTitleModal" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
                <h4 class="modal-title" id="editJobTitleModalLabel">
                    Edit Job Title
                </h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="usr">
                        JobTitle:
                    </label>
                    <input class="form-control" id="jobTitleName" type="text">
                    </input>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" type="button">
                    Close
                </button>
                <span class="pull-right">
                    <button class="btn btn-primary" onclick="updateJobTitle()" type="button">
                        Update Job Title
                    </button>
                </span>
            </div>
        </div>
    </div>
</div>