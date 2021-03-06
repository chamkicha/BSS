<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class Customer extends Model
{
    use SoftDeletes;

    public $table = 'customers';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'customername',
        't_i_n_number',
        'v_a_t_registration_number',
        'business_license_number',
        'contact_person',
        'position_held',
        'contact_telephone',
        'office_telephone',
        'email',
        'postal_address',
        'region',
        'district',
        'fax',
        'customer_no',
        'customer_type',
        'country',
        'Business_licence_file',
        'Certificate_of_incorporation_file',
        'TIN_registeration_number_file',
        'Tax_exemption_certification_file',
        'created_by'	
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'customername' => 'string',
        't_i_n_number' => 'string',
        'v_a_t_registration_number' => 'string',
        'business_license_number' => 'string',
        'contact_person' => 'string',
        'position_held' => 'string',
        'contact_telephone' => 'string',
        'office_telephone' => 'string',
        'email' => 'string',
        'postal_address' => 'string',
        'region' => 'string',
        'district' => 'string',
        'fax' => 'string',
        'country' => 'string',
        'created_by' => 'string',
        'customer_no' => 'string',	
        'customer_type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
