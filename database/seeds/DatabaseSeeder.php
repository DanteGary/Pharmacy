<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UserSeeder');
        $this->call('ClientSeeder');
        $this->call('EstanteSeeder');
        $this->call('ProveedorSeeder');
        $this->call('CategoriaSeeder');
    }
}
