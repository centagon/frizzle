<?php

namespace Centagon\Frizzle\Repositories;

use Illuminate\Contracts\Redis\Factory as RedisFactory;
use Illuminate\Redis\Connections\Connection as RedisConnection;

abstract class RedisRepository
{
    /**
     * The Redis connection instance.
     *
     * @var \Illuminate\Contracts\Redis\Factory
     */
    protected $redis;

    /**
     * Create a new repository instance.
     *
     * @param  \Illuminate\Contracts\Redis\Factory $redis
     * @return void
     */
    public function __construct(RedisFactory $redis)
    {
        $this->redis = $redis;
    }

    /**
     * Get the Redis connection instance.
     *
     * @return \Illuminate\Redis\Connections\Connection
     */
    protected function connection(): RedisConnection
    {
        return $this->redis->connection('default');
    }
}
