<?php

namespace App\Repositories\Productserviceorderlist;

use App\Models\Productserviceorderlist\ProductServiceOrderList;
use InfyOm\Generator\Common\BaseRepository;

class ProductServiceOrderListRepository extends BaseRepository
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
        return ProductServiceOrderList::class;
    }
}
