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
        auth()->login(User::factory()->createOneQuietly());

        DB::table('users')->where('email', 'bob@email.com')->delete();

        $user = User::factory()->createOne([
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
        $json = json_encode($credentials, JSON_THROW_ON_ERROR);

        $this->info('User Api Credentials');

        $this->info($json);

        ds($json, $credentials)->label('User Api Credentials');
    }
}
