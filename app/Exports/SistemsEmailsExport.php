<?php

namespace App\Exports;

use App\Models\SistemsEmails;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SistemsEmailsExport implements FromView
{
    /**
     *  @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view ('exportEmails', [
            'sistemsemails' => SistemsEmails::all()
        ]);
    }
}
