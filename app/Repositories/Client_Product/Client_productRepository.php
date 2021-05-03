<?php

namespace App\Repositories\Client_Product;

use App\Models\Client_Product\Client_product;
use InfyOm\Generator\Common\BaseRepository;

class Client_productRepository extends BaseRepository
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
        return Client_product::class;
    }
}
