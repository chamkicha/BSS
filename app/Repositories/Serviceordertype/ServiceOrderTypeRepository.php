<?php

namespace App\Repositories\Serviceordertype;

use App\Models\Serviceordertype\ServiceOrderType;
use InfyOm\Generator\Common\BaseRepository;

class ServiceOrderTypeRepository extends BaseRepository
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
        return ServiceOrderType::class;
    }
}
