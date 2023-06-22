<?php

namespace Database\Seeders;

use App\Models\Depository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepositorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Depository::create([
            'name' => 'العهدة'
        ]);
    }
}
