<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\URL;

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
        'color_id',
        'body',
        'days_to_delete',
        'share'
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
     * @return HasOne
     */
    public function file()
    {
        return $this->hasOne(File::class);
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

    /**
     * @return string
     */
    public function getFormattedShareAttribute()
    {
        return URL::to('/') . '/share/' . $this->id;
    }
}