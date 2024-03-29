<?php

namespace Slack\Laravel\Objects;

use JsonSerializable;
use Illuminate\Contracts\Support\Jsonable;
use Slack\Laravel\Objects\Blocks\Block;
use Slack\Laravel\Objects\Attachments\Attachment;

/**
 * Build a serializable message.
 * @link(https://api.slack.com/reference/messaging/payload, more)
 *
 * @package Slack\Laravel\Objects
 */
class SlackMessage implements JsonSerializable, Jsonable
{

    /**
     * The usage of this field changes depending on whether you're using blocks or not.
     * If you are, this is used as a fallback string to display in notifications.
     * If you aren't, this is the main body text of the message.
     * It can be formatted as plain text, or with mrkdwn.
     * This field is not enforced as required when using blocks,
     * however it is highly recommended that you include it as the aforementioned fallback.
     *
     * @var string
     */
    private $text;

    /**
     * Determines whether the text field is rendered according
     * to mrkdwn formatting or not.
     * Defaults to true.
     *
     * @var bool|null
     */
    private $mrkdwn;

    /**
     * The channel where the message will be published.
     *
     * @var string|null
     */
    private $channel;

    /**
     * An array of layout blocks
     *
     * @var \Slack\Laravel\Objects\Blocks\Block[]
     */
    private $blocks = [];

    /**
     * An array of legacy secondary attachments.
     *
     * @var \Slack\Laravel\Objects\Attachments\Attachment[]
     */
    private $attachments = [];

    /**
     * The ID of another un-threaded message to reply to.
     *
     * @var string|null
     */
    private $thread_ts;

    /**
     * Set your bot user name.
     * @link(https://api.slack.com/methods/chat.postMessage#arg_username, more)
     *
     * @var string|null
     */
    private $username;

    /**
     * SlackMessage constructor.
     *
     * @param string $text
     * @param bool|null $markdown
     * @param string|null $channel_id
     * @param \Slack\Laravel\Objects\Blocks\Block[] $blocks
     */
    public function __construct(string $text = 'Empty message.',
                                bool $markdown = null,
                                string $channel_id = null,
                                array $blocks = [])
    {
        $this->text = $text;
        $this->mrkdwn = $markdown;
        $this->channel = $channel_id;
        if ($blocks)
            $this->blocks = $blocks;
    }

    /**
     * Set text content of the message.
     *
     * @param string $text
     * @return $this
     */
    public function text(string $text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Set the channel ID.
     *
     * @param string $channel
     * @return $this
     */
    public function to(string $channel)
    {
        $this->channel = $channel;
        return $this;
    }

    /**
     * Enabling content markdown.
     *
     * @param bool $markdown
     * @return $this
     */
    public function markdown(bool $markdown)
    {
        $this->mrkdwn = $markdown;
        return $this;
    }

    /**
     * Add blocks to message.
     *
     * @param Block $block
     * @return $this
     */
    public function block(Block $block)
    {
        array_push($this->blocks, $block);
        return $this;
    }

    /**
     * Add attachment.
     *
     * @param Attachment $attachment
     * @return $this
     */
    public function attachment(Attachment $attachment)
    {
        array_push($this->attachments, $attachment);
        return $this;
    }

    /**
     * Set thread parent.
     *
     * @param string $thread_ts
     * @return $this
     */
    public function thread(string $thread_ts)
    {
        $this->thread_ts = $thread_ts;
        return $this;
    }

    /**
     * Set bot username.
     *
     * @param string $username
     * @return $this
     */
    public function username(string $username)
    {
        $this->username = $username;
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
            'text' => $this->text,
            'mrkdwn' => $this->mrkdwn
        ],array_filter([
            'channel' => $this->channel,
            'blocks' => $this->blocks(),
            'attachments' => $this->attachments(),
            'thread_ts' => $this->thread_ts,
            'username' => $this->username
        ], function($val) {
            return (!empty($val));
        }));
    }

    /**
     * Get Blocks JSON payload.
     *
     * @return string|null
     */
    private function blocks()
    {
        if (empty($this->blocks))
            return ;

        $blocks = array();
        foreach ($this->blocks as $block)
            array_push($blocks, $block->jsonSerialize());
        return json_encode($blocks);
    }

    /**
     * Get attachment JSON payload.
     *
     * @return string|null
     */
    private function attachments()
    {
        if (empty($this->attachments))
            return ;

        $attachments = array();
        foreach ($this->attachments as $attachment)
            array_push($attachments, $attachment->jsonSerialize());
        return json_encode($attachments);
    }

    /**
     * Convert to JSON.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

}
