<?php

namespace App\Repositories\Service Orders;

use App\Models\Service Orders\ServiceOrders;
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
