<?php

declare(strict_types=1);

namespace App\Consumers\Customers\Http\Controllers;

use App\Consumers\Customers\Dto\CreateCategoryDto;
use App\Consumers\Customers\Dto\UpdateCategoryDto;
use App\Consumers\Customers\Http\Resources\CategoryCollection;
use App\Contracts\Consumers\Customers\Repositories\CategoryRepository;
use App\Domain\ValueObjects\Uuid;
use App\Main\Http\Controllers\Controller;
use App\Main\Http\Controllers\DefaultJsonResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

final class CategoriesController extends Controller
{
    use DefaultJsonResponseTrait;

    public function __construct(
        private readonly CategoryRepository $categoryRepository,
    ) {
    }

    public function index(Request $request): CategoryCollection
    {
        return new CategoryCollection($this->categoryRepository->listCategories(
            Uuid::create($request->user()->id)
        ));
    }

    public function show(Request $request, string $categoryId): JsonResponse
    {
        try {
            $category = $this->categoryRepository->findCategory(
                Uuid::create($categoryId),
                Uuid::create($request->user()->id)
            );
        } catch (ModelNotFoundException) {
            return $this->notFound();
        }

        return $this->success($category->toArray());
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $this->validate($request, ['name' => 'required|string|max:255|min:3|unique:categories,name']);
        } catch (ValidationException $exception) {
            return $this->validateFail($exception->getMessage(), $exception->errors());
        }

        $createCategoryDto = new CreateCategoryDto(
            name: $request->input('name'),
            userId: Uuid::create($request->user()->id),
        );

        $category = $this->categoryRepository->createNewCategory($createCategoryDto);

        return $this->created($category->toArray());
    }

    public function update(Request $request, string $categoryId): JsonResponse
    {
        try {
            $this->validate($request, [
                'name' => 'required|string|max:255|min:3|unique:categories,name,'.$categoryId,
                'inactivated' => 'required|boolean',
            ]);
        } catch (ValidationException $exception) {
            return $this->validateFail($exception->getMessage(), $exception->errors());
        }

        $updateCategoryDto = new UpdateCategoryDto(
            categoryId: Uuid::create($categoryId),
            userId: Uuid::create($request->user()->id),
            name: $request->input('name'),
            inactivated: $request->input('inactivated'),
        );

        try {
            $category = $this->categoryRepository->updateCategory($updateCategoryDto);
        } catch (ModelNotFoundException) {
            return $this->notFound();
        }

        return $this->success($category->toArray());
    }

    public function destroy(Request $request, string $categoryId): JsonResponse
    {
        try {
            $this->categoryRepository->deleteCategory(
                Uuid::create($categoryId),
                Uuid::create($request->user()->id)
            );
        } catch (ModelNotFoundException) {
            return $this->notFound();
        }

        return $this->success(['message' => 'Category deleted successfully.']);
    }
}
