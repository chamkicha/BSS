<?php

namespace App\Models\Client_Product;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class Clientproductreport extends Model
{
    use SoftDeletes;

    public $table = 'clientproductreports';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'client_no',
        'product_name',
        'service_order_no'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'client_no' => 'string',
        'product_name' => 'string',
        'service_order_no' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
