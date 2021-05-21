<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReferenceStoreRequest extends FormRequest
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
            'referrer_name'                  => 'required',
            'organization_id'                => 'required',
            'address'                        => 'required',
            'mobile_number'                  => 'required',
            'alternative_mobile_number'      => 'nullable',
            // 'nid_number'                     => 'nullable|min:8|max:14',
            'image'                          => 'image|nullable'
        ];
    }
}
