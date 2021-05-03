<?php

namespace App\Repositories\Client_Product;

use App\Models\Client_Product\Clientproductreport;
use InfyOm\Generator\Common\BaseRepository;

class ClientproductreportRepository extends BaseRepository
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
        return Clientproductreport::class;
    }
}
