<?php

namespace App\Http\Requests\Paymenttype;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Paymenttype\PaymentType;

class UpdatePaymentTypeRequest extends FormRequest
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
        return PaymentType::$rules;
    }
}
