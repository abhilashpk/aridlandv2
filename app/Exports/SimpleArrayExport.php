<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Font;

class SimpleArrayExport implements FromArray, WithTitle, WithProperties
{
    protected $data;
    protected $title;
    protected $company;
    protected array $boldRows;

    public function __construct($data, $title, $company, array $boldRows = [])
    {
        $this->data    = $data;
        $this->title   = $title;
        $this->company = $company;
        $this->boldRows = $boldRows;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function title(): string
    {
        return 'sheet1';
    }

    public function properties(): array
    {
        return [
            'title'       => $this->title,
            'creator'     => 'NumakPro ERP',
            'company'     => $this->company,
            'description' => $this->title,
        ];
    }

    // public function styles(Worksheet $sheet)
    // {
    //     $styles = [];
    //     foreach ($this->boldRows as $rowNumber) {
    //         $styles[$rowNumber] = ['font' => ['bold' => true]];
    //     }
    //     return $styles;
    // }

    // public function styles(Worksheet $sheet)
    // {
    //     foreach ($this->boldRows as $row) {
    //         $sheet->getStyle('A' . $row . ':Z' . $row)
    //               ->getFont()
    //               ->setBold(true);
    //     }
    // }
}
