<?php

namespace App\Repositories\Servicebilling;

use App\Models\Servicebilling\ServiceBilling;
use InfyOm\Generator\Common\BaseRepository;

class ServiceBillingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ServiceBilling::class;
    }
}
