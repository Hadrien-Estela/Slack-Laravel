<?php

namespace Slack\Laravel\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class SlackInteraction
 *
 * @package Slack\Laravel\Http\Middleware
 */
abstract class SlackInteraction
{
    /**
     * Handle slack interaction incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the JSON payload from the slack request.
        if (is_object($request->input('payload'))) // In case already passed here
            $payload = $request->input('payload');
        else
            $payload = json_decode($request->input('payload'));

        // Add the payload to the Request instance.
        $request->merge([
            'payload' => $payload
        ]);

        // Try to authenticate the slack user as an App user.
        $this->authenticateUser($payload->user->id);

        return $next($request);
    }

    /**
     * Authenticate the user to your app using its slack ID.
     *
     * @param string $slack_user_id
     */
    abstract protected function authenticateUser(string $slack_user_id);
}
