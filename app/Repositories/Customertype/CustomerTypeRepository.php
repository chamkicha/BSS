<?php

namespace App\Repositories\Customertype;

use App\Models\Customertype\CustomerType;
use InfyOm\Generator\Common\BaseRepository;

class CustomerTypeRepository extends BaseRepository
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
        return CustomerType::class;
    }
}
