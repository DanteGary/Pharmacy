<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        DB::table('categories')->insert([
            'nombre'  => 'Sin Categoria',
            'estado'=>1,
            
        ]);
    }
}
