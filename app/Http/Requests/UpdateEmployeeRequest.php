<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('isAdmin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name'    => 'sometimes|required|max:20|min:2|string',
            'last_name'     => 'sometimes|required|max:20|min:2|string',
            'email'         => 'sometimes|required|max:250|email|unique:employees,email,'.$this->id,
            'company_id'    => 'sometimes|required|max:250|integer|exists:companies,id',
            'phone'         => 'sometimes|required|max:20|min:2|string',
        ];
    }
}
