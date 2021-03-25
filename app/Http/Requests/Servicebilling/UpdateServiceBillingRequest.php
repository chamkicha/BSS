<?php

namespace App\Http\Requests\Servicebilling;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Servicebilling\ServiceBilling;

class UpdateServiceBillingRequest extends FormRequest
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
        return ServiceBilling::$rules;
    }
}
