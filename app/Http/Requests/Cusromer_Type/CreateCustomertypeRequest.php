<?php

namespace App\Http\Requests\Cusromer_Type;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Cusromer_Type\Customertype;

class CreateCustomertypeRequest extends FormRequest
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
        return Customertype::$rules;
    }
}
