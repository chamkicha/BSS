<?php

namespace App\Models\Paymenttype;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class PaymentType extends Model
{
    use SoftDeletes;

    public $table = 'PaymentTypes';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'payment_type_name',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'payment_type_name' => 'string',
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
