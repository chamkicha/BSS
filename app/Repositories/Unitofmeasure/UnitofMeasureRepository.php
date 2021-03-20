<?php

namespace App\Repositories\Unitofmeasure;

use App\Models\Unitofmeasure\UnitofMeasure;
use InfyOm\Generator\Common\BaseRepository;

class UnitofMeasureRepository extends BaseRepository
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
        return UnitofMeasure::class;
    }
}
