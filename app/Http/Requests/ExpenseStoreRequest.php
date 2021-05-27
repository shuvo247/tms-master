<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseStoreRequest extends FormRequest
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
            'expense_date'              => 'required',
            'expense_category_id'       => 'required',
            'payment_method_id'         => 'nullable',
            'amount'                    => 'required',
            'account_information'       => 'nullable',
            'note'                      => 'nullable',
        ];
    }
}
