<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'directv']);
        Role::create(['name' => 'hughesnet']);
        Role::create(['name' => 'dtv_hugs']);

        // Permission::create(['name' => 'ver:role']);
        // Permission::create(['name' => 'crear:role']);
        // Permission::create(['name' => 'editar:role']);
        // Permission::create(['name' => 'eliminar:role']);

        // Permission::create(['name' => 'ver:permiso']);
        // Permission::create(['name' => 'crear:permiso']);
        // Permission::create(['name' => 'editar:permiso']);
        // Permission::create(['name' => 'eliminar:permiso']);


        \App\Models\User::create([
            'name' => 'Santiago Giraldo',
            'email' => 'santiagogil271@gmail.com',
            'password' => bcrypt('12345678'),
            'operation' => 'admin',
            'city' => 'manizales',
            'region' => 'caldas',
            'phone' => '3023718033',

        ])->assignRole('admin');

        // \App\Models\User::create([
        //     'name' => 'Santiago Aliado',
        //     'email' => 'santiagogil270@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'operation' => 'directv',
        //     'city' => 'manizales',
        //     'region' => 'caldas',
        //     'phone' => '3117030374',

        // ])->assignRole('directv');

        // \App\Models\User::create([
        //     'name' => 'Santiago husg',
        //     'email' => 'santiagogil272@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'operation' => 'hughesnet',
        //     'city' => 'manizales',
        //     'region' => 'caldas',
        //     'phone' => '3117030375',

        // ])->assignRole('hughesnet');

        // \App\Models\User::create([
        //     'name' => 'Santiago doble',
        //     'email' => 'santiagogil273@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'operation' => 'dtv_hugs',
        //     'city' => 'manizales',
        //     'region' => 'caldas',
        //     'phone' => '3117030376',

        // ])->assignRole('dtv_hugs');
    }
}
