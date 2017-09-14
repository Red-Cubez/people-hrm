<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Services\Interfaces\IEmployeeService;
use People\Services\Interfaces\IUserAuthenticationService;
use People\Models\User as User;
use Illuminate\Support\Facades\Validator;


class RegisterUserController extends Controller
{
    public $EmployeeService;
    public $UserAuthenticationService;

    public function __construct(IUserAuthenticationService $userAuthenticationService, IEmployeeService $employeeService)
    {
        $this->middleware('auth');
        $this->EmployeeService           = $employeeService;
        $this->UserAuthenticationService = $userAuthenticationService;
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
        $isAdmin=$this->UserAuthenticationService->isAdmin();
        $isRequestedCompanyBelongsToEmployee=$this->UserAuthenticationService->isRequestedCompanyBelongsToEmployee($companyId);

        if($isAdmin && $isRequestedCompanyBelongsToEmployee)
        {
        $nonRegisteredEmployees = $this->EmployeeService->getNonRegisteredEmployees($companyId);
        if (isset($nonRegisteredEmployees)) {
            return view('registerUser/create',
                [
                    'nonRegisteredEmployees' => $nonRegisteredEmployees,
                ]);
        }
        
    }
    else
    {

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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'employee' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
    }
    public function register(Request $request)
    {

        $this->validator($request->all())->validate();

        $user = $this->create($request->all());
        $this->EmployeeService->attachUserIdToEmployee($user->id,$request->employee);

        return redirect('user-roles');

    }
     protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
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
