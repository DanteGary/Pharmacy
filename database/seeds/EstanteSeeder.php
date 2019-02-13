<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class EstanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $faker=Faker::create();
        DB::table('estantes')->insert([
            'nombre'  => 'No Estante',
            'ubicacion'=>'No Ubicacion',
            'estado'=>1,
            
        ]);
    }
}
