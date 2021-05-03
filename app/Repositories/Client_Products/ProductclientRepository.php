<?php

namespace App\Repositories\Client_Products;

use App\Models\Client_Products\Productclient;
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
