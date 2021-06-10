<?php

namespace App\Models\Aginganalysisreport;

use Illuminate\Database\Eloquent\Model;



class Aginganalysisreport extends Model
{

    public $table = 'aginganalysisreports';
    


    public $fillable = [
        'customer_name',
        'customer_no',
        'amount_due',
        'days'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'customer_name' => 'string',
        'customer_no' => 'string',
        'amount_due' => 'string',
        'days' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
