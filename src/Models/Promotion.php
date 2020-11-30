<?php

namespace Nanuc\Promotions\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Promotion extends Model
{
    public static function byUrl($url) : Promotion
    {
        return self::where('url', $url)->firstOrFail();
    }

    public function getView()
    {
        return config('promotions.views.path') . '/' . Str::kebab($this->getName());
    }

    public function getName()
    {
        return (new \ReflectionClass($this->getHandler()))->getShortName();
    }

    public function getHandler()
    {
        $handlerClassName = $this->handler;
        return new $handlerClassName;
    }
}
