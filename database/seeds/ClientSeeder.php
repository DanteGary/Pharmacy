<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        DB::table('clients')->insert([
            'nombre'  => 'Sin Nombre',
            'apellidos'=>'Sin Apellido',
            'nit'=>0,
            'estado'=>1,
            
        ]);
    }
}
