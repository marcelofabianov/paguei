<?php

declare(strict_types=1);

namespace App\Contracts\Consumers\Customers\Repositories;

use App\Consumers\Customers\Dto\CreateCategoryDto;
use App\Consumers\Customers\Dto\UpdateCategoryDto;
use App\Domain\Models\Category;
use App\Domain\ValueObjects\Uuid;

/**
 * @property-read Category $categoryModel
 */
interface CategoryRepository
{
    public function __construct(Category $categoryModel);

    public function createNewCategory(CreateCategoryDto $createCategoryDto): Category;

    public function updateCategory(UpdateCategoryDto $updateCategoryDto): Category;

    public function deleteCategory(Uuid $categoryId, Uuid $userId): bool;
}
