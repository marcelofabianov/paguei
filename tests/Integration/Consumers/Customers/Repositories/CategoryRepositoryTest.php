<?php

declare(strict_types=1);

use App\Consumers\Customers\Dto\CreateCategoryDto;
use App\Consumers\Customers\Dto\UpdateCategoryDto;
use App\Consumers\Customers\Repositories\CategoryRepository;
use App\Domain\Models\Category;
use App\Domain\Models\User;
use App\Domain\ValueObjects\Uuid;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
})
    ->group('integration', 'CategoryRepository');

test('Deve atualizar um registro de categoria conforme "UpdateCategoryDto" e retornar o registro atualizado', function () {
    $user = User::factory()->createOneQuietly();
    $category = Category::factory()->createOneQuietly(['userId' => $user->id]);
    $updateCategoryDto = new UpdateCategoryDto(
        categoryId: Uuid::create($category->id),
        userId: Uuid::create($user->id),
        name: fake()->word(),
        inactivated: true
    );

    $categoryRepository = new CategoryRepository(new Category());
    $category = $categoryRepository->updateCategory($updateCategoryDto);

    expect($category)
        ->toBeInstanceOf(Category::class)
        ->and($category->name)->toBe($updateCategoryDto->name)
        ->and($category->userId->getValue())->toBe($updateCategoryDto->userId->getValue())
        ->and($category->id)->toBe($updateCategoryDto->categoryId->getValue())
        ->and($category->inactivatedAt)->toBeInstanceOf(DateTimeInterface::class);
})
    ->group('integration', 'CategoryRepository');

test('Deve retornar um erro ao tentar atualizar um registro de "Category" que nao existe', function () {
    $updateCategoryDto = new UpdateCategoryDto(
        categoryId: Uuid::random(),
        userId: Uuid::random(),
        name: fake()->word(),
        inactivated: true
    );

    $categoryRepository = new CategoryRepository(new Category());

    $this->expectException(ModelNotFoundException::class);

    $categoryRepository->updateCategory($updateCategoryDto);
})
    ->group('integration', 'CategoryRepository', 'fail', 'exception');
