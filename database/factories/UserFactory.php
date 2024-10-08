<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Country;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'username' => fake()->userName,
            // 'first_name' => fake()->firstName,
            // 'last_name' => fake()->lastName,
            // 'email' => fake()->unique()->safeEmail(),
            // 'password' => static::$password ??= Hash::make('password'),
            // 'country_id' => Country::factory(),
            // 'remember_token' => Str::random(10),

            'username' => 'Radovana',
            'first_name' => 'Aljaz',
            'last_name' => 'Radovan',
            'email' => 'radovan.aljaz@gmail.com',
            'password' => '123',
            'country_id' => Country::inRandomOrder()->first()->id,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
