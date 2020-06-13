<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'nama_toko' => 'Azkha Rental',
            'alamat' => 'Jl. Setail no. 30',
            'telepon' => '0217655150',
        ]);
    }
}
