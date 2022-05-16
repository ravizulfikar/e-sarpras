<?php

namespace App\Http\Requests\ESarpras;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'token',
            'date',
            'source',
            'type',
            'location',
            'category',
            'detail',
            'status', 
            'verification'
        ];
    }
}
