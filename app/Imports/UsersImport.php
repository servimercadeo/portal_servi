<?php

namespace App\Imports;

use App\Models\User;
use Carbon\Carbon;
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
        $sup = 1;
        if(User::where('name', 'like', $row['lider'].'%')->exists()){
            $sup = User::where('name', 'like', $row['lider'].'%')->first()->id;
        }


        $user = User::updateOrCreate(
            ['nit' => $row['nit']],
            [
            'name' => $row['nombre'].' '.$row['apellidos'],
            'email' => $row['correo'],
            'password' => bcrypt($row['nit']),
            'operation' => $row['operacion'],
            'city' => $row['ciudad'],
            'id_pais' => $row['pais'],
            'phone' => $row['telefono'],
            'nit' => $row['nit'],
            'id_portal' => 5,
            'fecha_ingreso' => Carbon::parse($row['fecha_ingreso'])->format('y-m-d'),
            'empleador' => $row['empleador'],
            'proceso' => $row['proceso'],
            'id_supervisor' => $sup,
        ])->assignRole($row['rol']);

        return $user;
    }
}
