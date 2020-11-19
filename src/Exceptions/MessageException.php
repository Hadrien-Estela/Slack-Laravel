<?php

namespace Slack\Exceptions;

use Slack\Objects\SlackMessage;

/**
 * Class MessageException
 *
 * @package Slack\Exceptions
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
     * @param \Slack\Objects\SlackMessage $sent
     */
    public function __construct(array $response, SlackMessage $sent)
    {
        parent::__construct($response);
        $this->sent = $sent;
    }

    /**
     * @return \Slack\Objects\SlackMessage
     */
    final public function getSentMessage()
    {
        return $this->sent;
    }

}
