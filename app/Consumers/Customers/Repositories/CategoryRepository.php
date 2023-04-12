<?php

declare(strict_types=1);

namespace App\Consumers\Customers\Repositories;

use App\Consumers\Customers\Dto\CreateCategoryDto;
use App\Consumers\Customers\Dto\UpdateCategoryDto;
use App\Contracts\Consumers\Customers\Repositories\CategoryRepository as CategoryRepositoryContract;
use App\Domain\Models\Category;
use App\Domain\ValueObjects\Uuid;
use Illuminate\Contracts\Pagination\Paginator;

final readonly class CategoryRepository implements CategoryRepositoryContract
{
    public function __construct(
        private Category $categoryModel
    ) {
    }

    public function listCategories(Uuid $userId): Paginator
    {
        return $this->categoryModel
            ->whereCreator($userId)
            ->whenActive()
            ->orderByName()
            ->paginate();
    }

    public function findCategory(Uuid $categoryId, Uuid $userId): Category
    {
        return $this->categoryModel
            ->whereCategoryAndCreator($categoryId, $userId)
            ->firstOrFail();
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
            ->whereCategoryAndCreator($updateCategoryDto->categoryId, $updateCategoryDto->userId)
            ->firstOrFail();

        $category->fill($updateCategoryDto->toArray());
        $category->save();

        return $category;
    }

    public function deleteCategory(Uuid $categoryId, Uuid $userId): bool
    {
        $category = $this->categoryModel
            ->whereCategoryAndCreator($categoryId, $userId)
            ->firstOrFail();

        return $category->delete();
    }
}
