<?php

namespace Centagon\Frizzle\Http\Controllers;

use Centagon\Frizzle\Contracts\TokenRepository;
use Centagon\Frizzle\Http\Middleware\Authenticate;

class TokensController extends Controller
{
    /**
     * The tokens repository implementation
     *
     * @var \Centagon\Frizzle\Contracts\TokenRepository
     */
    protected $tokens;

    /**
     * Create a new controller instance.
     *
     * @param  \Centagon\Frizzle\Contracts\TokenRepository $tokens
     * @return void
     */
    public function __construct(TokenRepository $tokens)
    {
        $this->tokens = $tokens;

        $this->middleware(Authenticate::class);
    }

    /**
     * Get all of the registered tokens.
     *
     * @return array
     */
    public function index()
    {
        $tokens = $this->tokens->getTokens();

        abort_unless(! empty($tokens), 204);

        return $tokens;
    }

    /**
     * Register a new token.
     *
     * @return array
     */
    public function register(): array
    {
        $payload = request()->validate(['name' => 'required']);

        return $this->tokens->register($payload['name']);
    }

    /**
     * Destroy the given token.
     *
     * @param  string $token
     * @return void
     */
    public function destroy(string $token): void
    {
        $this->tokens->destroy($token);

        abort(204);
    }
}
