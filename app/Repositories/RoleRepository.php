<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 17/09/2020
 * Time: 10:56
 */

namespace App\Repositories;


use App\Role;
use Illuminate\Database\Eloquent\Model;

class RoleRepository implements BaseRepository
{

    public function all()
    {
        return Role::get();
    }

    public function find($id)
    {
        return Role::findOrFail($id);
    }

    public function create(array $attributes)
    {
        $this->save(null, $attributes);
    }

    public function update($id, array $attributes)
    {
       $this->save($id, $attributes);
    }



    public function save($id = null, array $attributes)
    {

        if($id == null)
            $role = new Role();
        else
            $role = $this->find($id);



        $role->nom = $attributes['nom'];
        $role->save();

        if($id != null)
            $role->permissions()->detach();

        $role->permissions()->attach($attributes['permissions']);
    }

    public function disable($id)
    {
        // TODO: Implement disable() method.
    }



}