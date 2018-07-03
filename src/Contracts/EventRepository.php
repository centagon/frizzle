<?php

namespace Centagon\Frizzle\Contracts;

use Centagon\Frizzle\Models\Event;
use Centagon\Frizzle\Models\Topic;

interface EventRepository
{
    public function create(Topic $topic, array $attributes = []): Event;
}
