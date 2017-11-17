<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

/**
 * Add New Task
 */
Route::post('/task', function (Request $request) {

    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task       = new People\Models\Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/');
});

/**
 * Delete Task
 */
Route::delete('/task/{task}', function (People\Models\Task $task) {

    $task->delete();

    return redirect('/');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/employees/showemployeeform/{companyId}', 'EmployeeController@showEmployeeForm');
Route::post('/employees/validateform', 'EmployeeController@validateEmployeeForm');
Route::resource('employees', 'EmployeeController');

Route::get('/clients/showclientform/{companyId}', 'ClientController@showClientForm');
Route::resource('clients', 'ClientController');

Route::post('/clientprojects/validateform', 'ClientProjectController@validateProjectForm');
Route::resource('clientprojects', 'ClientProjectController');

Route::post('/companyprojects/validateform', 'CompanyProjectController@validateProjectForm');
Route::resource('companyprojects', 'CompanyProjectController');

Route::post('/projectresources/validateform', 'ProjectResourceController@validateResourceForm');
Route::resource('projectresources', 'ProjectResourceController');

Route::post('/companyprojectresources/validateform', 'CompanyProjectResourceController@validateResourceForm');
Route::resource('companyprojectresources', 'CompanyProjectResourceController');

Route::resource('jobtitle', 'JobTitleController');
Route::resource('companyholidays', 'CompanyHolidayController');

Route::get('/clients/{clientid}/createproject', 'ClientProjectController@createProject');

Route::resource('company/department', 'CompanyDepartmentController');
Route::resource('companies', 'CompanyController');

Route::get('company-settings/createSettings/{companyId}', 'CompanySettingController@createSettings');
Route::resource('company-settings', 'CompanySettingController');

Route::get('/employeetimesheet/{employeeId}/create/', 'EmployeeTimesheetController@createTimesheet');
Route::post('/employeetimesheet/timesheet/getweekdates', 'EmployeeTimesheetController@getWeekDates');
Route::get('/employeestimesheets/', 'EmployeeTimesheetController@showNonApprovedTimesheetsOfEmployees');
Route::post('/employeestimesheets/approve', 'EmployeeTimesheetController@approveTimesheets');
Route::resource('employeetimesheet', 'EmployeeTimesheetController');

//Route::get('/employeetimeoff/{employeeId}/create/', 'EmployeeTimeoffController@createTimeOff');

Route::get('/employeetimeoff/{employeeId}/create', ['middleware' => ['permission:create/edit-timeoff'], 'uses' => 'EmployeeTimeoffController@createTimeOff']);

Route::post('/employeetimeoff/timeoff/validatetimeoffdates', 'EmployeeTimeoffController@validateTimeoffDates');
Route::get('/employeestimeoffs/', 'EmployeeTimeoffController@showNonApprovedTimeoffsOfEmployees');
Route::post('/employeestimeoffs/approve', 'EmployeeTimeoffController@approveTimeoffs');
Route::resource('employeetimeoff', 'EmployeeTimeoffController');

Route::get('/clientprojects/{clientProjectid}/projectresources', 'ProjectResourceController@manageressources');

Route::get('/projectresources/{projectResourceid}/updateResource', 'ProjectResourceController@updateressources');

Route::get('/companies/{companyid}/companyprojects', 'CompanyProjectController@manageProject');

Route::resource('roles', 'RoleController');
Route::resource('user-roles', 'UserRolesController');

Route::get('register-user/{companyid}', 'RegisterUserController@createUser');
Route::post('register-user', 'RegisterUserController@register');
//Route::resource('register-user', 'RegisterUserController');

//Reports
Route::get('/company/{companyId}/reports', 'ReportsController@showOptions');
Route::post('/company/{companyId}/projects/report', 'ReportsController@showAllProjectsReport');
Route::post('/company/{companyId}/internal-projects/report', 'ReportsController@showInternalProjectsReport');
Route::post('/company/{companyId}/client-projects/report', 'ReportsController@showClientProjectsReport');
Route::post('/company/projects/report/generateReport', 'ReportsController@generateReport');
Route::post('/company/projects/report/export', 'ReportsController@export');

//Route::get('pdfview',array('as'=>'pdfview','uses'=>'ItemController@pdfview'));
//jasper reports
Route::get('/company-reports', 'JasperReportController@index')->name("company-reports.index");
Route::post('/company-reports/internal-projects/generate-report', 'JasperReportController@internalProjectsReport')->name("company-reports.internal-projects-report");