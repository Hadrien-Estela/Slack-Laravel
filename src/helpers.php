<?php

use Slack\Factories\ResponseActionFactory;

if (! function_exists('slack_response_action'))
{
    /**
     * Return a new ResponseAction.
     *
     * @return \Slack\Factories\ResponseActionFactory
     */
    function slack_response_action()
    {
        return app(ResponseActionFactory::class);
    }
}
