<?php

namespace App\Http\Requests\Client_Product;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Client_Product\Client_product;

class CreateClient_productRequest extends FormRequest
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
        return Client_product::$rules;
    }
}
