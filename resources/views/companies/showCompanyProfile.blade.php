@if (count($companyProfileModel->companyName) > 0)
<article class="showCompanyProfile">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Company Profile</h3>
        </div>
         <div class="panel-body">
            {{--<table class="table table-striped task-table">--}}
                <!-- Table Headings -->


                    <label for="name" class="control-label">Name : </label>

                    {{$companyProfileModel->companyName}}


                <div>

                    <label for="normalHoursPerWeek" class="control-label">Normal Hours / Week : </label>

                    {{$companyProfileModel->normalHoursPerWeek}}

                </div>
                <div>

                    <label for="applyOverTimeRule" class="control-label">Over Time Rule : </label>

                    @if(($companyProfileModel->applyOverTimeRule)==1)
                        Yes
                    @elseif(($companyProfileModel->applyOverTimeRule==0))
                        No
                    @endif

                </div>
                <div>
                    <label for="contactPerson" class="control-label">Street Line 1 : </label>

                    {{$companyProfileModel->streetLine1 }}

                </div>
                <div>
                    <label for="contactPerson" class="control-label">Street Line 2 : </label>

                    {{$companyProfileModel->streetLine2 }}

                </div>
                <div>
                    <label for="contactPerson" class="control-label">Country: </label>

                    {{$companyProfileModel->country }}

                </div>
                <div>
                    <label for="contactPerson" class="control-label">State / Province : </label>

                    {{$companyProfileModel->stateProvince }}

                </div>

                <div>
                    <label for="contactPerson" class="control-label">City</label>

                    {{$companyProfileModel->city }}
                </div>
            {{--</table>--}}


       
        @permission(StandardPermissions::editUpdateCompany)
        <div class="padTop20">
           <div class="pull-right padTop5">
        <a href="/companies/{{$companyProfileModel->companyId}}/edit">
            <button class="button button50"> Edit Company

            </button></a>
           </div>
             <div class="pull-right padTop5">
         <a href="/company-settings/{{$companyProfileModel->companyId}}">
            <button class="button button50"> Company Settings
            </button></a>
             </div>
        @endpermission
        @permission(StandardPermissions::registerUser)
        <div class="pull-right padTop5">
        <a href="/register-user/{{$companyProfileModel->companyId}}">
            <button class="button button50"> Setup New User

            </button>
         </a>
        </div>
        </div>
         </div>
         @endpermission  
    </div>
</article>
  @endif





