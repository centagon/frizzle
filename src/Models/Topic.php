<?php

namespace Centagon\Frizzle\Models;

class Topic
{
    /**
     * The topic name.
     *
     * @var string
     */
    public $name;

    /**
     * The publisher instance.
     *
     * @var \Centagon\Frizzle\Publisher
     */
    public $publisher = null;

    /**
     * Create a new topic instance.
     *
     * @param  string $name
     * @param  null|string $publisher
     * @return void
     */
    public function __construct(string $name, ?string $publisher)
    {
        $this->name = $name;

        if (! is_null($publisher)) {
            $this->publisher = new Publisher($publisher);
        }
    }

    public function destroy()
    {

    }

    public function subscribers()
    {

    }

    public function count()
    {

    }

    public function incrementCount()
    {

    }
}
