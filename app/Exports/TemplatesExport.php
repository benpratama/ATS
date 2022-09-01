<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\User;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Exportable;

class TemplatesExport implements FromCollection,WithMultipleSheets
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }

    public function sheets(): array
    {
        $sheets = [];

        for ($month = 1; $month <= 12; $month++) {
            $sheets[] = new InvoicesPerMonthSheet($this->year, $month);
        }

        return $sheets;
    }
}
