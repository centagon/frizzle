<?php

namespace Centagon\Frizzle\Http\Controllers;

use Centagon\Frizzle\Contracts\TopicRepository;
use Centagon\Frizzle\Contracts\SubscriberRepository;
use Centagon\Frizzle\Http\Middleware\AuthenticateToken;

class SubscriberController extends Controller
{
    /**
     * The subscribers repository implementation.
     *
     * @var \Centagon\Frizzle\Contracts\SubscriberRepository
     */
    protected $subscribers;

    /**
     * The topics repository implementation
     *
     * @var \Centagon\Frizzle\Contracts\TopicRepository
     */
    protected $topics;

    /**
     * Create a new controller instance.
     *
     * @param  \Centagon\Frizzle\Contracts\SubscriberRepository $subscribers
     * @param  \Centagon\Frizzle\Contracts\TopicRepository $topics
     * @return void
     */
    public function __construct(SubscriberRepository $subscribers, TopicRepository $topics)
    {
        $this->subscribers = $subscribers;
        $this->topics = $topics;

        $this->middleware(AuthenticateToken::class);
    }

    /**
     * Get all the registered subscribers.
     *
     * @return array
     */
    public function index()
    {
        $subscribers = $this->subscribers->getSubscribers();

        abort_unless(! empty($subscribers), 204);

        return $subscribers;
    }

    /**
     * Subscribe to one or more topics.
     *
     * @return array
     */
    public function subscribe()
    {
        $payload = request()->validate([
            'topics' => 'required|array',
            'callback' => 'required|url',
        ]);

        $topics = array_map(function ($topic) {
            return $this->topics->findOrCreate($topic);
        }, $payload['topics']);

        abort_unless(! empty($topics), 404);

        $subscriber = $this->subscribers->create($topics, $payload);

    }

    /**
     * Destroy the given subscriber.
     *
     * @param  string $subscription
     * @return void
     */
    public function destroy(string $subscription): void
    {
        $this->subscribers->destroy($subscription);

        abort(204);
    }
}
