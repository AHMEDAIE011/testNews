<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

          $keywords =['news-350x223-1.jpg','news-350x223-2.jpg','news-350x223-3.jpg','news-350x223-4.jpg','news-350x223-5.jpg','news-450x350-1.jpg','news-450x350-2.jpg'];
            $keyword = fake()->randomElement($keywords);
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'username' => fake()->userName(),
            'image' => 'assets/front/img/' . $keyword,
            'status' => fake()->randomElement([1,0]),


            'country' => fake()->country(),
            'city' => fake()->city(),
            'street' => fake()->streetAddress(),
            'phone' => fake()->phoneNumber(),



            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
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
