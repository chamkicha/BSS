<?php

namespace App\Models\Aginganalysisreport;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class Aginganalysisreport extends Model
{
    use SoftDeletes;

    public $table = 'aginganalysisreports';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'customer_name',
        'customer_no',
        'total',
        '0-30_days',
        '31-60_days',
        '61-90_days',
        '91-120_days',
        '121-180_days',
        '181+_days'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'customer_name' => 'string',
        'customer_no' => 'string',
        'total' => 'string',
        '0-30_days' => 'string',
        '31-60_days' => 'string',
        '61-90_days' => 'string',
        '91-120_days' => 'string',
        '121-180_days' => 'string',
        '181+_days' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
