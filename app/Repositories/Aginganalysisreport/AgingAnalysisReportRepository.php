<?php

namespace App\Repositories\Aginganalysisreport;

use App\Models\Aginganalysisreport\AgingAnalysisReport;
use InfyOm\Generator\Common\BaseRepository;

class AgingAnalysisReportRepository extends BaseRepository
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
        return AgingAnalysisReport::class;
    }
}
