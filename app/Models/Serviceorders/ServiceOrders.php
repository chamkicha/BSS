<?php

namespace App\Models\Serviceorders;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;



class ServiceOrders extends Model
{
    use SoftDeletes;

    public $table = 'serviceorderss';

    protected $dates = ['deleted_at'];
    


    public $fillable = [
        'order_i_d',
        'customer_name',
        'customer_no',
        'payment_mode',
        'service_status',
        'grand_total',
        'sub_total',
        'tax_amount',
        'tax_value',
        'ed_amount',
        'ed_value',
        'discount',
        'service_starting_date',
        'service_ending_date',
        'service_descriptions',
        'service_lists',
        'next_handler',
        'next_handler_role',
        'next_handler_role_id',
        'created_by',
        'serviceordertypes',
        'activated_by',
        'activation_date',
        'service_creation_date',
        'req_status',
        'item_quantity',
        'discount_value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'order_i_d' => 'string',
        'customer_name' => 'string',
        'customer_no' => 'string',
        'payment_mode' => 'string',
        'service_status' => 'string',
        'grand_total' => 'string',
        'serviceordertypes' => 'string',
        'sub_total' => 'string',
        'tax_amount' => 'string',
        'tax_value' => 'string',
        'ed_amount' => 'string',
        'ed_value' => 'string',
        'discount' => 'string',
        'discount_value' => 'string',
        'service_lists' => 'array',
        'next_handler' => 'string',
        'next_handler_role' => 'string',
        'next_handler_role_id' => 'string',
        'created_by' => 'string',
        'activated_by' => 'string',
        'req_status' => 'string',
        'activation_date' => 'string',
        'item_quantity' => 'integer'
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
