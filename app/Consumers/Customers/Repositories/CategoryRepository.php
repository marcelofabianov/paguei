<?php

declare(strict_types=1);

namespace App\Consumers\Customers\Repositories;

use App\Consumers\Customers\Dto\CreateCategoryDto;
use App\Contracts\Consumers\Customers\Repositories\CategoryRepository as CategoryRepositoryContract;
use App\Domain\Models\Category;

final readonly class CategoryRepository implements CategoryRepositoryContract
{
    public function __construct(
        private Category $categoryModel
    ) {
    }

    public function createNewCategory(CreateCategoryDto $createCategoryDto): Category
    {
        $category = $this->categoryModel->newInstance();
        $category->fill($createCategoryDto->toArray());
        $category->save();

        return $category;
    }
}
