<?php
/**
 * Created by PhpStorm.
 * User: Vitaliy
 * Date: 30.11.2018
 * Time: 13:15
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'note_id',
        'src'
    ];

    /**
     * @return BelongsTo
     */
    public function note()
    {
        return $this->belongsTo(Note::class);
    }
}