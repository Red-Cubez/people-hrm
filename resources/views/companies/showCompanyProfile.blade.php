@if (count($companyProfileModel->companyName) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Company Profile</h3>
        </div>

        <div class="panel-body">
            <table class="table table-striped task-table">
                <!-- Table Headings -->
                <div>

                    <label for="name" class="control-label">Name : </label>

                    {{$companyProfileModel->companyName}}

                </div>
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
            </table>

        </div>

        <a href="/companies/{{$companyProfileModel->companyId}}/edit">
            <button class="btn btn-primary"> Edit Companay

            </button></a>

        {{--<form action="{{ url('companies/'.$companyProfileModel->companyId.'/edit') }}" method="POST">--}}
            {{--{{ csrf_field() }}--}}
            {{--{{ method_field('GET') }}--}}

            {{--<button type="submit" class="btn btn-primary">--}}
                {{--<i class="fa fa-trash"> Edit Company</i>--}}
            {{--</button>--}}
        {{--</form>--}}
    </div>

@endif





