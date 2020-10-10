<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 17/09/2020
 * Time: 10:57
 */

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface BaseRepository {

    public function all();

    public function find($id);

    public function create(array $attributes);

    public function update($id, array $attributes);


    public function disable($id);

}