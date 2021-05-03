<?php

namespace App\Repositories\Client_Product;

use App\Models\Client_Product\Productclient;
use InfyOm\Generator\Common\BaseRepository;

class ProductclientRepository extends BaseRepository
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
        return Productclient::class;
    }
}
