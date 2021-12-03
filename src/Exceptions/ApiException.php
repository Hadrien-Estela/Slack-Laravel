<?php

namespace Slack\Laravel\Exceptions;

use Exception;

/**
 * Class ApiException
 *
 * @package Slack\Laravel\Exceptions
 */
class ApiException extends Exception
{

    public const ERROR_RATE_LIMITED = 'ratelimited';

    /**
     * The name of the error.
     *
     * @var string
     */
    private $error;

    /**
     * Json response returned by the API
     *
     * @var array
     */
    private $response;

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
        $this->response = $response;
    }

    /**
     * @return mixed|string
     */
    final public function getError()
    {
        return $this->error;
    }

    /**
     * @return mixed|string
     */
    final public function getJsonResponse()
    {
        return $this->response;
    }

}
