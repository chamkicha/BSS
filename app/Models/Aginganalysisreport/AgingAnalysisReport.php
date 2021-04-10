<?php

namespace App\Models\Aginganalysisreport;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class AgingAnalysisReport extends Model
{
    use SoftDeletes;

    public $table = 'AgingAnalysisReports';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'customer_name',
        'customer_no',
        '30_days',
        '60_days',
        '90_days',
        '120_days',
        '150_days',
        '180_days',
        'morethan180_days',
        'total'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'customer_name' => 'string',
        'customer_no' => 'string',
        '30_days' => 'string',
        '60_days' => 'string',
        '90_days' => 'string',
        '120_days' => 'string',
        '150_days' => 'string',
        '180_days' => 'string',
        'morethan180_days' => 'string',
        'total' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
