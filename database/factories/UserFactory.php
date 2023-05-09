<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'nom' => $this->faker->name(),
            'prenom' => $this->faker->firstName(),
            'telephone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'adresse' => $this->faker->address(),
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

