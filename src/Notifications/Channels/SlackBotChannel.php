<?php

namespace Slack\Laravel\Notifications\Channels;

use Illuminate\Notifications\Notification;
use Slack\Laravel\Facades\Slack;

/**
 * Class SlackBotChannel
 *
 * @package Slack\Laravel\Notifications\Channels
 */
class SlackBotChannel
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
        $channel_id = $notifiable->routeNotificationFor('slack-bot', $notification);

        if (!$channel_id)
            return null;
        else
            $message->to($channel_id);

        return Slack::sendMessage($message);
    }

}
