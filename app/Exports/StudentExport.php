<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentExport implements FromCollection, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Student::select('student_id', 'first_name', 'last_name','middle_name','home_address','city_address','contact_no',
                'email','gender','birthdate','birth_address','citizenship','religion','civil_status','fathers_name','fathers_occupation','mothers_name',
                'mothers_occupation','guardians_name','guardian_contact','primary','primary_sy','primary_awards','secondary','secondary_sy',
                'secondary_awards','senior_high','senior_high_sy','senior_high_awards','created_at','required_document'
               )->get();;
        // return Student::all();
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
            'Required Document'
        ];
    }
}
