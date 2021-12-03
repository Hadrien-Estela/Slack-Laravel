<?php

namespace Slack\Laravel\Objects\CompositionObjects;

use JsonSerializable;

/**
 * Provides a way to filter the list of options in a conversations
 * select menu or conversations multi-select menu.
 * @link(https://api.slack.com/reference/block-kit/composition-objects#filter_conversations, more)
 *
 * @package Slack\Laravel\Objects\CompositionObjects
 */
class ConversationFilter implements JsonSerializable
{

    public const Individual = 'im';
    public const Multipart = 'mpim';
    public const Public = 'public';
    public const Private = 'private';

    /**
     * Indicates which type of conversations should be included in the list.
     * You should provide an array of strings from the following options:
     * `im`, `mpim`, `private`, and `public`. The array cannot be empty.
     *
     * @var string[]
     */
    private $include;

    /**
     * Indicates whether to exclude external shared channels from conversation lists.
     * Defaults to `false`.
     *
     * @var bool
     */
    private $exclude_external_shared_channels;

    /**
     * Indicates whether to exclude bot users from conversation lists.
     * Defaults to `false`.
     *
     * @var bool
     */
    private $exclude_bot_users;

    /**
     * ConversationFilter constructor.
     *
     * @param bool|null $excludeExternal
     * @param bool|null $excludeBots
     * @param string[] $include
     */
    public function __construct(bool $excludeExternal = null,
                                bool $excludeBots = null,
                                array $include = [])
    {
        $this->exclude_external_shared_channels = $excludeExternal;
        $this->exclude_bot_users = $excludeBots;
        $this->include = $include;
    }

    /**
     * Exclude External channels.
     *
     * @return $this
     */
    public function excludeExternal()
    {
        $this->exclude_external_shared_channels = true;
        return $this;
    }

    /**
     * Exclude Bots.
     *
     * @return $this
     */
    public function excludeBots()
    {
        $this->exclude_bot_users = true;
        return $this;
    }

    /**
     * Include type of conversation.
     *
     * @param string $type
     * @return $this
     */
    public function include(string $type)
    {
        array_push($this->include, $type);
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_merge([

        ],array_filter([
            'include' => $this->include,
            'exclude_external_shared_channels' => $this->exclude_external_shared_channels,
            'exclude_bot_users' => $this->exclude_bot_users
        ], function($val) {
            return !empty($val);
        }));
    }

}
