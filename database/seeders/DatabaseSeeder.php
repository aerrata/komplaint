<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ActionStatusSeeder::class,
            RolesAndPermissionsSeeder::class
        ]);

        \App\Models\User::factory()->roles(['admin'])->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@domain.com',
        ]);

        \App\Models\User::factory()->roles(['admin'])->create([
            'name' => 'User',
            'email' => 'admin@domain.com',
        ]);

        \App\Models\User::factory()->roles(['investigator'])->create([
            'name' => 'Investigator 1',
            'email' => 'investigator1@domain.com',
        ]);

        \App\Models\User::factory()->roles(['investigator'])->create([
            'name' => 'Investigator 2',
            'email' => 'investigator2@domain.com',
        ]);

        // \App\Models\User::factory(2)->roles(['investigator'])->create();

        \App\Models\Complaint::factory(5)->create();
        \App\Models\Action::factory(15)->create();
    }
}
