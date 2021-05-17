<?php

namespace App\Models\Invoicwepayment;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class InvoicwePayment extends Model
{
    use SoftDeletes;

    public $table = 'invoicwepayments';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'invoice_number',
        'payment_amount',
        'payment_type',
        'payment_descriptions',
        'cusromer_name',
        'customer_no',
        'grand_total',
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
        'cusromer_name' => 'string',
        'customer_no' => 'string',
        'grand_total' => 'string',
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
