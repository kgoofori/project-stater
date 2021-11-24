<?php

use Illuminate\Database\Seeder;
use App\Models\VerificationCard;

class VerificationCardSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VerificationCard::insert([
            ['name' => 'Voter ID', 'expires' => false, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Passport', 'expires' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'National ID', 'expires' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Health Insurance ID', 'expires' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => "Driver's License", 'expires' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Others', 'expires' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
