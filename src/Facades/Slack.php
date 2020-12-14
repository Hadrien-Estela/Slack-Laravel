<?php

namespace Slack\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Slack
 *
 * @method static getWebhookUrl(string $webhook_name)
 * @method static getChannelID(string $channel_name)
 * @method static findUserByEmail(string $email)
 * @method static getUserProfile(string $user_id)
 * @method static sendMessageUsingWebhook(\Slack\Objects\SlackMessage $message, string $webhookUrl)
 * @method static sendMessage(\Slack\Objects\SlackMessage $message)
 * @method static deleteMessage(string $channel_id, string $message_ts)
 * @method static openView(\Slack\Objects\SlackView $view, string $trigger_id)
 * @method static updateView(\Slack\Objects\SlackView $view, string $view_id = null, string $external_id = null, string $hash = null)
 * @method static pushView(\Slack\Objects\SlackView $view, string $trigger_id)
 * @method static publishView(\Slack\Objects\SlackView $view, string $user_id, string $hash = null)
 * @method static listFiles(string $channel_id = null, string $user_id = null, int $from_ts = null, int $to_ts = null, int $count = null, int $page = null)
 * @method static deleteFile(string $file_id)
 *
 * @package Slack\Facades
 */
class Slack extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Slack\Services\Slack';
    }
}
