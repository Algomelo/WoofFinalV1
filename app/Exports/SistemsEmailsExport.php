<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\EModels\User;

class SistemsEmailsExport implements FromCollection
{
    /**
     *  @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::all();
    }
}
