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
            ['name' => 'Completed', 'color' => 'bg-green'],
            ['name' => 'In-progress', 'color' => 'bg-blue'],
            ['name' => 'Pending', 'color' => 'bg-warning'],
        ]);
    }
}
