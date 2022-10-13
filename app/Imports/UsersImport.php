<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'category_id' => $row[1],
            'name' => $row[2],
           'collage_email'  => $row[3], 
           'personal_email' => $row[4], 
           'phone' => $row[5],
           'another_phone' => $row[6],
           'identify_num' => $row[7],
           'date_of_birth' => \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[8])),
        ]);
    }

    
}
