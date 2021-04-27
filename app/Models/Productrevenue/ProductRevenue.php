<?php

namespace App\Models\Productrevenue;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class ProductRevenue extends Model
{
    use SoftDeletes;

    public $table = 'productRevenues';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'product_name',
        'price',
        'vat',
        'excise_dutty',
        'grand_total',
        'product_revenue'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'product_name' => 'string',
        'price' => 'string',
        'vat' => 'string',
        'excise_dutty' => 'string',
        'grand_total' => 'string',
        'product_revenue' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
