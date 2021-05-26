<?php

namespace App\Repositories\Aginganalysisreport;

use App\Models\Aginganalysisreport\Aginganalysisreport;
use InfyOm\Generator\Common\BaseRepository;

class AginganalysisreportRepository extends BaseRepository
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
        return Aginganalysisreport::class;
    }
}
