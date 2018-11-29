<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Note
 * @package App\Models
 */
class Note extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'days_to_delete'
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    /**
     * @param Builder $query
     * @param string $field
     * @param $value
     * @return mixed
     */
    public function scopeByField(Builder $query, string $field, $value)
    {
        return $this->where($field, $value)->with('color');
    }
}