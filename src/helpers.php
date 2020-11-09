<?php

use Slack\Factories\ResponseActionFactory;

if (! function_exists('slack_response_action'))
{
    /**
     * Return a new response to a SlackView submission.
     *
     * @return \Illuminate\Http\Response
     */
    function slack_response_action()
    {
        return app(ResponseActionFactory::class);
    }
}
