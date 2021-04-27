<?php

namespace App\Http\Requests\Revenue_Per_Product;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Revenue_Per_Product\RevenuePerProduct;

class UpdateRevenuePerProductRequest extends FormRequest
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
        return RevenuePerProduct::$rules;
    }
}
