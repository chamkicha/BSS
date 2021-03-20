<?php

namespace App\Models\Unitofmeasure;

use Illuminate\Database\Eloquent\Model;



class UnitofMeasure extends Model
{

    public $table = 'UnitofMeasures';
    


    public $fillable = [
        'unitof_measure_name',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'unitof_measure_name' => 'string',
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
