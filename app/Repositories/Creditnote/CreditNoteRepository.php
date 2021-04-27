<?php

namespace App\Repositories\Creditnote;

use App\Models\Creditnote\CreditNote;
use InfyOm\Generator\Common\BaseRepository;

class CreditNoteRepository extends BaseRepository
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
        return CreditNote::class;
    }
}
