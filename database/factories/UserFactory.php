<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'username' => fake()->userName(), 
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('12345678'),
            'remember_token' => Str::random(10),
            'role' => 'borrower', 
        ];
    }
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'username' => 'admin',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);
    }
    public function officer(): static
    {
        return $this->state(fn (array $attributes) => [
            'username' => 'petugas',
            'password' => Hash::make('12345678'),
            'role' => 'officer',
        ]);
    }
public function nia(): static
    {
        return $this->state(fn (array $attributes) => [
            'username' => 'Agniya',
            'password' => Hash::make('12345678'),
            'role' => 'borrower',
        ]);
    }
}
