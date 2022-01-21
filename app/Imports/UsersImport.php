<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = User::create([
            'name' => $row['nombre'],
            'email' => $row['correo'],
            'password' => bcrypt($row['contrasena']),
            'operation' => $row['operacion'],
            'city' => $row['ciudad'],
            'region' => $row['region'],
            'phone' => $row['telefono'],

        ])->assignRole($row['operacion']);

        return $user;
    }
}
