<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Clinic;

class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clinic::create([
            'id' => '1',
            'name' => 'Clinic 1',
            'description' => 'Demo'
        ]);
        Clinic::create([
            'id' => '2',
            'name' => 'Clinic 2',
            'description' => 'Demo'
        ]);
        Clinic::create([
            'id' => '3',
            'name' => 'Clinic 3',
            'description' => 'Demo'
        ]);
    }
}
