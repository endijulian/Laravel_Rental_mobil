<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        User::create([
            'name' => 'Dany Ismail',
            'email' => 'dany_arie@yahoo.com',
            'password' => bcrypt('secret'),
            'email_verified_at' => now()
        ]);
    }
}
