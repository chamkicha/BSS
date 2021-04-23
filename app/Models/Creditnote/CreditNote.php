<?php

namespace App\Models\Creditnote;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class CreditNote extends Model
{
    use SoftDeletes;

    public $table = 'creditnotes';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'credit_note_no',
        'created_at',
        'customer_name',
        'customer_no',
        'invoice_no',
        'reason_for_adjustment',
        'total_amount',
        'created_by',
        'status',
        'sub_total',
        'tax_amount',
        'service_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'credit_note_no' => 'string',
        'customer_name' => 'string',
        'customer_no' => 'string',
        'invoice_no' => 'string',
        'reason_for_adjustment' => 'string',
        'total_amount' => 'string',
        'sub_total' => 'string',
        'tax_amount' => 'string',
        'service_name' => 'string',
        'created_by' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
