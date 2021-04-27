<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;



class Product extends Model
{

    public $table = 'products';
    


    public $fillable = [
        'product_name',
        'product_unit',
        'product_type',
        'v_a_t',
        'e_d',
        'price',
        'discount',
        'grand_total',
        'ed_amount',
        'vat_amount',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'product_name' => 'string',
        'product_unit' => 'string',
        'description' => 'string',
        'product_type' => 'string',
        'v_a_t(%)' => 'integer',
        'e_d(%)' => 'integer',
        'price(_t_z_s)' => 'integer',
        'vat_amount' => 'integer',
        'discount' => 'integer',
        'ed_amount' => 'integer',
        'grand_total' => 'integer',
        'discount(%)' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
