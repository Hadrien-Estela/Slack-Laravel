<?php

namespace Slack\Laravel\Objects\BlockElements\MultiSelectMenu;

use Slack\Laravel\Objects\CompositionObjects\ConversationFilter;

/**
 * This multi-select menu will populate its options with a list of
 * public and private channels, DMs, and MPIMs visible to the current
 * user in the active workspace.
 * @link(https://api.slack.com/reference/block-kit/block-elements#conversation_multi_select, more)
 *
 * @package Slack\Laravel\Objects\BlockElements\MultiSelectMenu
 */
class ConversationMultiSelect extends MultiSelectMenu
{

    /**
     * An array of one or more IDs of any valid conversations to be pre-selected
     * when the menu loads.
     * If default_to_current_conversation is also supplied,
     * initial_conversations will be ignored.
     *
     * @var string[]
     */
    private $initial_conversations;

    /**
     * Pre-populates the select menu with the conversation that the user was
     * viewing when they opened the modal, if available. Default is false.
     *
     * @var bool|null
     */
    private $default_to_current_conversation;

    /**
     * A filter object that reduces the list of available conversations
     * using the specified criteria.
     *
     * @var \Slack\Laravel\Objects\CompositionObjects\ConversationFilter|null
     */
    private $filter;

    /**
     * ConversationMultiSelect constructor.
     *
     * @param string $action_id
     * @param string $placeholder
     * @param \Slack\Laravel\Objects\CompositionObjects\ConversationFilter|null $filter
     * @param array $initialConversations
     * @param bool|null $currentByDefault
     */
    public function __construct(string $action_id,
                                string $placeholder = 'Select a conversation',
                                ConversationFilter $filter = null,
                                array $initialConversations = [],
                                bool $currentByDefault = null)
    {
        parent::__construct(MultiSelectMenu::Conversation, $action_id, $placeholder);
        $this->filter = $filter;
        $this->default_to_current_conversation = $currentByDefault;
        $this->initial_conversations = $initialConversations;
    }

    /**
     * Add an initial conversation.
     *
     * @param  string $conversationID [description]
     * @return $this
     */
    public function initialConversation(string $conversationID)
    {
        array_push($this->initial_conversations, $conversationID);
        return $this;
    }

    /**
     * Set the conversation filter
     *
     * @param  ConversationFilter $filter [description]
     * @return $this
     */
    public function filter(ConversationFilter $filter)
    {
        $this->filter = $filter;
        return $this;
    }

    /**
     * Set current conversation to initial by default.
     *
     * @return $this
     */
    public function currentConversationByDefault()
    {
        $this->default_to_current_conversation = true;
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
            'initial_conversations' => $this->initial_conversations,
            'default_to_current_conversation' => $this->default_to_current_conversation,
            'filter' => $this->filter
        ], function($val) {
            return !empty($val);
        }));
    }

}
