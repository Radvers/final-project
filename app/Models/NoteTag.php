<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * @return HasMany
     */
    public function notes()
    {
        return $this->hasMany(Note::class, 'id', 'note_id');
    }

}