<?php

declare(strict_types=1);

namespace App\Consumers\Customers;

use App\Contracts\Consumers\Customers\Repositories\CategoryRepository;
use App\Domain\Models\Category;

final class CustomersContainer
{
    public function register(): void
    {
        $this->registerRepositories();
    }

    private function registerRepositories(): void
    {
        app()->bind(CategoryRepository::class, function () {
            return new \App\Consumers\Customers\Repositories\CategoryRepository(new Category());
        });
    }
}
