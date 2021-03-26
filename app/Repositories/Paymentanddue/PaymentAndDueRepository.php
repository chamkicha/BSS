<?php

namespace App\Repositories\Paymentanddue;

use App\Models\Paymentanddue\PaymentAndDue;
use InfyOm\Generator\Common\BaseRepository;

class PaymentAndDueRepository extends BaseRepository
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
        return PaymentAndDue::class;
    }
}
