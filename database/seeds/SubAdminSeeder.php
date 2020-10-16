<?php

use Illuminate\Database\Seeder;

class SubAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\SubAdmin::create([
            'name' => 'sub-admin',
            'email' => 'subadmin@gmail.com',
            'password' => bcrypt('123456789')
        ]);
    }
}
