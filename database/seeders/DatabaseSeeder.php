<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(EstablecimientosSeeder::class);
        $this->call(OpcionesTableSeeder::class);
        $this->call(RolOpcionesTableSeeder::class);
        $this->call(UsersRolEstablecimientoSeeder::class);

    }
}
