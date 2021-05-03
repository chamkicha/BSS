<?php

namespace App\Models\Productsserviceprder;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class Productsserviceorder extends Model
{
    use SoftDeletes;

    public $table = 'productsserviceorders';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'product_name',
        'product_no',
        'description',
        'sub_total',
        'vat_amount',
        'grand_total',
        'order_i_d'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'product_name' => 'string',
        'product_no' => 'string',
        'description' => 'string',
        'sub_total' => 'string',
        'vat_amount' => 'string',
        'grand_total' => 'string',
        'order_i_d' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
