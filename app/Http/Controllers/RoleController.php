<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\Role;
use People\Services\Interfaces\IPermissionService;
use People\Services\Interfaces\IRoleService;
use People\Services\Interfaces\IUserAuthenticationService;

class RoleController extends Controller
{
    public $RoleService;
    public $UserAuthenticationService;
    public $PermissionService;

    public function __construct(IRoleService $roleService, IUserAuthenticationService $userAuthenticationService, IPermissionService $permissionService)
    {

        $this->middleware('auth');
        //use this permission for role crud
        //$this->middleware('permission:'.StandardPermissions::crudRole);

        $this->RoleService               = $roleService;
        $this->UserAuthenticationService = $userAuthenticationService;
        $this->PermissionService         = $permissionService;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $roles       = $this->RoleService->getRoles();
        $permissions = $this->PermissionService->pluckPermissions();

        return view('roles.index')->withRoles($roles)->withPermissions($permissions);
        // $isManager = $this->UserAuthenticationService->isManager();
        // $isAdmin   = $this->UserAuthenticationService->isAdmin();

        // if ($isAdmin || $isManager) {

        //     $roles = $this->RoleService->getAllRoles();
        //     return view('roles/index',
        //         [
        //             'roles' => $roles,
        //         ]);
        // } else {
        //     return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $isManager = $this->UserAuthenticationService->isManager();
        $isAdmin   = $this->UserAuthenticationService->isAdmin();

        if ($isAdmin || $isManager) {

            return view('role/create');
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

        $this->validate($request, [
            'name'         => 'required',

            'display_name' => 'required',
        ]);

        $this->RoleService->createRole($request);
        // return redirect()->route('roles.index');
        return back();
        // $isManager = $this->UserAuthenticationService->isManager();
        // $isAdmin   = $this->UserAuthenticationService->isAdmin();

        // if ($isAdmin || $isManager) {

        //     $this->validate($request, array(
        //         'name'        => 'required|unique:roles,name|max:255',
        //         'displayName' => 'required|max:255',
        //     ));
        //     $this->RoleService->saveRole($request);

        //     return redirect('roles');

        // } else {
        //     return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        // }
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
        $role        = Role::with('perms')->find($id);
        $permissions = $this->PermissionService->pluckPermissions();
        return view('roles.edit')->withRole($role)->withPermissions($permissions);
        //     $isManager = $this->UserAuthenticationService->isManager();
        //     $isAdmin   = $this->UserAuthenticationService->isAdmin();

        //     if ($isAdmin || $isManager) {

        //         $role = $this->RoleService->getRole($id);

        //         return view('role/edit',
        //             [
        //                 'role' => $role,
        //             ]);
        //     } else {
        //         return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        //     }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

        $role->detachPermissions();
        $this->RoleService->updateRole($request, $role);
        // return redirect()->route('roles.index');
        return back();
        // $this->validate($request, array(
        //     'name'        => "required|unique:roles,name,$id|max:255",
        //     'displayName' => 'required|max:255',
        // ));

        // $this->RoleService->updateRole($request, $id);

        // return redirect('roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->RoleService->deleteRole($id);
        return redirect()->route('roles.index');
        // $isManager = $this->UserAuthenticationService->isManager();
        // $isAdmin   = $this->UserAuthenticationService->isAdmin();

        // if ($isAdmin || $isManager) {
        //     $this->RoleService->deleteRole($id);

        //     return back();
        // } else {
        //     return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        // }
    }
}
