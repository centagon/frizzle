<?php

namespace Centagon\Frizzle\Tests\Controller;

use Centagon\Frizzle\Frizzle;
use Centagon\Frizzle\Tests\IntegrationTest;

abstract class AbstractControllerTest extends IntegrationTest
{
    public function setUp()
    {
        parent::setUp();

        $this->app['config']->set('app.key', 'base64:6P1pEmik0g8BZYymmCh2g2swrXiZRIQf9meri7HsmRQ=');

        Frizzle::auth(function (): bool {
            return true;
        });
    }
}
