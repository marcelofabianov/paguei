<?php

declare(strict_types=1);

use App\Domain\Models\Category;

test('Deve criar uma categoria', function () {
    /**
     * @var Category $category
     */
    $category = Category::factory()->createOneQuietly();

    $this->assertDatabaseHas('categories', [
        'id' => $category->id,
        'name' => $category->name,
        'public' => $category->public,
    ]);
});
