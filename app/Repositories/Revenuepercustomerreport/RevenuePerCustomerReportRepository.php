<?php

namespace App\Repositories\Revenuepercustomerreport;

use App\Models\Revenuepercustomerreport\RevenuePerCustomerReport;
use InfyOm\Generator\Common\BaseRepository;

class RevenuePerCustomerReportRepository extends BaseRepository
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
        return RevenuePerCustomerReport::class;
    }
}
