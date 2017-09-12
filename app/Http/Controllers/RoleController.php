<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Services\Interfaces\IRoleService;

class RoleController extends Controller
{
    public $RoleService;

    public function __construct(IRoleService $roleService)
    {

        //  $this->middleware('auth');
        $this->RoleService = $roleService;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->RoleService->getAllRoles();
        return view('role/index',
            [
                'roles' => $roles,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name'        => 'required|unique:roles,name|max:255',
            'displayName' => 'required|max:255',
        ));
        $this->RoleService->saveRole($request);

        return redirect('roles');
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
        $role = $this->RoleService->getRole($id);

        return view('role/edit',
            [
                'role' => $role,
            ]);
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

        $this->validate($request, array(
            'name'        => "required|unique:roles,name,$id|max:255",
            'displayName' => 'required|max:255',
        ));

        $this->RoleService->updateRole($request, $id);
      
        return redirect('roles');
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

        return back();
    }
}
