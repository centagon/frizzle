<?php

namespace Centagon\Frizzle\Tests\Controller;

use Mockery;
use Centagon\Frizzle\Contracts\TokenRepository;

class TokensControllerTest extends AbstractControllerTest
{
    /** @test */
    public function it_aborts_with_an_empty_http_response_when_no_tokens_a_present()
    {
        $this->actingAs(new Fakes\User);

        $this->get('/frizzle/api/tokens')->assertStatus(204);
    }

    /** @test */
    public function it_returns_all_registered_tokens()
    {
        $tokens = Mockery::mock(TokenRepository::class);

        $tokens->shouldReceive('getTokens')->andReturn(['first', 'second']);

        $this->app->instance(TokenRepository::class, $tokens);

        $this->actingAs(new Fakes\User);

        $this->get('/frizzle/api/tokens')->assertExactJson([
            'first',
            'second',
        ]);
    }

    /** @test */
    public function it_successfully_registers_a_new_token()
    {
        $tokens = Mockery::mock(TokenRepository::class);

        $tokens->shouldReceive('register')->andReturn(['test-service']);

        $this->app->instance(TokenRepository::class, $tokens);

        $this->actingAs(new Fakes\User);

        $this->post('/frizzle/api/tokens', [
            'name' => 'test-service',
        ])->assertJson(['test-service']);
    }

    /** @test */
    public function it_can_destroy_an_existing_token()
    {
        $tokens = Mockery::mock(TokenRepository::class);

        $tokens->shouldReceive('destroy')->andReturns();

        $this->app->instance(TokenRepository::class, $tokens);

        $this->actingAs(new Fakes\User);

        $this->delete('/frizzle/api/tokens/token')->assertStatus(204);
    }
}
