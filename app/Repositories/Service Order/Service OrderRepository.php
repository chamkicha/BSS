<?php

namespace App\Repositories\Service Order;

use App\Models\Service Order\Service Order;
use InfyOm\Generator\Common\BaseRepository;

class Service OrderRepository extends BaseRepository
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
        return Service Order::class;
    }
}
