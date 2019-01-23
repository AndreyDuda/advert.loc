<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 05.01.19
 * Time: 14:29
 */

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class Region
 * @package App\Entity
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property int|null $parent_id
 *
 * @property Region $parent
 * @property Region[] $children
 *
 * @method Builder roots()
 */
class Region extends Model
{
    protected $fillable = ['name', 'slug', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent_id', 'id');
    }

    public function scopeRoots(Builder $query)
    {
        return $query->where('parent_id', null);
    }

}
