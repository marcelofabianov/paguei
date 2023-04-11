<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domain\Models\User;
use App\Domain\ValueObjects\Uuid;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

final class UserFactory extends Factory
{
    public $model = User::class;

    public function definition(): array
    {
        return [
            'id' => Uuid::random()->getValue(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role' => fake()->randomElement(['administrator', 'customer']),
            'inactivatedAt' => null,
            'createdAt' => now(),
            'updatedAt' => now(),
            'deletedAt' => false,
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
