<?php

namespace App\Models\Invoicedublication;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class InvoiceDublication extends Model
{
    use SoftDeletes;

    public $table = 'InvoiceDublications';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'invoice_number',
        'invoice_creation_date',
        'next_invoice_date',
        'created_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'invoice_number' => 'string',
        'invoice_creation_date' => 'string',
        'next_invoice_date' => 'string',
        'created_by' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
