<?php

namespace App\Http\Requests\Revenuepercustomerreport;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Revenuepercustomerreport\RevenuePerCustomerReport;

class UpdateRevenuePerCustomerReportRequest extends FormRequest
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
        return RevenuePerCustomerReport::$rules;
    }
}
