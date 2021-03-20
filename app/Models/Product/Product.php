<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;



class Product extends Model
{

    public $table = 'Products';
    


    public $fillable = [
        'product_name',
        'product_unit',
        'product_type',
        'v_a_t',
        'e_d',
        'price',
        'discount'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'product_name' => 'string',
        'product_unit' => 'string',
        'product_type' => 'string',
        'v_a_t(%)' => 'integer',
        'e_d(%)' => 'integer',
        'price(_t_z_s)' => 'integer',
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
