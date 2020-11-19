<?php

namespace Slack\Exceptions;

use Exception;

/**
 * Class ApiException
 *
 * @package Slack\Exceptions
 */
class ApiException extends Exception
{

    /**
     * The name of the error.
     *
     * @var string
     */
    private $error;

    /**
     * ApiException constructor.
     *
     * @param array $response
     */
    public function __construct(array $response)
    {
        if (!array_key_exists('response_metadata', $response))
            parent::__construct($response['error']);
        else
            parent::__construct($response['response_metadata']['messages'][0]);
        $this->error = $response['error'];
    }

    /**
     * @return mixed|string
     */
    final public function getError()
    {
        return $this->error;
    }

}
