<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Stades;

class StadeFactory extends Factory
{
    protected $model = Stades::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->name(),
            'pays' => $this->faker->country(),
            'capacite' => $this->faker->numberBetween(1000, 50000),
            'surface' => $this->faker->numberBetween(1000, 50000),
            'longitude' => $this->faker->longitude(),
            'latitude' => $this->faker->latitude(),
            'proprietaire' => $this->faker->name(),
            'telephone' => $this->faker->phoneNumber(),
            'adresse' => $this->faker->address(),
            'image' => $this->faker->imageUrl(),
            'etat' => $this->faker->randomElement(['disponible', 'reserver', 'en maintenance']),
            'description' => $this->faker->sentence(),
            'date_dernier_travaux' => $this->faker->dateTimeThisDecade(),
        ];
    }
}
