<?php

namespace App\Exports;

use App\Models\StudentExtraCurriculars;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExtraExport implements FromCollection,WithHeadings 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return StudentExtraCurriculars::select('id','organization','duties_responsibilities','interest')->where('users_id','=',session()->get('user_id'))->get();
    }

    public function headings(): array
    {
        return [
          'ID',
          'Organization',
          'Duties & Responsibilities',          
          'Interest',
        ];
    }
}
