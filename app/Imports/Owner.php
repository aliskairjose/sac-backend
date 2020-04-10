<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::
    default('none');

class Owner implements ToModel, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        return new Owner(
            [
                'email'         => $row['TITLE'],
                'name'          => $row['NOMBRE'],
                'surname'       => $row['APELLIDO'],
                'cedula'        => $row['CEDULA'],
                'phone'         => $row['TELEFONO'],
                'floor'         => $row['PISO'],
                'apartment'     => $row['APARTAMENTO'],
                'parking_lot'   => $row['PUESTO ESTACIONAMIENTO'],
                'main'          => $row['PERTENECE A LA JUNTA DE CONDOMINIO'],
                'building_id'   => $row['ID RESIDENCIA'],
                'user_id'       => $row['USER ID']
            ]
        );
    }
}
