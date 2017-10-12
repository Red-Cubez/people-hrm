<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use People\Models\User as User;
use People\Services\Interfaces\IEmployeeService;
use People\Services\Interfaces\IRoleService;
use People\Services\Interfaces\IUserAuthenticationService;
use People\Services\StandardPermissions;

class RegisterUserController extends Controller
{
    public $EmployeeService;
    public $UserAuthenticationService;
    public $RoleService;

    public function __construct(IUserAuthenticationService $userAuthenticationService, IEmployeeService $employeeService, IRoleService $roleService)
    {
        $this->middleware('auth');

        $this->middleware('permission:' . StandardPermissions::registerUser);

        $this->EmployeeService           = $employeeService;
        $this->UserAuthenticationService = $userAuthenticationService;
        $this->RoleService               = $roleService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    public function createUser($companyId)
    {

        // $isAdmin                             = $this->UserAuthenticationService->isAdmin();
        $isRequestedCompanyBelongsToEmployee = $this->UserAuthenticationService->isRequestedCompanyBelongsToEmployee($companyId);

        if ($isRequestedCompanyBelongsToEmployee) {
            $nonRegisteredEmployees = $this->EmployeeService->getNonRegisteredEmployees($companyId);
            if (isset($nonRegisteredEmployees)) {
                return view('registerUser/create',
                    [
                        'nonRegisteredEmployees' => $nonRegisteredEmployees,
                    ]);
            }

        } else {

            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'employee' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
    }
    public function register(Request $request)
    {

        $this->validator($request->all())->validate();

        $user = $this->create($request->all());
        $this->EmployeeService->attachUserIdToEmployee($user->id, $request->employee);

        return redirect('user-roles');

    }
    protected function create(array $data)
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $defaultRole = $this->RoleService->getDefaultRole();
        if (isset($defaultRole)) {
            $user->attachRole($defaultRole->id);
        }

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
