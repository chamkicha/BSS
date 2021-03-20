<?php

namespace App\Models\Serviceorders;

use Illuminate\Database\Eloquent\Model;



class ServiceOrders extends Model
{

    public $table = 'ServiceOrderss';
    


    public $fillable = [
        'order_i_d',
        'customer_name',
        'payment_mode',
        'service_status',
        'price',
        'service_starting_date',
        'service_ending_date',
        'service_descriptions',
        'service_lists',
        'next_handler',
        'created_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'order_i_d' => 'string',
        'customer_name' => 'string',
        'payment_mode' => 'string',
        'service_status' => 'string',
        'price' => 'string',
        'service_lists' => 'array',
        'next_handler' => 'string',
        'created_by' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function setService($value)
    {
        $this->attributes['service_lists'] = json_encode($value);
    }

    public function getService($value)
    {
        return $this->attributes['service_lists'] = json_decode($value);
    }
}
