<?php

namespace Centagon\Frizzle\Events;

use Centagon\Frizzle\Models\Topic;
use Illuminate\Queue\SerializesModels;

class TopicEvent
{
    use SerializesModels;

    /**
     * The topic implementation.
     * 
     * @var \Centagon\Frizzle\Models\Topic
     */
    public $topic;

    /**
     * Create a new topic event instance.
     * 
     * @param  \Centagon\Frizzle\Models\Topic $topic
     * @return void
     */
    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
    }
}
