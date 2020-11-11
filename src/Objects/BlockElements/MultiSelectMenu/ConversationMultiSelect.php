<?php

namespace Slack\Objects\BlockElements\MultiSelectMenu;

use Slack\Objects\BlockElements\MultiSelectMenu\MultiSelectMenu;
use Slack\Objects\CompositionObjects\ConversationFilter;

/**
 * This multi-select menu will populate its options with a list of
 * public and private channels, DMs, and MPIMs visible to the current
 * user in the active workspace.
 *
 * @link(https://api.slack.com/reference/block-kit/block-elements#conversation_multi_select, more)
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
    private $initial_conversations = [];

    /**
     * Pre-populates the select menu with the conversation that the user was
     * viewing when they opened the modal, if available. Default is false.
     *
     * @var boolean|null
     */
    private $default_to_current_conversation;

    /**
     * A filter object that reduces the list of available conversations
     * using the specified criteria.
     *
     * @var ConversationFilter|null
     */
    private $filter;

    /**
     * Build a new Instance.
     *
     * @param string                  $action_id            [description]
     * @param string                  $placeholder          [description]
     * @param ConversationFilter|null $filter               [description]
     * @param string|array            $initialConversations [description]
     * @param boolean|null            $currentByDefault     [description]
     */
    public function __construct(string $action_id,
                                string $placeholder = 'Select a conversation',
                                ConversationFilter $filter = null,
                                string $initialConversations = [],
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
     * @return ConversationSelect
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
     * @return ConversationSelect
     */
    public function filter(ConversationFilter $filter)
    {
        $this->filter = $filter;
        return $this;
    }

    /**
     * Set current conversation to initial by default.
     *
     * @return ConversationSelect
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
