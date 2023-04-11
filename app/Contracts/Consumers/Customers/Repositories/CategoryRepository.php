<?php

declare(strict_types=1);

namespace App\Contracts\Consumers\Customers\Repositories;

use App\Consumers\Customers\Dto\CreateCategoryDto;
use App\Domain\Models\Category;

/**
 * @property-read Category $categoryModel
 */
interface CategoryRepository
{
    public function __construct(Category $categoryModel);

    public function createNewCategory(CreateCategoryDto $createCategoryDto): Category;
}
