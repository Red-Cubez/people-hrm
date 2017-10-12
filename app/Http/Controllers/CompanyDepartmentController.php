<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\Department;
use People\Services\DepartmentService;
use People\Services\Interfaces\IDepartmentService;
use People\Services\Interfaces\IResourceFormValidator;
use People\Enums\StandardPermissions;

class CompanyDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $DepartmentService;
    public $ResourceFormValidator;

    public function __construct(IDepartmentService $departmentService, IResourceFormValidator $resourceFormValidator)
    {
        $this->middleware('auth');

        $this->middleware('permission:'.StandardPermissions::getPermissionName(StandardPermissions::createEditDeleteDepartment));

        $this->DepartmentService     = $departmentService;
        $this->ResourceFormValidator = $resourceFormValidator;

    }

    public function index()
    {

        $departments = $this->DepartmentService->getAllDepartments();

        return view('departments.index', ['departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $isFormValid = $this->ResourceFormValidator->validateDepartmentForm($request->name);

        if ($isFormValid) {
            $department = $this->DepartmentService->createDepartment($request);

            return response()->json(
                [
                    'departmentName' => $department->name,
                    'departmentId'   => $department->id,
                    'isFormValid'    => $isFormValid,
                ]);
        }
        if (!$isFormValid) {
            return response()->json(
                [

                    'isFormValid' => $isFormValid,
                ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \People\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return view('departments/update',
            ['department' => $department]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \People\Models\Depaertment  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \People\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $departmentId)
    {
        $isFormValid = $this->ResourceFormValidator->validateDepartmentForm($request->name);

        if ($isFormValid) {
            $department = $this->DepartmentService->updateDepartment($request, $departmentId);

            return response()->json(
                [
                    'departmentName' => $department->name,
                    'departmentId'   => $department->id,
                    'isFormValid'    => $isFormValid,
                ]);
        }
        if (!$isFormValid) {
            return response()->json(
                [

                    'isFormValid' => $isFormValid,
                ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \People\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($departmentId)
    {
      
        $this->DepartmentService->deleteDepartment($departmentId);

        return back();
    }
}
