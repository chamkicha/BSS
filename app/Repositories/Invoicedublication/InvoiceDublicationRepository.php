<?php

namespace App\Repositories\Invoicedublication;

use App\Models\Invoicedublication\InvoiceDublication;
use InfyOm\Generator\Common\BaseRepository;

class InvoiceDublicationRepository extends BaseRepository
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
        return InvoiceDublication::class;
    }
}
