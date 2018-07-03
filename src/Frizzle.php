<?php

namespace Centagon\Frizzle;

use Closure;
use Exception;
use Centagon\Frizzle\Contracts\TokenRepository;

class Frizzle
{
    /**
     * The callback that should be used to authenticate Frizzle users.
     *
     * @var \Closure
     */
    public static $authUsing;

    /**
     * Determine if the given request can access the Frizzle dashboard.
     *
     * @param  \Illuminate\Http\Request $request
     * @return bool
     */
    public static function check($request): bool
    {
        return (static::$authUsing ?: function (): bool {
            return app()->environment('local');
        })($request);
    }

    /**
     * Set the callback that should be used to authenticate Frizzle users.
     *
     * @param  \Closure $callback
     * @return \Centagon\Frizzle\Frizzle
     */
    public static function auth(Closure $callback): Frizzle
    {
        static::$authUsing = $callback;

        return new static;
    }

    /**
     * Determine if the given bearer token matches any existing token.
     * 
     * @param  \Illuminate\Http\Request $request
     * @return bool
     */
    public static function bearer($request): bool
    {
        return ($bearer = $request->bearerToken()) && app(TokenRepository::class)->exists($bearer);
    }

    /**
     * Configure the Redis database that will store Frizzle data.
     *
     * @param  string  $connection
     * @return void
     * @throws \Exception
     */
    public static function use(string $connection): void
    {
        if (is_null($config = config("database.redis.{$connection}"))) {
            throw new Exception("Redis connection [{$connection}] has not been configured.");
        }

        config(['database.redis.horizon' => array_merge($config, [
            'options' => ['prefix' => config('frizzle.prefix') ?: 'frizzle:'],
        ])]);
    }
}
