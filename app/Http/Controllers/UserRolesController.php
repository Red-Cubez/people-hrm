<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Services\Interfaces\IRoleService;
use People\Services\Interfaces\IUserRolesService;

class UserRolesController extends Controller
{
    public $UserRolesService;
    public $RoleService;

    public function __construct(IUserRolesService $userRolesService, IRoleService $roleService)
    {

        $this->middleware('auth');

        // $this->middleware('isAuthorizedToView');
        $this->UserRolesService = $userRolesService;
        $this->RoleService      = $roleService;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usersWithRoles = $this->UserRolesService->getUsersWithRoles();

        return view('userRole/index',
            [
                'usersWithRoles' => $usersWithRoles,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($userId)
    {

        $user = $this->UserRolesService->getUserWithRoles($userId);

        $userRoles = $this->UserRolesService->saveRolesInArray($user);

        $roles = $this->RoleService->getAllRoles();

        return view('userRole/edit',
            [
                'user'      => $user,
                'roles'     => $roles,
                'userRoles' => $userRoles,
            ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userId)
    {

        // $this->validate($request, array(
        //     'roles' => 'required',
        // ));
        $user = $this->UserRolesService->getUser($userId);
        $user->roles()->detach();
        $user->attachRole($request->roles);

        $defaultRole = $this->RoleService->getDefaultRole();

        if (isset($defaultRole)) {
            $user->attachRole($defaultRole->id);
        }

        /// return back();
        return redirect('user-roles');

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
