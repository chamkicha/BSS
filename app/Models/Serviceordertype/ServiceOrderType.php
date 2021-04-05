<?php

namespace App\Models\Serviceordertype;

use Illuminate\Database\Eloquent\Model;



class ServiceOrderType extends Model
{

    public $table = 'ServiceOrderTypes';
    


    public $fillable = [
        'service_order_type_name',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'service_order_type_name' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'service_order_type_name' => 'required'
    ];
}
