<?php

namespace Centagon\Frizzle\Repositories;

use Centagon\Frizzle\Contracts\TokenRepository;

class RedisTokenRepository extends RedisRepository implements TokenRepository
{
    /**
     * The hash key that stores the tokens.
     *
     * @var string
     */
    protected $hashKey = 'tokens';

    /**
     * Retrieve the tokens.
     *
     * @return array
     */
    public function getTokens(): array
    {
        return $this->connection()->hgetall($this->hashKey);
    }

    /**
     * Register a new token with the given client name.
     *
     * @param  string $name
     * @return array
     */
    public function register(string $name): array
    {
        $token = sprintf('%s--%s', $client = str_slug($name), str_random(16));

        $this->connection()->hset($this->hashKey, $token, $client);

        return ['token' => $token, 'client' => $client];
    }

    /**
     * Determine that the given token exists.
     *
     * @param  string $token
     * @return bool
     */
    public function exists(string $token): bool
    {
        return $this->connection()->hexists($this->hashKey, $token);
    }

    /**
     * Destroy the given api-token.
     *
     * @param  string $token
     * @return void
     */
    public function destroy(string $token): void
    {
        $this->connection()->hdel($this->hashKey, $token);
    }
}
