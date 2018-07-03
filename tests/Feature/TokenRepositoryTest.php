<?php

namespace Centagon\Frizzle\Tests\Feature;

use Centagon\Frizzle\Tests\IntegrationTest;
use Centagon\Frizzle\Contracts\TokenRepository;

class TokenRepositoryTest extends IntegrationTest
{
    /** @test */
    public function a_new_token_can_be_registered()
    {
        $repo = resolve(TokenRepository::class);

        $token = $repo->register('test-service');

        $this->assertInternalType('array', $token);
        $this->assertArrayHasKey('token', $token);
        $this->assertArrayHasKey('client', $token);
    }

    /** @test */
    public function it_can_be_determined_that_a_token_exists()
    {
        $repo = resolve(TokenRepository::class);

        $token = $repo->register('test-service');

        $this->assertTrue($repo->exists($token['token']));
        $this->assertFalse($repo->exists('non-existing-token'));
    }

    /** @test */
    public function tokens_can_be_destroyed()
    {
        $repo = resolve(TokenRepository::class);

        $token = $repo->register('test-service');

        $this->assertTrue($repo->exists($token['token']));

        $repo->destroy($token['token']);

        $this->assertFalse($repo->exists($token['token']));
    }
}
