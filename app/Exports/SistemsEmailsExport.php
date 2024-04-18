<?php

namespace App\Exports;

use App\Models\SistemsEmails;

use Maatwebsite\Excel\Concerns\FromCollection;

class SistemsEmailsExport implements FromCollection
{
    /**
     *  @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return SistemsEmails::all();
    }
}
