<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationStoreRequest extends FormRequest
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
            'organization_type'     => 'required',
            'organization_name'     => 'required',
            'owner_name'            => 'required',
            'mobile_number'         => 'required',
            'address'               => 'required',
        ];
    }
}
