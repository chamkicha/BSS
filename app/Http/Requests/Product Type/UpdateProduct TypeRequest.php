<?php

namespace App\Http\Requests\Product Type;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product Type\Product Type;

class UpdateProduct TypeRequest extends FormRequest
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
        return Product Type::$rules;
    }
}
