<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BlankSheetExport implements FromArray, WithHeadings
{
    /**
     * @return array
     */
    public function array(): array
    {
        // Return an empty array or an array with default data
        return [];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Define your column headings here
        return [
            'name',
            'description',
            'imagepath',
            'category',
            'status',
            'price',
            'Total_no_of_product',
            'sold',

            // Add more columns as needed
        ];
    }
}
