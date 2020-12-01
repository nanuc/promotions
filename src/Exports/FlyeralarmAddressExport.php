<?php

namespace Nanuc\Promotions\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Nanuc\Promotions\Models\Promotion;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FlyeralarmAddressExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $promotion;

    public function __construct(Promotion $promotion)
    {
        $this->promotion = $promotion;
    }

    public function collection()
    {
        return $this->promotion->promotionCodes
            ->map(function($promotionCode) {
                $promotionReceiver = $promotionCode->promotionReceiver;
                return [
                    $promotionReceiver->name,
                    '',
                    '',
                    '',
                    '',
                    $promotionReceiver->name,
                    $promotionReceiver->address_line_1,
                    $promotionReceiver->address_line_2,
                    '',
                    $promotionReceiver->zip,
                    $promotionReceiver->locality,
                    $promotionReceiver->country,
                    '',
                    $promotionCode->code,
                ];
            });
    }

    public function headings(): array
    {
        return [
            ['Firma', 'Firma Zusatz', 'Anrede', 'Titel', 'Vorname', 'Nachname', 'Strasse', 'Hausnummer', 'Postfach', 'PLZ',	'Ort', 'Land', 'Briefanrede', 'Promotion-Code'],
        ];
    }
}
