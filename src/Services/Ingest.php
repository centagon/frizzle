<?php

namespace Centagon\Frizzle\Services;

use Centagon\Frizzle\Models\Job;
use Centagon\Frizzle\Models\Event;
use Centagon\Frizzle\Models\Topic;

class Ingest
{
    protected $topic;
    protected $event;

    public function __construct(Topic $topic, Event $event)
    {
        $this->topic = $topic;
        $this->event = $event;
    }

    public function call()
    {
        foreach ($this->topic->subscribers() as $subscriber) {
            $job = new Job();

            $this->queue->push($job);
        }
    }
}
