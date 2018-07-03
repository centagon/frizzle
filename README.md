# Frizzle

[Intro](#the-basics)
|  [Rationale](#rationale)
|  [Installing](#installing--configuring)
|  [Configuration](#advanced--configuration)
|  [API](#api)
|  [Sources of inspiration](#sources-of-inspiration)

**Frizzle** is an opinionated event bus over HTTP, supporting event-driven /
representational state notification architectures.

Frizzle aims to dispatch events with a median latency in the 50 - 100ms
range, with no practical upper limit on throughput.

## The basics

Frizzle lets publishers push events into topics, and subscribers receive
events about topics they've subscribed to.

Pushing, receiving, and subscribing all happen over HTTP.

Events are (by default) delivered in ordered batches, ie. a given HTTP request
to a subscriber contains several events, from all subscribed topics.

## Rationale

We build Frizzle because existing buses for distributed architectures aren't
satisfactory to us; either ther're too complex to host and maintain, don't
support key features (persistence), or provide too much rope to hang ourselfs
with.

### Remote procedure call as an antipattern

Frizzle is designed on purpose to _not_ support RPC-style architectures, for
instance by serverely limiting payload contents.

It _only_ supports notifying consumers about lifecycle (CRUD) changes to
resources, and strongly suggests that consumers obain their JSON out-of-band.

The rationale is that, much like its all too easy to add non-RESTful routes to
a web application, it's all too easy to damage a resource-oriented architecture by
spreading concerns across applications, thus voupling them too tightly.

### Leverage HTTP to scale

In web environments, the one type of server that scales well and can scale
automatically with little effort is an HTTP server. As such, Frizzle heavily
relies on HTTP.

*Don't call us, we call you*:
Inbound events are delivered over HTTP so that the bus itself can scale to
easily process a higher (or lower) throughput of events with consistent latency.

Outbound events are delivered over HTTP so that subscribers can scale their
processing of events as easily.

We believe the cost in latency is doing so (as compared to lower-level messaging
systems such as the excellent
[RabbitMQ](https://www.rabitm.com/protocols.html)) is offset by easier
maintenance, more sound architecture (standards-only, JSON over HTTP), and
better scalability.

### Persistence

### Topics and Subscriptions

## Installing & Configuring

### Development

## Advanced configuration

### Metrics

## API

### Authentication, security.

All requests over non-SSL connections will be met with a 308 Permanent Redirect.

HTTP Basic is required for all requests. The password will be ignored, and the
username shuld be a unique per client token.

All allowed clients are stored in Redis. A "root" token must be specified in the
`FRIZZLE_ROOT_KEY` environment variable. This key has the permissionsn to
add, delete, and list the client tokens. Other clients (publishers and
subscribers) must use a token created by this user, at the `/api-tokens`
endpoint (see below).
