<?php

namespace App\Repositories\Paymentmode;

use App\Models\Paymentmode\PaymentMode;
use InfyOm\Generator\Common\BaseRepository;

class PaymentModeRepository extends BaseRepository
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
        return PaymentMode::class;
    }
}
