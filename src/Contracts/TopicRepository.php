<?php

namespace Centagon\Frizzle\Contracts;

use Centagon\Frizzle\Models\Topic;

interface TopicRepository
{
    public function getTopics(): array;

    /**
     * @param  string $name
     * @param  string $publisher
     * @return \Centagon\Frizzle\Models\Topic
     * @throws \Centagon\Frizzle\Exceptions\TopicClaimedException
     */
    public function findOrCreate(string $name, string $publisher): Topic;

    public function destroy();
}
