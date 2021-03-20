<?php

namespace App\Models\Customertype;

use Illuminate\Database\Eloquent\Model;



class CustomerType extends Model
{

    public $table = 'CustomerTypes';
    


    public $fillable = [
        'customer_type_name_default',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'customer_type_name_default' => 'string',
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
