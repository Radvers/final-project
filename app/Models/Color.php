<?php
/**
 * Created by PhpStorm.
 * User: Vitaliy
 * Date: 29.11.2018
 * Time: 9:11
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Color
 * @package App\Models
 */
class Color extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'class'
    ];

    /**
     * @return HasMany
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}