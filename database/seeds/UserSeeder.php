<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker=Faker::create();
        DB::table('users')->insert([
            'name'  => 'vane',
            'email'     => 'vane@gmail.com',
            'password'  => bcrypt('admin123'),
            'estado'  => 0,
            ]);
        }
}
