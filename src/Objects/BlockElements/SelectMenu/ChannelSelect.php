<?php

namespace Slack\Laravel\Objects\BlockElements\SelectMenu;

/**
 * This select menu will populate its options with a list of public channels
 * visible to the current user in the active workspace.
 * @link(https://api.slack.com/reference/block-kit/block-elements#channel_select, more)
 *
 * @package Slack\Laravel\Objects\BlockElements\SelectMenu
 */
class ChannelSelect extends SelectMenu
{

    /**
     * The ID of any valid public channel to be pre-selected when the menu loads.
     *
     * @var string|null
     */
    private $initial_channel;

    /**
     * When set to true, the view_submission payload from the menu's parent
     * view will contain a response_url. This response_url can be used for
     * message responses. The target channel for the message will be determined
     * by the value of this select menu.
     *
     * @var bool
     */
    private $response_url_enabled;

    /**
     * ChannelSelect constructor.
     *
     * @param string $action_id
     * @param string $placeholder
     * @param string|null $initialChannelID
     * @param bool|null $responseUrl
     */
    public function __construct(string $action_id,
                                string $placeholder = 'Select a channel',
                                string $initialChannelID = null,
                                bool $responseUrl = null)
    {
        parent::__construct(SelectMenu::Channel, $action_id, $placeholder);
        $this->initial_channel = $initialChannelID;
        $this->response_url_enabled = $responseUrl;
    }

    /**
     * Set the initial channel.
     *
     * @param string $channelID
     * @return $this
     */
    public function initialChannel(string $channelID)
    {
        $this->initial_channel = $channelID;
        return $this;
    }

    /**
     * Enables the response URL.
     *
     * @return $this
     */
    public function enableResponseUrl()
    {
        $this->response_url_enabled = true;
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_merge(parent::jsonSerialize(), [

        ], array_filter([
            'initial_channel' => $this->initial_channel,
            'response_url_enabled' => $this->response_url_enabled
        ], function($val) {
            return !empty($val);
        }));
    }

}
