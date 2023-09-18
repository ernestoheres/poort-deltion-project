<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\nl_NL\Person;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Client::class;

    public function definition(): array
    {
        $this->faker->addProvider(new Person($this->faker));
        return [
            'voornaam' => $this->faker->firstName(),
            'tussenvoegels' => $this->faker->randomLetter(),
            'achternaam' => $this->faker->lastName(),
            'adres' => $this->faker->streetAddress(),
            'postcode' => $this->faker->postcode(),
            'woonplaats' => $this->faker->city(),
            'land' => $this->faker->country(),
            'telefoon' => $this->faker->phoneNumber(),
            'bsn' => $this->faker->idNumber(),
            'vezekering' => $this->faker->company(),
            'polisnummer' => $this->faker->randomNumber(),

        ];

    }
}
