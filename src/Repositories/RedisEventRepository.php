<?php

namespace Centagon\Frizzle\Repositories;

use Centagon\Frizzle\Models\Event;
use Centagon\Frizzle\Models\Topic;
use Centagon\Frizzle\Contracts\EventRepository;

class RedisEventRepository extends RedisRepository implements EventRepository
{
    public function create(Topic $topic, array $attributes = []): Event
    {

    }
}
