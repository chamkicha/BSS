<?php

namespace App\Http\Requests\Productrevenue;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Productrevenue\ProductRevenue;

class CreateProductRevenueRequest extends FormRequest
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
        return ProductRevenue::$rules;
    }
}
