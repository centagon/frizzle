<?php

namespace Centagon\Frizzle\Tests\Controller;

use Centagon\Frizzle\Exceptions\TopicClaimedException;
use Mockery;
use Centagon\Frizzle\Contracts\TopicRepository;

class TopicsControllerTest extends AbstractControllerTest
{
    /** @test */
    public function it_aborts_with_an_empty_http_response_when_no_topics_a_present()
    {
        $this->actingAs(new Fakes\User);

        $this->get('/frizzle/api/topics')->assertStatus(204);
    }

    /** @test */
    public function it_returns_all_registered_topics()
    {
        $topics = Mockery::mock(TopicRepository::class);

        $topics->shouldReceive('getTopics')->andReturn(['test-topic']);

        $this->app->instance(TopicRepository::class, $topics);

        $this->actingAs(new Fakes\User);

        $this->get('/frizzle/api/topics')->assertJson([
            'test-topic',
        ]);
    }

    /** @test */
    public function it_successfully_registers_a_new_topic()
    {
        $topics = Mockery::mock(TopicRepository::class);

        $topics->shouldReceive('create')->andThrows(TopicClaimedException::class);

        $this->post('/frizzle/api/topics/new-topic');
    }

    /** @test */
    public function it_can_destroy_an_existing_topic()
    {
        $topics = Mockery::mock(TopicRepository::class);

        $topics->shouldReceive('destroy')->once();

        $this->app->instance(TopicRepository::class, $topics);

        $this->actingAs(new Fakes\User);

        $this->delete('/frizzle/api/topics/fake-topic')->assertStatus(204);
    }
}
