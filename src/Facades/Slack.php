<?php

namespace Slack\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Slack
 *
 * @package Slack\Facades
 */
class Slack extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Slack\Services\Slack';
    }
}
