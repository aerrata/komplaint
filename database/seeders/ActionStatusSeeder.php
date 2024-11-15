<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ActionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('action_statuses')->insert([
            ['name' => 'COMPLETED', 'color' => 'bg-success'],
            ['name' => 'IN PROGRESS', 'color' => 'bg-primary'],
            ['name' => 'PENDING', 'color' => 'bg-danger'],
        ]);
    }
}
