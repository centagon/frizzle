<?php

namespace Centagon\Frizzle\Http\Controllers;

use Centagon\Frizzle\Models\Event;
use Centagon\Frizzle\Contracts\TopicRepository;
use Centagon\Frizzle\Contracts\EventRepository;
use Centagon\Frizzle\Http\Requests\CreateTopicRequest;
use Centagon\Frizzle\Exceptions\TopicClaimedException;
use Centagon\Frizzle\Http\Middleware\AuthenticateToken;

class TopicsController extends Controller
{
    /**
     * The topics repository implementation
     *
     * @var \Centagon\Frizzle\Contracts\TokenRepository
     */
    protected $topics;

    /**
     * @var \Centagon\Frizzle\Contracts\EventRepository
     */
    protected $events;

    /**
     * Create a new controller instance.
     *
     * @param  \Centagon\Frizzle\Contracts\TopicRepository $topics
     * @param  \Centagon\Frizzle\Contracts\EventRepository $events
     * @return void
     */
    public function __construct(TopicRepository $topics, EventRepository $events)
    {
        $this->topics = $topics;
        $this->events = $events;

//        $this->middleware(AuthenticateToken::class);
    }

    /**
     * Get all of the registered topics.
     *
     * @return array
     */
    public function index()
    {
        $topics = $this->topics->getTopics();

        abort_unless(! empty($topics), 204);

        return $topics;
    }

    /**
     * Create a new topic.
     *
     * @param  \Centagon\Frizzle\Http\Requests\CreateTopicRequest $request
     * @param  string $name
     * @return \Centagon\Frizzle\Models\Event
     */
    public function create(CreateTopicRequest $request, string $name): Event
    {
        try {
            $topic = $this->topics->findOrCreate($name, 'centagontest');
        } catch (TopicClaimedException $e) {
            abort(403, 'Topic claimed');
        }

        return $this->events->create($topic, $request->all());
    }

    /**
     * Destroy the given token.
     *
     * @param  string $token
     * @return void
     */
    public function destroy(string $token): void
    {
        $this->topics->destroy($token);

        abort(204);
    }
}
