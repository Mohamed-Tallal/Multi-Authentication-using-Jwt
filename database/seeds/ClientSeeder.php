<?php

use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Client::create([
            'name' => 'client',
            'email' => 'client@gmail.com',
            'password' => bcrypt('123456789')
        ]);
    }
}
