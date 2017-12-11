<form id="jobTitleModalForm">
<div aria-labelledby="favoritesModalLasbel" class="modal fade" id="jobTitleModal" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
                <h4 class="modal-title" id="editJobTitleModalLabel">
                    Job Title
                </h4>
            </div>
            <input type="hidden" id="toBeUpdatedJobTitle">
            <div class="modal-body">
                <div class="form-group">
                    <label for="jobTitleName">
                        Job Title Name:
                    </label>
                    <input class="form-control" id="jobTitleName" name="jobTitleName" type="text" required>
                    </input>
                </div>
            </div>
            <div class="modal-footer funcModalJobTitle">
            <div class="aParent">
                {{-- <button class="button button40 pull-right" data-dismiss="modal"  type="button">
                    Close
                </button> --}}
                 <button class="button button40 pull-right" id="addUpdateJobTitleButton" onclick="addUpdateJobTitle()" type="button">
                    </button>
               </div>
            </div>
        </div>
    </div>
</div>
</form>
