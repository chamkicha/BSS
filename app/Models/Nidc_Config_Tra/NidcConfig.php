<?php

namespace App\Models\Nidc_Config_Tra;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class NidcConfig extends Model
{
    use SoftDeletes;

    public $table = 'nidcConfigs';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'tin_num',
        'vfd',
        'cert_path',
        'cert_password',
        'cert_serial',
        'datetime',
        'regid',
        'username',
        'password',
        'recptcode',
        'routekey',
        'access_token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'tin_num' => 'string',
        'vfd' => 'string',
        'cert_path' => 'string',
        'cert_password' => 'string',
        'cert_serial' => 'string',
        'datetime' => 'string',
        'regid' => 'string',
        'username' => 'string',
        'password' => 'string',
        'recptcode' => 'string',
        'routekey' => 'string',
        'access_token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
