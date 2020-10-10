<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 17/09/2020
 * Time: 17:47
 */

namespace App\Helper;


use Illuminate\Support\Facades\Auth;

class Helper {

    public static function check($permission)
    {
        if(!Auth::user()->hasPermission($permission))
            abort(401);
    }
}