<?php

Route::group(['middleware' => ['web']], function () {
	Route::get('/employeetimesheet/{employeeId}/create/', 'Usman\Timesheet\Http\EmployeeTimesheetController@createTimesheet');
	Route::post('/employeetimesheet/timesheet/getweekdates', 'Usman\Timesheet\Http\EmployeeTimesheetController@getWeekDates');
	Route::resource('employeetimesheet', 'Usman\Timesheet\Http\EmployeeTimesheetController');
});
