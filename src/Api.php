<?php

namespace Slack;

use Illuminate\Support\Facades\Http;

/**
 * Class Api
 *
 * @package Slack
 */
class Api
{

    /**
     * Slack API Url.
     *
     * @var string
     */
    private $api_url;

    /**
     * The token used for requests.
     *
     * @var string
     */
    private $token;

    /**
     * Api constructor.
     *
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->api_url = config('slack.api_url');
        $this->token = $token;
    }

    /**
     * Get the Api method Url
     *
     * @param string $method The Api method.
     * @return string The Url of the method.
     */
    private function getUrl(string $method)
    {
        return $this->api_url.$method;
    }

    /**
     * POST request to the slack Api
     *
     * @param string $method The Api method.
     * @param mixed $content The content of the request
     * @return \Illuminate\Http\Client\Response
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function post(string $method, $content)
    {
        $response = Http::withToken($this->token)->asForm()->post($this->getUrl($method), $content);

        if (!$response->successful())
            $response->throw();

        return $response;
    }

    /**
     * GET request to the slack Api
     *
     * @param string $method The Api method.
     * @param string|null $content The content of the request.
     * @return \Illuminate\Http\Client\Response
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function get(string $method, $content = null)
    {
        $response = Http::withToken($this->token)->asForm()->get($this->getUrl($method), $content);

        if (!$response->successful())
            $response->throw();

        return $response;
    }

    /**
     * POST request to a slack webhook url.
     *
     * @param string $url The webhook Url.
     * @param mixed $content The content of the request.
     * @return \Illuminate\Http\Client\Response
     * @throws \Illuminate\Http\Client\RequestException
     */
    public static function webhook(string $url, $content)
    {
        $response = Http::post($url, $content);

        if (!$response->successful())
            $response->throw();

        return $response;
    }

}
