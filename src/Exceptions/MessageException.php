<?php

namespace Slack\Exceptions;

use Slack\Exceptions\ApiException;
use Slack\Objects\SlackMessage;

class MessageException extends ApiException
{

    /**
     * The sent message.
     *
     * @var SlackMessage
     */
    protected $sent;

    public function __construct(array $response, SlackMessage $sent)
    {
        parent::__construct($response);
        $this->sent = $sent;
    }

    final public function getSentMessage()
    {
        return $this->sent;
    }

}
