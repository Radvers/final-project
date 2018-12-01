<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NoteTag
 * @package App\Models
 */
class NoteTag extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'note_id',
        'tag_id'
    ];

    /**
     * @var string
     */
    protected $table = 'note_tag';

}