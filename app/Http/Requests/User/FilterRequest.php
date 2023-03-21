<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'role_id' => 'array|nullable',
            'role_id.*' => 'numeric|nullable',

            'permission_id' => 'array|nullable',
            'permission_id.*' => 'numeric|nullable',

            'userNameSort' => 'string|nullable',
            'roleSort' => 'string|nullable',
            'emailSort' => 'string|nullable',

            'search' => '',
        ];
    }
}
