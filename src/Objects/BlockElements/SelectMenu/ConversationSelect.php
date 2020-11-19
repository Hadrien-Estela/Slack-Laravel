<?php

namespace Slack\Objects\BlockElements\SelectMenu;

use Slack\Objects\CompositionObjects\ConversationFilter;

/**
 * This select menu will populate its options with a list of public
 * and private channels, DMs, and MPIMs visible to the current user
 * in the active workspace.
 * @link(https://api.slack.com/reference/block-kit/block-elements#conversation_select, more)
 *
 * @package Slack\Objects\BlockElements\SelectMenu
 */
class ConversationSelect extends SelectMenu
{

    /**
     * The ID of any valid conversation to be pre-selected when the menu loads.
     * If default_to_current_conversation is also supplied,
     * initial_conversation will be ignored.
     *
     * @var string|null
     */
    private $initial_conversation;

    /**
     * Pre-populates the select menu with the conversation that the user was
     * viewing when they opened the modal, if available. Default is false.
     *
     * @var bool|null
     */
    private $default_to_current_conversation;

    /**
     * When set to true, the view_submission payload from the menu's parent
     * view will contain a response_url. This response_url can be used for
     * message responses. The target conversation for the message will be
     * determined by the value of this select menu.
     *
     * @var bool|null
     */
    private $response_url_enabled;

    /**
     * A filter object that reduces the list of available conversations
     * using the specified criteria.
     *
     * @var \Slack\Objects\CompositionObjects\ConversationFilter|null
     */
    private $filter;

    /**
     * ConversationSelect constructor.
     *
     * @param string $action_id
     * @param string $placeholder
     * @param \Slack\Objects\CompositionObjects\ConversationFilter|null $filter
     * @param string|null $initialConversationID
     * @param bool|null $currentByDefault
     * @param bool|null $responseUrl
     */
    public function __construct(string $action_id,
                                string $placeholder = 'Select a conversation',
                                ConversationFilter $filter = null,
                                string $initialConversationID = null,
                                bool $currentByDefault = null,
                                bool $responseUrl = null)
    {
        parent::__construct(SelectMenu::Conversation, $action_id, $placeholder);
        $this->filter = $filter;
        $this->default_to_current_conversation = $currentByDefault;
        $this->initial_conversation = $initialConversationID;
        $this->response_url_enabled = $responseUrl;
    }

    /**
     * Set the initial conversation.
     *
     * @param string $conversationID [description]
     * @return $this
     */
    public function initialConversation(string $conversationID)
    {
        $this->initial_conversation = $conversationID;
        return $this;
    }

    /**
     * Set the conversation filter
     *
     * @param \Slack\Objects\CompositionObjects\ConversationFilter $filter [description]
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
            'initial_conversation' => $this->initial_conversation,
            'default_to_current_conversation' => $this->default_to_current_conversation,
            'response_url_enabled' => $this->response_url_enabled,
            'filter' => $this->filter
        ], function($val) {
            return !empty($val);
        }));
    }

}
