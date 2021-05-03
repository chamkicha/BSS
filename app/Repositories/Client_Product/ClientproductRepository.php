<?php

namespace App\Repositories\Client_Product;

use App\Models\Client_Product\Clientproduct;
use InfyOm\Generator\Common\BaseRepository;

class ClientproductRepository extends BaseRepository
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
        return Clientproduct::class;
    }
}
