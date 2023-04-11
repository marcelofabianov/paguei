<?php

declare(strict_types=1);

namespace App\Consumers\Customers\Http\Controllers;

use App\Consumers\Customers\Dto\CreateCategoryDto;
use App\Consumers\Customers\Dto\UpdateCategoryDto;
use App\Contracts\Consumers\Customers\Repositories\CategoryRepository;
use App\Domain\ValueObjects\Uuid;
use App\Main\Http\Controllers\Controller;
use App\Main\Http\Controllers\DefaultJsonResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class CategoriesController extends Controller
{
    use DefaultJsonResponseTrait;

    public function __construct(
        private CategoryRepository $categoryRepository,
    ) {
    }

    public function store(Request $request): JsonResponse
    {
        $this->validate($request, ['name' => 'required|string|max:255|min:3|unique:categories,name']);

        $createCategoryDto = new CreateCategoryDto(
            name: $request->input('name'),
            userId: Uuid::create($request->user()->id),
        );

        $category = $this->categoryRepository->createNewCategory($createCategoryDto);

        return $this->created($category->toArray());
    }

    public function update(Request $request, string $categoryId): JsonResponse
    {
        $this->validate($request, ['name' => 'required|string|max:255|min:3|unique:categories,name,'.$categoryId]);

        $updateCategoryDto = new UpdateCategoryDto(
            categoryId: Uuid::create($categoryId),
            userId: Uuid::create($request->user()->id),
            name: $request->input('name'),
            inactivated: $request->input('inactivated'),
        );

        $category = $this->categoryRepository->updateCategory($updateCategoryDto);

        return $this->success($category->toArray());
    }
}
