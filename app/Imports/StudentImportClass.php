<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Carbon\Carbon;

class StudentImportClass implements ToCollection
{
    private $formattedData = [];

    public function collection(Collection $rows)
    {
        foreach ($rows->slice(1) as $row) {
            // Format each row as needed
            if (!empty($row[0]) && !empty($row[1]) && !empty($row[2]) && !empty($row[3])) {
                $this->formattedData[] = [
                    'student_id' => $row[0],
                    'first_name' => $row[1],
                    'last_name' => $row[2],
                    'middle_name' => $row[3],
                    'home_address' => $row[4],
                    'city_address' => $row[5],
                    'contact_no' => $row[6],
                    'email' => $row[7],
                    'gender' => $row[8],
                    'birthdate' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[9]))->format('Y-m-d'),
                    'birth_address' => $row[10],
                    'citizenship' => $row[11],
                    'religion' => $row[12],
                    'civil_status' => $row[13],
                    'fathers_name' => $row[14],
                    'fathers_occupation' => $row[15],
                    'mothers_name' => $row[16],
                    'mothers_occupation' => $row[17],
                    'guardians_name' => $row[18],
                    'guardian_contact' => $row[19],
                    'primary' => $row[20],
                    'primary_sy' => $row[21],
                    'primary_awards' => $row[22],
                    'secondary' => $row[23],
                    'secondary_sy' => $row[24],
                    'secondary_awards' => $row[25],
                    'senior_high' => $row[26],
                    'senior_high_sy' => $row[26],
                    'senior_high_awards' => $row[28],
                    // Add more columns as needed
                ];
            }
        }
    }

    public function getFormattedData()
    {
        return $this->formattedData;
    }
}