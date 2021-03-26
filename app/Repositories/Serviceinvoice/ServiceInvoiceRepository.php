<?php

namespace App\Repositories\Serviceinvoice;

use App\Models\Serviceinvoice\ServiceInvoice;
use InfyOm\Generator\Common\BaseRepository;

class ServiceInvoiceRepository extends BaseRepository
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
        return ServiceInvoice::class;
    }
}
