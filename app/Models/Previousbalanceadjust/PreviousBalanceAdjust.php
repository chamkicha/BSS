<?php

namespace App\Models\Previousbalanceadjust;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class PreviousBalanceAdjust extends Model
{
    use SoftDeletes;

    public $table = 'PreviousBalanceAdjusts';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'invoice_no',
        'amount',
        'add_sub'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'invoice_no' => 'string',
        'amount' => 'string',
        'add_sub' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
