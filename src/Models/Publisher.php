<?php

namespace Centagon\Frizzle\Models;

class Publisher
{
    /**
     * The name of the publisher.
     *
     * @var string
     */
    public $name;

    /**
     * Create a new publisher instance.
     *
     * @param  string $name
     * @return void
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
