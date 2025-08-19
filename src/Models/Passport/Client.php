<?php

namespace ChrisReedIO\FilamentOAuthClients\Models\Passport;

use ChrisReedIO\FilamentOAuthClients\Enums\OAuth\ClientScope;
use ChrisReedIO\FilamentOAuthClients\Enums\OAuth\ClientType;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Support\Str;
use Laravel\Passport\Client as BaseClient;

use function array_key_exists;

/**
 * @property string $type
 * @property array $grant_types
 * @property array $redirect_uris
 * @property array $scopes
 * @property bool $personal_access_client
 * @property bool $password_client
 * @property bool $revoked
 */
class Client extends BaseClient
{
    protected $fillable = [
        'type',
        'name',
        'owner_id',
        'owner_type',
        'redirect_uris',
    ];

    protected function casts(): array
    {
        return [
            'type' => ClientType::class,
            'grant_types' => 'array',
            'redirect_uris' => 'array',
            'scopes' => AsEnumCollection::of(ClientScope::class),
            'personal_access_client' => 'bool',
            'password_client' => 'bool',
            'revoked' => 'bool',
        ];
    }

    protected static function booted(): void
    {
        parent::booted();

        static::creating(function (Client $client) {
            $client->revoked = false;
            $client->secret = Str::random(40);
            // if (array_key_exists('type', $client->attributes)) {
            //     $clientType = $client->type;
            //     if ($clientType === ClientType::Personal) {
            //         $client->personal_access_client = true;
            //         $client->password_client = false;
            //     } elseif ($clientType === ClientType::Password) {
            //         $client->personal_access_client = false;
            //         $client->password_client = true;
            //     } else {
            //         $client->personal_access_client = false;
            //         $client->password_client = false;
            //     }
            // }

            // if ($client->redirect_uris === null || empty($client->redirect_uris)) {
            //     $client->redirect_uris = [];
            // }

            // if ($client->revoked === null) {
            //     $client->revoked = false;
            // }
        });
    }

    public function regenerateSecret(): void
    {
        $this->forceFill([
            'secret' => Str::random(40),
        ])->save();
    }
}
