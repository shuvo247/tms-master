<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'category_id'                => 'required',
            'brand_id'                   => 'required',
            'payment_method_id'          => 'nullable',
            'product_name'               => 'required',
            'pcs_per_box'                => 'nullable',
            'alert_quantity'             => 'nullable',
            'image'                      => 'image|nullable'
        ];
    }
}
