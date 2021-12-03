<?php

namespace Slack\Laravel\Exceptions;

use Slack\Laravel\Objects\SlackMessage;

/**
 * Class MessageException
 *
 * @package Slack\Laravel\Exceptions
 */
class MessageException extends ApiException
{

    /**
     * The sent message.
     *
     * @var SlackMessage
     */
    protected $sent;

    /**
     * MessageException constructor.
     *
     * @param array $response
     * @param \Slack\Laravel\Objects\SlackMessage $sent
     */
    public function __construct(array $response, SlackMessage $sent)
    {
        parent::__construct($response);
        $this->sent = $sent;
    }

    /**
     * @return \Slack\Laravel\Objects\SlackMessage
     */
    final public function getSentMessage()
    {
        return $this->sent;
    }

}
