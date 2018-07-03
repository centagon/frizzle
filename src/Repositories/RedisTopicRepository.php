<?php

namespace Centagon\Frizzle\Repositories;

use Centagon\Frizzle\LuaScripts;
use Centagon\Frizzle\Models\Topic;
use Centagon\Frizzle\Contracts\TopicRepository;
use Centagon\Frizzle\Exceptions\TopicClaimedException;

class RedisTopicRepository extends RedisRepository implements TopicRepository
{
    protected $indexKey = 'topics';

    public function getTopics(): array
    {
        return array_map(function (string $member): Topic {
            $publisher = $this->connection()->hget($this->getKey($member), 'publisher');

            return new Topic($member, $publisher);
        }, $this->connection()->smembers($this->indexKey));
    }

    public function findOrCreate(string $name, string $publisher): Topic
    {
        list($added, $claimed, $actualPublisher) = $this->connection()->eval(LuaScripts::findOrCreate(), 2,
            $this->indexKey, $this->getKey($name),
            $name, $publisher
        );

        if ($actualPublisher != $publisher) {
            throw new TopicClaimedException("topic already claimed by {$actualPublisher}");
        }

        if ($added) {
            info("topic '{$name}' created");
        }

        if ($claimed) {
            info("topic '{$name}' claimed by '{$publisher}'");
        }

        return new Topic($name, $actualPublisher);
    }

    public function destroy()
    {

    }

    protected function getKey(string $name): string
    {
        return "topic:$name";
    }
}
