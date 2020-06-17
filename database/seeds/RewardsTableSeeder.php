<?php

use App\Reward;
use Illuminate\Database\Seeder;

class RewardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reward::create([
            'title' => 'Gelas 1 Lusin',
            'poin' => 5,
            'status' => true,    
        ]);
        Reward::create([
            'title' => 'Topi',
            'poin' => 7,
            'status' => true,
        ]);
        Reward::create([
            'title' => 'Jacket',
            'poin' => 20,
            'status' => true,
        ]);
    }
}
