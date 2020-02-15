<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::
default('none');

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $main = false;

        if ($row['Pertenece a la Junta de Condominio'] === 'SI') {
            $main = true;
        }
        return new User([
            'name'          => $row['Nombre'],
            'surname'       => $row['Apellido'],
            'cedula'        => $row['Cedula'],
            'phone'         => $row['Telefono'],
            'email'         => $row['Email'],
            'building_id'   => $row['Id Residencia'],
            'floor'         => $row['Piso'],
            'apartment'     => $row['apartamento'],
            'parking_lot'   => $row['Puesto Estacionamiento'],
            'role_id'       => 3,
            'main'          => $main,
        ]);
    }
}
