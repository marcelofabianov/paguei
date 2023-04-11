<?php

declare(strict_types=1);

use App\Consumers\Customers\Dto\CreateCategoryDto;
use App\Consumers\Customers\Repositories\CategoryRepository;
use App\Domain\Models\Category;
use App\Domain\Models\User;
use App\Domain\ValueObjects\Uuid;

test('Deve criar uma nova categoria com a instancia "CreateCategoryDto" e após retornar o registro', function () {
    $user = User::factory()->createOneQuietly();
    $createCategoryDto = new CreateCategoryDto(
        name: fake()->word(),
        userId: Uuid::create($user->id),
    );

    $categoryRepository = new CategoryRepository(new Category());
    $category = $categoryRepository->createNewCategory($createCategoryDto);

    expect($category)
        ->toBeInstanceOf(Category::class)
        ->and($category->name)->toBe($createCategoryDto->name)
        ->and($category->userId->getValue())->toBe($createCategoryDto->userId->getValue());
})->group('integration', 'CategoryRepository');
