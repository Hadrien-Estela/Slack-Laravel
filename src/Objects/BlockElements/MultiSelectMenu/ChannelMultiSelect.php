<?php

namespace Slack\Objects\BlockElements\MultiSelectMenu;

use Slack\Objects\BlockElements\MultiSelectMenu\MultiSelectMenu;

/**
 * This multi-select menu will populate its options with a list of public channels
 * visible to the current user in the active workspace.
 *
 * @link(https://api.slack.com/reference/block-kit/block-elements#channel_multi_select, more)
 */
class ChannelMultiSelect extends MultiSelectMenu
{

    /**
     * An array of one or more IDs of any valid public channel to be pre-selected
     * when the menu loads.
     *
     * @var array
     */
    private $initial_channels = [];

    /**
     * Build a new instance.
     *
     * @param string $action_id       [description]
     * @param string $placeholder     [description]
     * @param array  $initialChannels [description]
     */
    public function __construct(string $action_id,
                                string $placeholder = 'Select a channel',
                                array $initialChannels = [])
    {
        parent::__construct(MultiSelectMenu::Channel, $action_id, $placeholder);
        $this->initial_channels = $initialChannels;
    }

    /**
     * Set the initial channel.
     *
     * @param  string $channelID
     * @return ChannelSelect
     */
    public function initialChannel(string $channelID)
    {
        array_push($this->initial_channel, $channelID);
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
            'initial_channels' => $this->initial_channels,
        ], function($val) {
            return !empty($val);
        }));
    }

}
