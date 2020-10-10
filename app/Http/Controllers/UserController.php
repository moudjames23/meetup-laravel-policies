<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    private $repository;

    function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Helper::check('view_all_users');


        $title = 'Liste des utilisateurs';

        $users = $this->repository->all();

        return view('backend.users.index', compact(['title', 'users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Helper::check('create_user');

        $title = 'Nouvel utilisateur';

        $user = new User();

        $roles = Role::pluck('nom', 'id');

        return view('backend.users.create', compact(['title', 'user', 'roles']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        Helper::check('create_user');

        $this->repository->create($request->all());

        return redirect(route('user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Helper::check('show_user');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        Helper::check('edit_user');


        $title = 'Mise à jour';

        $roles = Role::pluck('nom', 'id');

        return view('backend.users.edit', compact(['title', 'user', 'roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Helper::check('edit_user');

        $this->repository->update($id, $request->all());

        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Helper::check('delete_user');
    }

    public function disable($id)
    {
        Helper::check('disable_user');

        $this->repository->disable($id);

        return redirect(route('user.index'));

    }


    public function password()
    {
        $title = 'Modification mot de passe';

        $user = Auth::user();;

        return view('backend.users.password', compact(['title', 'user']));
    }

    public function passwordUpdate(Request $request)
    {

        $this->validate($request, [
            'password' => 'required||min:5|confirmed',
        ]);

        $user = User::findOrFail($request['user_id']);
        $user->password = bcrypt($request['password']);
        $user->save();

        return redirect(route('dashboard'));
    }
}
