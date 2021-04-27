<?php

namespace App\Http\Requests\Creditnote;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Creditnote\CreditNote;

class CreateCreditNoteRequest extends FormRequest
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
        return CreditNote::$rules;
    }
}
