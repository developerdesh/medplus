<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class ProductImport implements ToCollection, WithHeadingRow
{
    public $data = [];

    public function collection(Collection $collection)
    {
        // Store the data for use in the controller
        $this->data = $collection;
    }
}
