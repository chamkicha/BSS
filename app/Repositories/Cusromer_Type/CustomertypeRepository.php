<?php

namespace App\Repositories\Cusromer_Type;

use App\Models\Cusromer_Type\Customertype;
use InfyOm\Generator\Common\BaseRepository;

class CustomertypeRepository extends BaseRepository
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
        return Customertype::class;
    }
}
