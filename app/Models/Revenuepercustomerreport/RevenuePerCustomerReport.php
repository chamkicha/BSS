<?php

namespace App\Models\Revenuepercustomerreport;

use Illuminate\Database\Eloquent\Model;



class RevenuePerCustomerReport extends Model
{

    public $table = 'RevenuePerCustomerReports';
    


    public $fillable = [
        'customer_id',
        'customer_name',
        'customer_type',
        'excise_duty',
        'v_a_t',
        'total_with_vat'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'customer_id' => 'string',
        'customer_name' => 'string',
        'customer_type' => 'string',
        'excise_duty' => 'string',
        'v_a_t' => 'string',
        'total_with_vat' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
