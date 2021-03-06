<?php

namespace App\Http\Requests\ESarpras;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'description'       => ['required', 'string', 'regex:/^[^(\|\]~`!%^&*=};:?><’)]*$/'],
            'slug'              => ['required', 'string', 'max:255'],
            'level'             => ['required', 'string', 'max:255'],
            'class'             => ['required', 'string', 'max:255'],
        ];
    }
}
