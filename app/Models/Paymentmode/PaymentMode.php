<?php

namespace App\Models\Paymentmode;

use Illuminate\Database\Eloquent\Model;



class PaymentMode extends Model
{

    public $table = 'paymentmodes';
    


    public $fillable = [
        'payment_mode_name',
        'payment_interval',
        'monthly_count',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'payment_mode_name' => 'string',
        'payment_interval' => 'string',
        'monthly_count' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
