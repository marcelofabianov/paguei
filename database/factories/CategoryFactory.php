<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domain\Models\Category;
use App\Domain\Models\User;
use App\Domain\ValueObjects\Uuid;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public $model = Category::class;

    public function definition(): array
    {
        return [
            'id' => Uuid::random()->getValue(),
            'userId' => User::factory(),
            'name' => fake()->name(),
            'public' => false,
            'inactivatedAt' => null,
            'createdAt' => now(),
            'updatedAt' => now(),
            'deletedAt' => null,
        ];
    }
}
