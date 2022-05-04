<?php

namespace App\Http\Requests\ESarpras\User;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'username'          => ['required', 'regex:/^[^(\|\]~`!%^&*=};:?><’)]*$/'],
            'email'             => ['required'],
            'profile'           => ['required', 'array'],
            'image'             => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'profile.jabatan'   => ['required', 'string', 'max:255', 'regex:/^[^(\|\]~`!%^&*=};:?><’)]*$/'],
            'profile.*'         => ['nullable', 'string', 'max:255', 'regex:/^[^(\|\]~`!%^&*=};:?><’)]*$/'],
            'role_id'           => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'Name is required!',
            'name.string'           => 'Name must be string!',
            'email.required'        => 'Email is required!',
            'username.required'     => 'Username is required!',
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
