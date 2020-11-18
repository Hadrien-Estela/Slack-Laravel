<?php

namespace Slack\Services;

use Slack\Api;
use Slack\Objects\SlackMessage;
use Slack\Objects\SlackView;
use Slack\Exceptions;

class Slack
{

    /**
     * Slack webhooks.
     *
     * @var string[]
     */
    private $webhooks = [];

    /**
     * Slack channels.
     *
     * @var string[]
     */
    private $channels = [];

    /**
     * App scoped API client.
     *
     * @var Api
     */
    private $app;

    /**
     * Bot scoped API client
     *
     * @var Api
     */
    private $bot;

    public function __construct()
    {
        $this->webhooks = config('slack.webhooks');
        $this->channels = config('slack.channels');
        $this->app = new Api(config('slack.tokens.oauth'));
        $this->bot = new Api(config('slack.tokens.bot'));
    }

    /**
     * Get a webhook url.
     *
     * @param string $webhook_name The webhook name.
     * @return string The webhook url.
     */
    public function getWebhookUrl(string $webhook_name)
    {
        return $this->webhooks[$webhook_name];
    }

    /**
     * Get a channel id.
     *
     * @param  string $channel_name The channel name.
     * @return string The channel ID.
     */
    public function getChannelID(string $channel_name)
    {
        return $this->channels[$channel_name];
    }

    /**
     * Find a user by its email address.
     * @link(https://api.slack.com/methods/users.lookupByEmail#arg_email,more)
     *
     * @param  string The email to find.
     * @return Object The user object.
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
     * Get a user's profile.
     * @link(https://api.slack.com/methods/users.profile.get, more)
     *
     * @param  string $user_id The id of the user to find profile for.
     * @return Object The profile object.
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
     *  Send a message on a webhook.
     * @link(https://api.slack.com/messaging/webhooks, more)
     *
     * @param  SlackMessage $message The message to send.
     * @param  string $webhookUrl The webhook url.
     * @return \Illuminate\Http\Client\Response
     */
    public function sendMessageUsingWebhook(SlackMessage $message, string $webhookUrl)
    {
        $response = Api::webhook($webhookUrl, $message->jsonSerialize());

        return $response;
    }

    /**
     * Send a message on a channel.
     * @link(https://api.slack.com/methods/chat.postMessage, more)
     *
     * @param SlackMessage message The message to send.
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
     * @link(https://api.slack.com/methods/views.open, more)
     *
     * @param  SlackView $view The view to open.
     * @param  string $trigger_id The trigger ID.
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
     * @link(https://api.slack.com/methods/views.update, more)
     *
     * @param  SlackView $view The content to send as update.
     * @param  string|null $view_id The ID of the view to update.
     * @param  string|null $external_id The eternal ID of the view to update.
     * @param  string|null $hash A string that represents view state.
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
     * @link(https://api.slack.com/methods/views.push, more)
     *
     * @param  SlackView $view The view to push.
     * @param  string $trigger_id The trigger ID.
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
     * @link(https://api.slack.com/methods/views.publish, more)
     *
     * @param  lackView $view The view to publish.
     * @param  string $user_id The ID of the user you want to push the view for.
     * @param  string|null $hash A string that represents view state.
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
