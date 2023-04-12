<?php

declare(strict_types=1);

namespace App\Consumers\Customers\Repositories;

use App\Consumers\Customers\Dto\CreateCategoryDto;
use App\Consumers\Customers\Dto\UpdateCategoryDto;
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

    public function updateCategory(UpdateCategoryDto $updateCategoryDto): Category
    {
        $category = $this->categoryModel
            ->whereCreator($updateCategoryDto->categoryId, $updateCategoryDto->userId)
            ->firstOrFail();

        $category->fill($updateCategoryDto->toArray());
        $category->save();

        return $category;
    }
}
