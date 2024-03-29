<?php

namespace Slack\Laravel\Notifications\Channels;

use Illuminate\Notifications\Notification;
use Slack\Laravel\Facades\Slack;

/**
 * Class SlackWebhookChannel
 *
 * @package Slack\Laravel\Notifications\Channels
 */
class SlackWebhookChannel
{

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     * @return \Illuminate\Http\Client\Response|null
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSlack($notifiable);

        if (! $webhook_url = $notifiable->routeNotificationFor('slack-webhook', $notification))
            return null;

        return Slack::sendMessageUsingWebhook($message, $webhook_url);
    }
}
