<?php

namespace App\Models\Revenuepercustomerreport;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class RevenuePerCustomerReport extends Model
{
    use SoftDeletes;

    public $table = 'RevenuePerCustomerReports';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'customer_name',
        'customer_no',
        'customer_type',
        'services',
        'excise_dutty',
        'v_a_t',
        'total_wit_vat'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'customer_name' => 'string',
        'customer_no' => 'string',
        'customer_type' => 'string',
        'services' => 'string',
        'excise_dutty' => 'string',
        'v_a_t' => 'string',
        'total_wit_vat' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
