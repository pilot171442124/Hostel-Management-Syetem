<?php

namespace App\Imports;

use App\Models\Manageloginid;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentidImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Manageloginid([
         
            //'id'     => $row[0],
            'studentid'    => $row[0], 
            'studentname'    => $row[1], 
            'studentdept'    => $row[2],
            'batch'   => $row[3]
        

        ]);
    }
}
