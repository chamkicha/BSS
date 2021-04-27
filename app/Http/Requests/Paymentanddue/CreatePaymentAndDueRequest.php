<?php

namespace App\Http\Requests\Paymentanddue;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Paymentanddue\PaymentAndDue;

class CreatePaymentAndDueRequest extends FormRequest
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
        return PaymentAndDue::$rules;
    }
}
