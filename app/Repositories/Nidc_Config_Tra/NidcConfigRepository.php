<?php

namespace App\Repositories\Nidc_Config_Tra;

use App\Models\Nidc_Config_Tra\NidcConfig;
use InfyOm\Generator\Common\BaseRepository;

class NidcConfigRepository extends BaseRepository
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
        return NidcConfig::class;
    }
}
