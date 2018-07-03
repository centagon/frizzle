<?php

namespace Centagon\Frizzle;

trait ServiceBindings
{
    /**
     * All of the service bindings for Frizzle.
     *
     * @var array
     */
    public $serviceBindings = [
        // Repository Sevices...
        Contracts\EventRepository::class => Repositories\RedisEventRepository::class,
        Contracts\TokenRepository::class => Repositories\RedisTokenRepository::class,
        Contracts\TopicRepository::class => Repositories\RedisTopicRepository::class,
    ];
}
