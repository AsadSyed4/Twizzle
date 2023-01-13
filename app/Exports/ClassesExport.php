<?php

namespace App\Exports;

use App\Models\StudentClassesGrades;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClassesExport implements FromCollection,WithHeadings 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return StudentClassesGrades::select('id','year','course_title','teacher_name','final_grade','interest','gpa')->where('users_id','=',session()->get('user_id'))->get();
    }

    public function headings(): array
    {
        return [
          'Id',
          'Year',
          'Course Title',
          'Teacher Name',
          'Final Grade',
          'Interest',
          'GPA'
        ];
    }
}
