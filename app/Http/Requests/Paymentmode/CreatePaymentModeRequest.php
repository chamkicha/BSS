<?php

namespace App\Http\Requests\Paymentmode;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Paymentmode\PaymentMode;

class CreatePaymentModeRequest extends FormRequest
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
        return PaymentMode::$rules;
    }
}
