<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
<<<<<<< HEAD
            StadeSeeder::class
=======
            ReservationSeeder::class,
>>>>>>> 673a559cb3fdc19be4bc1b897ce95f1b10c5789d

        ]);
        // \App\Models\User::factory(10)->create();
       // \App\Models\stades::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
