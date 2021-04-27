<?php

namespace App\Repositories\Producttype;

use App\Models\Producttype\ProductType;
use InfyOm\Generator\Common\BaseRepository;

class ProductTypeRepository extends BaseRepository
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
        return ProductType::class;
    }
}
