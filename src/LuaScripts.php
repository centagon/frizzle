<?php

namespace Centagon\Frizzle;

class LuaScripts
{
    /**
     * Create a topic if it doesn't exist.
     * If a publisher is specified , and the topuc doesn't exist
     * or doesn't currently have a publisher, it will be set.
     *
     * KEYS[1]: Set, the index
     * KEYS[2]: Hash, the topic's metadata (may not exist)
     * ARGV[1]: Topic name
     * ARGV[2]: Publisher name(optional)
     *
     * @return string
     */
    public static function findOrCreate()
    {
        return <<<'LUA'
local added = redis.call('SADD', KEYS[1], ARGV[1])
local claimed = 0

if ARGV[2] and #ARGV[2] > 0 then
  claimed = redis.call('HSETNX', KEYS[2], 'publisher', ARGV[2])

  if claimed > 0 then
    return { added, 1, ARGV[2] }
  end
end

return { added, claimed, redis.call('HGET', KEYS[2], 'publisher') }
LUA;
    }
}
