<?php

declare(strict_types=1);

use function Pest\Laravel\get;

test('Feature Test', function () {
    get('/')
        ->assertContent('...')
        ->assertOk();
});
