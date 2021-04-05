<?php

namespace App\Repositories\Comment;

use App\Models\Comment\Comment;
use InfyOm\Generator\Common\BaseRepository;

class CommentRepository extends BaseRepository
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
        return Comment::class;
    }
}
