<?php

namespace Centagon\Frizzle\Contracts;

interface TokenRepository
{
    /**
     * Retrieve the tokens.
     *
     * @return array
     */
    public function getTokens(): array;

    /**
     * Register a new token with the given client name.
     *
     * @param  string $name
     * @return array
     */
    public function register(string $name): array;

    /**
     * Determine that the given token exists.
     *
     * @param  string $token
     * @return bool
     */
    public function exists(string $token): bool;

    /**
     * Destroy the given api-token.
     *
     * @param  string $token
     * @return void
     */
    public function destroy(string $token): void;
}
