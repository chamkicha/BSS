<?php

namespace App\Repositories\Product Type Name;

use App\Models\Product Type Name\Product Types;
use InfyOm\Generator\Common\BaseRepository;

class Product TypesRepository extends BaseRepository
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
        return Product Types::class;
    }
}
