<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;


class StoreCompanyRequest extends FormRequest
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
            'name'      => 'required|max:150|min:5|string',
            'email'     => 'required|max:250|email|unique:companies,email',
            'logo'      => 'required|mimes:jpg,jpeg,png|dimensions:min_width=100,min_height=100',
            'web_page'  => 'sometimes|required|url',
        ];
    }
}
