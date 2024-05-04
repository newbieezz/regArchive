<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Student::all();
    }

    public function headings(): array{
        return [
            'Student ID',
            'First Name',
            'Last Name',
            'Middle Name',
            'Home Address',
            'City Address',
            'Contact Number',
            'Email',
            'Gender',
            'Birthdate',
            'Birth Address',
            'Citizenship',
            'Religion',
            'Civil Status',
            'Fathers Name',
            'Fathers Occupation',
            'Mothers Name',
            'Mothers Occupation',
            'Guardians Name',
            'Guardian Contact',
            'Primary',
            'Primary SY',
            'Primary Awards',
            'Secondary',
            'Secondary SY',
            'Secondary Awards',
            'Senior High',
            'Senior High SY',
            'Senior High Awards',
            'Created_at',
            'Updated_at'
        ];
    }
}
