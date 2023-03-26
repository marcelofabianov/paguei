<?php

declare(strict_types=1);

namespace App\Main\Console\Commands;

use App\Domain\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use JsonException;
use Laravel\Passport\ClientRepository;

class OAuth extends Command
{
    protected $signature = 'app:oauth';

    protected $description = 'Fake OAuth command for testing';

    /**
     * @throws JsonException
     */
    public function handle(): void
    {
        DB::table('users')->where('email', 'bob@email.com')->delete();

        $user = User::factory()->createOneQuietly([
            'name' => 'Bob',
            'email' => 'bob@email.com',
        ]);

        $client = new ClientRepository();
        $result = $client->create(
            userId: $user->uuid,
            name: 'paguei',
            redirect: '',
            provider: null,
            personalAccess: true,
            password: true
        );

        $credentials = [
            'grant_type' => 'password',
            'client_id' => $result->id,
            'client_secret' => $result->secret,
            'username' => $user->email,
            'password' => 'password',
            'scope' => '*',
        ];

        $this->info('User Api Credentials');

        $this->info(json_encode($credentials, JSON_THROW_ON_ERROR));
    }
}
