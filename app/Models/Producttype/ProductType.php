<?php

namespace App\Models\Producttype;

use Illuminate\Database\Eloquent\Model;



class ProductType extends Model
{

    public $table = 'producttypes';
    


    public $fillable = [
        'product_type_name',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'product_type_name' => 'string',
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
