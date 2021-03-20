<?php

namespace App\Repositories\Product Type;

use App\Models\Product Type\Product Type;
use InfyOm\Generator\Common\BaseRepository;

class Product TypeRepository extends BaseRepository
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
        return Product Type::class;
    }
}
