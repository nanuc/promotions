<?php

namespace Nanuc\Promotions\Imports;


use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Nanuc\Promotions\Models\PromotionReceiver;

class PromotionReceiversImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $additionalDataKeys = array_diff(array_keys($row), [
            'name',
            'email',
            'address_line_1',
            'address_line_2',
            'address_line_3',
            'address_line_4',
            'locality',
            'region',
            'zip',
            'country',
            ''
        ]);

        return new PromotionReceiver([
            'name' => Arr::get($row, 'name'),
            'email' => Arr::get($row, 'email'),
            'address_line_1' => Arr::get($row, 'address_line_1'),
            'address_line_2' => Arr::get($row, 'address_line_2'),
            'address_line_3' => Arr::get($row, 'address_line_3'),
            'address_line_4' => Arr::get($row, 'address_line_4'),
            'locality' => Arr::get($row, 'locality'),
            'region' => Arr::get($row, 'region'),
            'zip' => Arr::get($row, 'zip'),
            'country' => Arr::get($row, 'country'),
            'additional_data' => Arr::only($row, $additionalDataKeys),
        ]);
    }
}
