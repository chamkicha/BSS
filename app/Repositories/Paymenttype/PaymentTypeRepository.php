<?php

namespace App\Repositories\Paymenttype;

use App\Models\Paymenttype\PaymentType;
use InfyOm\Generator\Common\BaseRepository;

class PaymentTypeRepository extends BaseRepository
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
        return PaymentType::class;
    }
}
