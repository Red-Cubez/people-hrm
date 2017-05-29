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

    $task = new People\Models\Task;
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

Route::resource('employees', 'EmployeeController');
Route::resource('clients', 'ClientController');
Route::resource('clientprojects', 'ClientProjectController');
Route::resource('companyprojects', 'CompanyProjectController');
Route::resource('projectresources', 'ProjectResourceController');
Route::resource('companyprojectresources', 'CompanyProjectResourceController');

Route::get('/updatejobtitle', 'JobTitleController@updateJobTitle');
Route::resource('jobtitle', 'JobTitleController');
Route::resource('companyholidays', 'CompanyHolidayController');


Route::get('/clients/{clientid}/clientprojects', 'ClientProjectController@manageProject');

Route::resource('departments', 'DepartmentController');
Route::resource('companies', 'CompanyController');

Route::get('/clientprojects/{clientProjectid}/projectresources', 'ProjectResourceController@manageressources');

Route::get('/projectresources/{projectResourceid}/updateResource', 'ProjectResourceController@updateressources');

Route::get('/companies/{companyid}/companyprojects', 'CompanyProjectController@manageProject');



