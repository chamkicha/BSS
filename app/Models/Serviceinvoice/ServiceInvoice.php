<?php

namespace App\Models\Serviceinvoice;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class ServiceInvoice extends Model
{
    use SoftDeletes;

    public $table = 'ServiceInvoices';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'invoice_created_date',
        'invoice_due_date',
        'service_order_no',
        'due_balance',
        'current_charges',
        'payment_amount',
        'payment_status',
        'invoice_number',
        'service_name',
        'cusromer_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'service_order_no' => 'string',
        'due_balance' => 'string',
        'current_charges' => 'string',
        'payment_amount' => 'string',
        'payment_status' => 'string',
        'invoice_number' => 'string',
        'service_name' => 'string',
        'cusromer_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'invoice_created_date' => 'required|date',
        'invoice_due_date' => 'date',
        'service_order_no' => 'required',
        'due_balance' => 'required',
        'current_charges' => 'required',
        'payment_amount' => 'required',
        'payment_status' => 'required',
        'invoice_number' => 'required',
        'service_name' => 'required',
        'cusromer_name' => 'required'
    ];
}
