<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Page extends Model
{
    use NodeTrait;

    const test = 'sfsdf';

    protected $table = 'pages';
    protected $guarded = [];

    public function getPath(): string
    {
        return implode('/', array_merge($this->ancestors()->defaultOrder()->pluck('slug')->toArray(), [$this->slug]));
    }

    public function getMenuTitle(): string
    {
        return $this->menu_title ?: $this->title;
    }

    public static function test()
    {
        self::test;
    }
}
