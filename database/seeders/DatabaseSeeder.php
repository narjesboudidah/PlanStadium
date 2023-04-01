<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use UsersTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([//tartib mouhim
            UsersTableSeeder::class,
            competitionSeeder::class,
            equipeSeeder::class,
            steSeeder::class,
            stadeSeeder::class,
            eventSeeder::class,
            historiqueSeeder::class,
            maintenanceSeeder::class,
            matchSeeder::class,
            PermissionsTableSeeder::class,
            roleSeeder::class,
            permission_roleSeeder::class,
            role_user_pivotSeeder::class,
            reservationSeeder::class,

        ]); 
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
