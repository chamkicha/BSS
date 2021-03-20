<?php

namespace App\Http\Requests\Customertype;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Customertype\CustomerType;

class UpdateCustomerTypeRequest extends FormRequest
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
        return CustomerType::$rules;
    }
}
