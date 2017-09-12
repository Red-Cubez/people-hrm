<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Company Departments
        </h3>
    </div>
    <div class="panel-body">

        <table class="table table-striped task-table">
            <!-- Table Headings -->
            <thead>
            <th>
                Department Name
            </th>
            @role(['hr-manager','manager','admin'])
            <th>
                Operations
            </th> 
            @endrole 
            </thead>
            <!-- Table Body -->
            <tbody id="departmentTableBody">
            @if (count($companyProfileModel->departments) > 0)
                @foreach ($companyProfileModel->departments as $department)
                    <tr id="department_{{$department->departmentId}}">
                        <!--  Name -->
                        <td id="departmentName_{{$department->departmentId}}" class="table-text">
                            <div>
                                {{ $department->departmentName }}
                            </div>
                        </td>
                        @role(['hr-manager','manager','admin'])
                        <td>
                            <button class="btn btn-primary"
                                    onclick="openDepartmentModal({{$department->departmentId}},null);"
                                    type="button">
                                <i class="">
                                    Edit
                                </i>
                            </button>
                     
                            <form  action="{{url('company/department/'.$department->departmentId) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger" data-toggle="confirmation" data-singleton="true">
                                        Delete
                                    </button>
                            </form>
                        </td>
                        @endrole
                    </tr>
                @endforeach

            @endif
            </tbody>
        </table>
    </div>
@role(['hr-manager','manager','admin'])
    <button class="btn btn-primary btn-lg" onclick="openDepartmentModal(null,null);" type="button">
        Add Department
    </button>
 @endrole   

</div>
@role(['hr-manager','manager','admin'])
 @include('companyDepartments/companyDepartmentModal')
@endrole 
@section('page-scripts')
    @parent
    <script type="text/javascript">

        function initializeDepartmentModal() {

            $("#departmentNotEnteredDiv").remove();
            $('#toBeUpdatedHoliday').val(null);
             $('#departmentModalForm')[0].reset();
        }
        function setupDepartmentEditValues(departmentId,departmentName) {

            if (departmentName == null) {
                var departmentNameValue = $('#departmentName_' + departmentId).text().trim();
            }
            else {
                var departmentNameValue = departmentName;
               

            }

            $("#departmentName").val(departmentNameValue);
            
        }
        function openDepartmentModal(departmentId, departmentName) {
            initializeDepartmentModal();

            if (departmentId !== null) {
                $('#toBeUpdatedDepartment').val(departmentId);
                setupDepartmentEditValues(departmentId,departmentName);
                $('#addUpdateDepartmentButton').html('Update Department');
            }
            else {
                $('#addUpdateDepartmentButton').html('Add Department');
            }
            $('#departmentModal').modal('show');
        }

       
        function addUpdateDepartment() {

                var form = $("#departmentModalForm");

                if (form.valid()) {

                    var departmentId = $('#toBeUpdatedDepartment').val();

                    if (departmentId == '' || departmentId === null) {
                        addDepartment();
                    }
                    else {
                        updateDepartment();
                    }
             }
           
        }
        function updateDepartment() {

            var departmentName = $("#departmentName").val();
           
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            departmentId = $('#toBeUpdatedDepartment').val();

            $.ajax({
                type: 'put',
                url: '/company/department/'+ departmentId,
                data: {
                    '_token': CSRF_TOKEN,
                    'name': departmentName,
                },
                success: function (data) {
                    if ((data.errors)) {
                        alert('errors');
                        $('.error').removeClass('hidden');
                        $('.error').text(data.errors.name);
                    }
                       if(!data.isFormValid)
                    {
                         
                         $("#departmentNotEnteredDiv").remove();
               
                          var html = '<div id="departmentNotEnteredDiv" class="alert alert-danger">Please Enter Department</div>';

                          $("#departmentName").before(html);
                    }
                     else {

                        $('#departmentModal').modal('toggle');

                        $('#departmentName').val(null);
                        $('#departmentId').val(null);
                        $('#departmentName_' + departmentId).text(data.jobTitle);
                        $('.error').remove();

                        var html=null;
                        html = createDepartmentHtmlRow(data);
                        $('#department_' + data.departmentId).html(html);

                        initializeConfirmationBox();
                    }
                },
            });
        }
      function createDepartmentHtmlRow(data)
      {
           return '\
                     <td id="departmentName_' + data.departmentId + ' " class="table-text" >\
                        <div >\
                            ' + data.departmentName + '\
                        </div>\
                    </td>\
                    <td >\
                        <button \
                        class="btn btn-primary" \
                        onclick="openDepartmentModal(\'' + data.departmentId + '\',\'' + data.departmentName + '\');" \
                        type="button"> \
                        Edit \
                        </button> \
                            <form action="{{url('company/department')}}/' + data.departmentId + ' " method="POST">\
                                    {{ csrf_field() }}\
                                    {{ method_field('DELETE') }}\
                                    <button type="submit" class="btn btn-danger" data-toggle="confirmation"\ data-singleton="true">\
                                        Delete\
                                    </button>\
                            </form>\
                    </td>';
      }
    
        function addDepartment() {

            var departmentName = $("#departmentName").val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  
            $.ajax({
                type: 'POST',
                url: '/company/department/',
                data: {
                    '_token': CSRF_TOKEN,
                    'name': departmentName,
                    'companyId':{{$companyProfileModel->companyId}}
                },
                success: function (data) {
        
                    if ((data.errors)) {
                        alert('errors');
                        $('.error').removeClass('hidden');
                        $('.error').text(data.errors.name);
                    }
                     if(!data.isFormValid)
                    {
                                                   
                         $("#departmentNotEnteredDiv").remove();
               
                          var html = '<div id="departmentNotEnteredDiv" class="alert alert-danger">Please Enter Department</div>';

                          $("#departmentName").before(html);
                    }
                     else {
          
                        $('#departmentModal').modal('toggle');
                        $('#departmentName').val(null);
                        var html=null;
                        html = '\
                           <tr id="department_' + data.departmentId + '">\
                            '+ createDepartmentHtmlRow(data);
                            '\
                           </tr>"\
                           ';
                        $("#departmentTableBody").append(html);
                        initializeConfirmationBox();
                    }
                }
            });
        }

    </script>
<script type="text/javascript">

$(document).ready(function(){
     $('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
    });
});
function initializeConfirmationBox()
{
    $('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
    });
}
</script>
@endsection
