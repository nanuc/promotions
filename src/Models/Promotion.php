<?php

namespace Nanuc\Promotions\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Nanuc\Promotions\Exports\FlyeralarmAddressExport;

class Promotion extends Model
{
    public function promotionCodes()
    {
        return $this->hasMany(PromotionCode::class);
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

    public function exportAsFlyeralarmData($path = 'flyeralarm.xlsx', $disk = null)
    {
        Excel::store(new FlyeralarmAddressExport($this), $path, $disk);
    }

    public static function byUrl($url) : Promotion
    {
        return self::where('url', $url)->firstOrFail();
    }
}
