<?php

declare(strict_types=1);

use App\Domain\Models\User;

test('Deve criar um usuario', function () {
    /**
     * @var User $user
     */
    $user = User::factory()->createOneQuietly();

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'role' => $user->role,
        'inactivatedAt' => null,
    ]);
})
    ->group('unit', 'User');
