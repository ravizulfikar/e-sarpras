<?php

namespace App\Http\Requests\ESarpras;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     *regex:/^.+$/i
     * @return array
     */
    public function rules()
    {
        return [
            'name'              => ['required', 'string', 'max:255', 'regex:/^[^(\|\]~`!%^&*=};:?><’)]*$/'],
            'username'          => ['required', 'unique:users', 'regex:/^[^(\|\]~`!%^&*=};:?><’)]*$/'],
            'email'             => ['required', 'email', 'unique:users'],
            'profile'           => ['required', 'array'],
            'profile.photo'     => 'image|mimes:jpeg,png,jpg|max:2048',
            'profile.jabatan'   => ['required', 'string', 'max:255', 'regex:/^[^(\|\]~`!%^&*=};:?><’)]*$/'],
            'profile.*'         => ['string', 'max:255', 'regex:/^[^(\|\]~`!%^&*=};:?><’)]*$/'],
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
            'email.unique'          => 'The Email has already been taken. Please use another Email!',
            'username.required'     => 'Username is required!',
            'username.unique'       => 'The Username has already been taken. Please use another Username!',
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
