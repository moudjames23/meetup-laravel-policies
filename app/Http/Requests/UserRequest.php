<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->method() == 'POST')
            return [
                'nom' => 'required|min:2',
                'prenom' => 'required|min:3',
                'email' => 'required|email|unique:users',
                'phone' => 'required|unique:users',
                'password' => 'required|min:5|confirmed',
                'role' => 'required',
            ];

        return [
            'nom' => 'required|min:2',
            'prenom' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' .$this->user,
            'phone' => 'required|unique:users,phone,' .$this->user,
            'password' => 'nullable||min:5|confirmed',
            'role' => 'required',
        ];
    }
}
