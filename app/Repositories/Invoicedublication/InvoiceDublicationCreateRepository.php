<?php

namespace App\Repositories\Invoicedublication;

use App\Models\Invoicedublication\InvoiceDublicationCreate;
use InfyOm\Generator\Common\BaseRepository;

class InvoiceDublicationCreateRepository extends BaseRepository
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
        return InvoiceDublicationCreate::class;
    }
}
