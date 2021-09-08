<?php

namespace App\Repositories\Previousbalanceadjust;

use App\Models\Previousbalanceadjust\PreviousBalanceAdjust;
use InfyOm\Generator\Common\BaseRepository;

class PreviousBalanceAdjustRepository extends BaseRepository
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
        return PreviousBalanceAdjust::class;
    }
}
