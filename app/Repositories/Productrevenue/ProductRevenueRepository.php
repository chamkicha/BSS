<?php

namespace App\Repositories\Productrevenue;

use App\Models\Productrevenue\ProductRevenue;
use InfyOm\Generator\Common\BaseRepository;

class ProductRevenueRepository extends BaseRepository
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
        return ProductRevenue::class;
    }
}
