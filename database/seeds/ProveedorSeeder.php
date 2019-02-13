<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        DB::table('proveedors')->insert([
            'nombre'  => 'No Proveedor',
            'nit'=>000000,
            'direccion'=>'Sin direccion',
            'telefono'=>00000,
            'estado'=>1,
            	
        ]);
    }
}
