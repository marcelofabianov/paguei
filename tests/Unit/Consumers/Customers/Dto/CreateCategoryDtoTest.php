<?php

declare(strict_types=1);

use App\Consumers\Customers\Dto\CreateCategoryDto;
use App\Domain\ValueObjects\Uuid;

test('Deve criar uma nova instancia de CreateCategoryDto', function () {
    $expected = [
        'name' => fake()->word(),
        'userId' => Uuid::random(),
        'public' => false,
        'inactivatedAt' => null,
    ];

    $createCategoryDto = new CreateCategoryDto(
        name: $expected['name'],
        userId: $expected['userId'],
    );

    expect($createCategoryDto->toArray())
        ->toEqual($expected);
})
    ->group('unit', 'dto', 'CreateCategoryDto');
