<?php

namespace App\Imports;

use App\Building;
use Maatwebsite\Excel\Concerns\ToModel;

class BuildingImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Building([
            //
        ]);
    }
}
