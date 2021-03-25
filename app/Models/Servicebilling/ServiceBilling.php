<?php

namespace App\Models\Servicebilling;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class ServiceBilling extends Model
{
    use SoftDeletes;

    public $table = 'ServiceBillings';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'bill_no',
        'service_order_no',
        'billing_date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'bill_no' => 'string',
        'service_order_no' => 'string',
        'billing_date' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'service_order_no' => 'required',
        'billing_date' => 'required'
    ];
}
