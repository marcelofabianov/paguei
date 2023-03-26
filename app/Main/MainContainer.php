<?php

declare(strict_types=1);

namespace App\Main;

use App\Consumers\Administrators\AdministratorsContainer;
use App\Consumers\Customers\CustomersContainer;
use App\Domain\DomainContainer;

final class MainContainer
{
    public function register(): void
    {
        $domain = new DomainContainer();
        $domain->register();

        $administrators = new AdministratorsContainer();
        $administrators->register();

        $customers = new CustomersContainer();
        $customers->register();
    }
}
