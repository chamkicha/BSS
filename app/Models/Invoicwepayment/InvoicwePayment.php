<?php

namespace App\Models\Invoicwepayment;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class InvoicwePayment extends Model
{
    use SoftDeletes;

    public $table = 'InvoicwePayments';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'invoice_number',
        'payment_amount',
        'payment_type',
        'payment_descriptions',
        'upload_supportingdocument'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'invoice_number' => 'string',
        'payment_amount' => 'string',
        'payment_type' => 'string',
        'payment_descriptions' => 'string',
        'upload_supportingdocument' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'invoice_number' => 'required',
        'payment_amount' => 'required',
        'payment_type' => 'required',
        'payment_descriptions' => 'required',
        'upload_supportingdocument' => 'required'
    ];
}
