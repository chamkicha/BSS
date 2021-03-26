<?php

namespace App\Models\Paymentanddue;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class PaymentAndDue extends Model
{
    use SoftDeletes;

    public $table = 'PaymentAndDues';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'customer_name',
        'total_amount',
        'paid_amount',
        'balance',
        'customer_no'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'customer_name' => 'string',
        'total_amount' => 'string',
        'paid_amount' => 'string',
        'balance' => 'string',
        'customer_no' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
