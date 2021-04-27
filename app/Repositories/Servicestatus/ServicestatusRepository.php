<?php

namespace App\Repositories\Servicestatus;

use App\Models\Servicestatus\Servicestatus;
use InfyOm\Generator\Common\BaseRepository;

class ServicestatusRepository extends BaseRepository
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
        return Servicestatus::class;
    }
}
