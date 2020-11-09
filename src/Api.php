<?php

namespace Slack;

use Illuminate\Support\Facades\Http;

class Api
{

    /**
     * Slack API Url.
     * @var string
     */
    private $api_url;

    /**
     * The token used for requests.
     * @var string
     */
    private $token;

    /**
     * Create a new Api client instance.
     *
     * @param string $token The token used by this Api client.
     */
    public function __construct($token)
    {
        $this->api_url = config('slack.api_url');
        $this->token = $token;
    }

    /**
     * Get the Api method Url
     *
     * @param  string $method The Api method
     * @return string  Http Url
     */
    private function getUrl($method)
    {
        return $this->api_url.$method;
    }

    /**
     * POST request to the slack Api
     *
     * @param  string $method  The Api method.
     * @param  string $content The content of the request
     * @return Illuminate\Http\Client\Response The Http response.
     */
    public function post($method, $content)
    {
        $response = Http::withToken($this->token)->asForm()->post($this->getUrl($method), $content);

        if (!$response->successful())
            $response->throw();

        return $response;
    }

    /**
     * GET request to the slack Api
     *
     * @param  string $method  The Api method.
     * @param  string $content The content of the request
     * @return Illuminate\Http\Client\Response The Http response.
     */
    public function get($method, $content)
    {
        $response = Http::withToken($this->token)->asForm()->get($this->getUrl($method), $content);

        if (!$response->successful())
            $response->throw();

        return $response;
    }

    /**
     * POST request to a slack webhook url
     *
     * @param  string $url  The webhook Url.
     * @param  string $content The content of the request
     * @return Illuminate\Http\Client\Response The Http response.
     */
    public static function webhook($url, $content)
    {
        $response = Http::post($url, $content);

        if (!$response->successful())
            $response->throw();

        return $response;
    }

}
