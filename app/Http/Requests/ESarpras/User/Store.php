<?php

namespace App\Http\Requests\ESarpras\User;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
        return [
            'name'              => ['required', 'string', 'max:255', 'regex:/^[^(\|\]~`!%^&*=};:?><’)]*$/'],
            'username'          => ['required', 'unique:users', 'regex:/^[^(\|\]~`!%^&*=};:?><’)]*$/'],
            'email'             => ['required', 'email', 'unique:users'],
            'profile'           => ['required', 'array'],
            'profile.jabatan'   => ['required', 'string', 'max:255', 'regex:/^[^(\|\]~`!%^&*=};:?><’)]*$/'],
            'role_id'           => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'Name is required!',
            'name.string'           => 'Name must be string!',
            'email.required'        => 'Email is required!',
            'email.email'           => 'Email is not valid!',
            'email.unique'          => 'Email has already been taken. Please use another Email!',
            'username.required'     => 'Username is required!',
            'username.unique'       => 'Username has already been taken. Please use another Username!',
        ];
    }

    public function filters()
    {
        return [
            'name'              => 'trim|capitalize|escape',
            'username'          => 'trim|lowercase',
            'email'             => 'trim|lowercase',
        ];
    }
}
