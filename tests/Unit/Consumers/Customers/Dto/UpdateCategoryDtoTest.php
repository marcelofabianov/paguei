<?php

declare(strict_types=1);

use App\Consumers\Customers\Dto\UpdateCategoryDto;
use App\Domain\ValueObjects\Uuid;

test('Deve criar uma nova instancia de "UpdateCategoryDto"', function () {
    $expected = [
        'categoryId' => Uuid::random(),
        'userId' => Uuid::random(),
        'name' => 'Category name',
    ];

    $updateCategoryDto = new UpdateCategoryDto(
        categoryId: $expected['categoryId'],
        userId: $expected['userId'],
        name: $expected['name'],
        inactivated: true,
    );

    expect([
        'categoryId' => $updateCategoryDto->categoryId,
        'userId' => $updateCategoryDto->userId,
        'name' => $updateCategoryDto->name,
    ])
        ->toEqual($expected)
        ->and($updateCategoryDto->inactivatedAt)
        ->toBeInstanceOf(DateTimeInterface::class);
})
    ->group('unit', 'dto', 'UpdateCategoryDto');
