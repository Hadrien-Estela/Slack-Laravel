<?php

namespace Slack\Services;

use Illuminate\Support\Facades\Log;
use Slack\Api;
use Slack\Objects\SlackMessage;
use Slack\Objects\SlackView;
use Slack\Exceptions;

class Slack
{

    /**
     * Slack webhooks.
     *
     * @var string array
     */
    private $webhooks = [];

    /**
     * Slack channels.
     *
     * @var string array
     */
    private $channels = [];

    /**
     * App API client
     * @var Slack\Api
     */
    private $app;

    /**
     * Bot API client
     * @var Slack\Api
     */
    private $bot;

    /**
     * Create a new Ovh instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->webhooks = config('slack.webhooks');
        $this->channels = config('slack.channels');
        $this->app = new Api(config('slack.tokens.oauth'));
        $this->bot = new Api(config('slack.tokens.bot'));
    }

    /**
     * Gets a webhook url.
     *
     * @param string  $webhookname
     * @return string
     */
    public function getWebhookUrl(string $webhookname)
    {
        return $this->webhooks[$webhookname];
    }

    public function getChannelID(string $channelname)
    {
        return $this->channels[$channelname];
    }

    /**
     * Find a user with an email address.
     *
     * https://api.slack.com/methods/users.lookupByEmail#arg_email
     *
     * @param  string email
     * @return https://api.slack.com/types/user user object
     */
    public function findUserByEmail(string $email)
    {
        $response = $this->app->get('users.lookupByEmail', [
            'email' => $email
        ]);

        if ($response->json()['ok'] == false)
            return null;

        return json_decode(json_encode($response->json()['user']));
    }

    /**
     * Retrieves a user's profile information.
     *
     * https://api.slack.com/methods/users.profile.get
     *
     * @param  string                       $user_id
     * @return profile object
     */
    public function getUserProfile(string $user_id)
    {
        $response = $this->app->get('users.profile.get', [
            'user' => $user_id
        ]);

        if (!$response->json()['ok'])
            return Exceptions\ApiException($response->json());

        return json_decode(json_encode($response->json()['profile']));
    }

    /**
     *  Sends a message on a webhook.
     *
     * https://api.slack.com/messaging/webhooks
     *
     * @param  \Slack\Objects\SlackMessage     $message
     * @param  string                              $webhookUrl
     * @return \Illuminate\Http\Client\Response
     */
    public function sendMessageUsingWebhook(SlackMessage $message, string $webhookUrl)
    {
        $response = Api::webhook($webhookUrl, $message->jsonSerialize());

        return $response;
    }

    /**
     * Sends a message to a channel.
     *
     * https://api.slack.com/methods/chat.postMessage
     *
     * @param \Slack\Objects\SlackMessage  message
     * @return \Illuminate\Http\Client\Response
     */
    public function sendMessage(SlackMessage $message)
    {
        $response = $this->bot->post('chat.postMessage', $message->jsonSerialize());

        if (!$response->json()['ok'])
            throw new Exceptions\MessageException($response->json(), $message);

        return $response;
    }

    /**
     * Open a view for a user.
     *
     *  https://api.slack.com/methods/views.open
     *
     * @param  \Slack\Objects\SlackView     $view
     * @param  string                           $trigger_id
     * @return \Illuminate\Http\Client\Response
     */
    public function openView(SlackView $view, string $trigger_id)
    {
        $response = $this->bot->post('views.open', [
            'view' => $view->toJson(),
            'trigger_id' => $trigger_id
        ]);

        if (!$response->json()['ok'])
            throw new Exceptions\ViewException($response->json(), $view);

        return $response;
    }

    /**
     * Update an existing view.
     *
     * https://api.slack.com/methods/views.update
     *
     * @param  \Slack\Objects\SlackView     $view
     * @param  string|null                      $view_id
     * @param  string|null                      $external_id
     * @param  string|null                      $hash
     * @return \Illuminate\Http\Client\Response
     */
    public function updateView(SlackView $view,
                                string $view_id = null,
                                string $external_id = null,
                                string $hash = null)
    {
        $response = $this->bot->post('views.update', array_merge([
           'view' => $view->toJson()
        ],array_filter([
            'view_id' => $view_id,
            'external_id' => $external_id,
            'hash' => $hash
        ], function($val) {
            return !empty($val);
        })));

        if (!$response->json()['ok'])
            throw new Exceptions\ViewException($response->json(), $view);

        return $response;
    }

    /**
     * Push a view onto the stack of a root view.
     *
     * https://api.slack.com/methods/views.push
     *
     * @param  \Slack\Objects\SlackView     $view
     * @param  string                           $trigger_id
     * @return \Illuminate\Http\Client\Response
     */
    public function pushView(SlackView $view, string $trigger_id)
    {
        $response = $this->bot->post('views.push', [
            'view' => $view->toJson(),
            'trigger_id' => $trigger_id
        ]);

        if (!$response->json()['ok'])
            throw new Exceptions\ViewException($response->json(), $view);

        return $response;
    }

    /**
     * Publish a static view for a User.
     *
     * https://api.slack.com/methods/views.publish
     *
     * @param  \Slack\Objects\SlackView     $view
     * @param  string                           $user_id
     * @param  string|null                      $hash
     * @return \Illuminate\Http\Client\Response
     */
    public function publishView(SlackView $view, string $user_id, string $hash = null)
    {
       $response = $this->bot->post('views.publish', array_merge([
           'view' => $view->toJson(),
           'user_id' => $user_id
        ],array_filter([
            'hash' => $hash
        ], function($val) {
            return !empty($val);
        })));

        if (!$response->json()['ok'])
            throw new Exceptions\ViewException($response->json(), $view);

        return $response;
    }

}
