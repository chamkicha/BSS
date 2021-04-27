<?php

namespace App\Repositories\Product Type;

use App\Models\Product Type\ProductType;
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
