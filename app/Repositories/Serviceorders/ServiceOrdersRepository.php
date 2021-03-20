<?php

namespace App\Repositories\Serviceorders;

use App\Models\Serviceorders\ServiceOrders;
use InfyOm\Generator\Common\BaseRepository;

class ServiceOrdersRepository extends BaseRepository
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
        return ServiceOrders::class;
    }
}
