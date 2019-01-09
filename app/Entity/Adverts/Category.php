<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 09.01.19
 * Time: 11:57
 */

namespace App\Entity\Adverts;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;

    protected $table    = 'advert_categories';

    public $timestamps  = false;

    protected $fillable = ['name', 'slug', 'parent_id'];
}
