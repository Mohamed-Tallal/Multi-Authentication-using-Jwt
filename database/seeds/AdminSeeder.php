<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Admin::create([
           'name' => 'name1',
           'email' => 'email1@gmail.com',
           'password' => bcrypt('987654321')
        ]);
    }
}
