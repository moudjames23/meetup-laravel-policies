<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Permission;
use App\Repositories\RoleRepository;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    private $roleRepository;

    function __construct(RoleRepository  $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Liste des roles';

        $roles = $this->roleRepository->all();

        return view('backend.roles.index', compact(['title', 'roles']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Nouveau role";

        $role = new Role();
        $permissions = Permission::orderBy("type", "asc")->get();

        return view('backend.roles.create', compact(['title', 'role', 'permissions']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = new Role();
        $this->roleRepository->save(null, $request->all());

        return redirect(route('role.index'));
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
    public function edit(Role $role)
    {
        $title = "Mise à jour";

        $permissions = Permission::orderBy("type", "asc")->get();

        return view('backend.roles.edit', compact(['title', 'permissions', 'role']));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $this->roleRepository->update($id, $request->all());

        //notify()->success('Mise à jour effectuée avec succès');

        return redirect(route('role.index'));
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
