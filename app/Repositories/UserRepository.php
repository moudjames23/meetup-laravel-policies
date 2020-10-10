<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 17/09/2020
 * Time: 15:52
 */

namespace App\Repositories;


use App\User;

class UserRepository implements BaseRepository{

    public function all()
    {
       return User::with(['role'])->get();
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function create(array $attributes)
    {
        $this->save(null, $attributes);
    }

    public function update($id, array $attributes)
    {
        $this->save($id, $attributes);
    }

    public function disable($id)
    {
        $user = $this->find($id);
        $user->status = !$user->status;
        $user->save();
    }

    public function save($id = null, array $attributes)
    {
        if($id == null)
            $user = new User();
        else
            $user = $this->find($id);

        $user->email = $attributes['email'];
        $user->nom = $attributes['nom'];
        $user->prenom = $attributes['prenom'];
        $user->phone = $attributes['phone'];

        if(!empty($attributes['password']))
            $user->password = bcrypt($attributes['password']);

        $user->role_id = $attributes['role'];
        $user->save();
    }
}