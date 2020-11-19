<?php

namespace Slack\Notifications\Channels;

use Illuminate\Notifications\Notification;
use Slack\Facades\Slack;

class SlackWebhookChannel
{

    /**
     * Send the given notification.
     *
     * @param  mixed $notifiable
     * @param  \Illuminate\Notifications\Notification $notification
     * @return \Illuminate\Http\Client\Response
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSlack($notifiable);

        if (! $webhook_url = $notifiable->routeNotificationFor('slack-webhook', $notification))
            return ;

        return Slack::sendMessageUsingWebhook($message, $webhook_url);
    }
}
