<?php

namespace Centagon\Frizzle\Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Redis;

abstract class IntegrationTest extends TestCase
{
    /**
     * Setup the test case.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        Redis::flushAll();
    }

    /**
     * Tear down the test case.
     *
     * @return void
     */
    public function tearDown()
    {
        Redis::flushAll();

        parent::tearDown();
    }

    /**
     * Get the service providers for the package.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return ['Centagon\Frizzle\FrizzleServiceProvider'];
    }

    /**
     * Configure the environment.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.redis.default.host', 'redis');
        $app['config']->set('queue.default', 'redis');
    }
}
