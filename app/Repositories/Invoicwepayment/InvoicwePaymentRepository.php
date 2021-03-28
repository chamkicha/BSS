<?php

namespace App\Repositories\Invoicwepayment;

use App\Models\Invoicwepayment\InvoicwePayment;
use InfyOm\Generator\Common\BaseRepository;

class InvoicwePaymentRepository extends BaseRepository
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
        return InvoicwePayment::class;
    }
}
