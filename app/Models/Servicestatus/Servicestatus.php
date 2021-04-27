<?php

namespace App\Models\Servicestatus;

use Illuminate\Database\Eloquent\Model;



class Servicestatus extends Model
{

    public $table = 'servicestatuss';
    


    public $fillable = [
        'service_status_name',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'service_status_name' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
