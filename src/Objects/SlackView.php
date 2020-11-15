<?php

namespace Slack\Objects;

use JsonSerializable;

use Illuminate\Contracts\Support\Jsonable;

use Slack\Objects\CompositionObjects\Text;
use Slack\Objects\Blocks\Block;

/**
 * Build a serializable view.
 *
 * @link(https://api.slack.com/reference/surfaces/views, more)
 */
class SlackView implements JsonSerializable, Jsonable
{

    const Modal = 'modal';
    const HomeTab = 'home';

    /**
     * The type of view. Set to modal for modals and home for Home tabs.
     *
     * @var string
     */
    private $type;

    /**
     * The title that appears in the top-left of the modal.
     * Max length of 24 characters.
     *
     * @var Text
     */
    private $title;

    /**
     * An array of blocks that defines the content of the view. Max of 100 blocks.
     *
     * @var Block[]
     */
    private $blocks = [];

    /**
     * An optional plain_text element that defines the text displayed in the
     * close button at the bottom-right of the view.
     * Max length of 24 characters.
     *
     * @var Text|null
     */
    private $close;

    /**
     * An optional plain_text element that defines the text displayed in the
     * submit button at the bottom-right of the view. submit is required when
     * an input block is within the blocks array.
     * Max length of 24 characters.
     *
     * @var Text|null
     */
    private $submit;

    /**
     * An optional string that will be sent to your app in view_submission
     * and block_actions events.
     * Max length of 3000 characters.
     *
     * @var string|null
     */
    private $private_metadata;

    /**
     * An identifier to recognize interactions and submissions of this particularview.
     * Don't use this to store sensitive information (use private_metadata instead).
     * Max length of 255 characters.
     *
     * @var string|null
     */
    private $callback_id;

    /**
     * When set to true, clicking on the close button will clear all views in
     * a modal and close it.
     * Defaults to false.
     *
     * @var boolean|null
     */
    private $clear_on_close;

    /**
     * ndicates whether Slack will send your request URL a view_closed event
     * when a user clicks the close button. Defaults to false.
     *
     * @var boolean|null
     */
    private $notify_on_close;

    /**
     * A custom identifier that must be unique for all views on a per-team basis.
     *
     * @var string|null
     */
    private $external_id;

    /**
     * Build a new SlackView instance.
     *
     * @param string       $type
     * @param string       $title
     * @param Block[]      $blocks
     * @param string|null  $close
     * @param string|null  $submit
     * @param string|null  $private_metadata
     * @param string|null  $callbackID
     * @param boolean|null $clearOnClose
     * @param boolean|null $notifyOnClose
     * @param string|null  $externalID
     */
    public function __construct(string $type,
                                string $title = 'New view',
                                array $blocks = [],
                                string $close = null,
                                string $submit = null,
                                string $private_metadata = null,
                                string $callbackID = null,
                                bool $clearOnClose = null,
                                bool $notifyOnClose = null,
                                string $externalID = null)
    {
        $this->type = $type;
        $this->title = new Text(Text::Plain, substr($title,0,24));
        if ($blocks)
            $this->blocks = $blocks;
        $this->close = isset($close) ? new Text(Text::Plain, substr($close,0,24)) : null;
        $this->submit = isset($submit) ? new Text(Text::Plain, substr($submit,0,24)) : null;
        $this->private_metadata = $private_metadata;
        $this->callback_id = $callbackID;
        $this->clear_on_close = $clearOnClose;
        $this->notify_on_close = $notifyOnClose;
        $this->external_id = $externalID;
    }

    /**
     * Set the title.
     * Max length of 24 characters.
     *
     * @param  string $title
     * @return SlackView
     */
    public function title (string $title)
    {
        $this->title->text(Str::limit($title,21));
        return $this;
    }

    /**
     * Add a block.
     *
     * @param  Block $block
     * @return SlackView
     */
    public function block(Block $block, int $insert = null)
    {
        if (isset($insert))
            throw new NotImplementedException('$insert parameter not implemented yet');
        else
           array_push($this->blocks, $block);
        return $this;
    }

    /**
     * Set the close button text.
     * Max length of 24 characters.
     *
     * @param  string $label
     * @return SlackView
     */
    public function closeLabel(string $label)
    {
        $this->close = new Text(Text::Plain, substr($label,0,24));
        return $this;
    }

    /**
     * Set the submit button text.
     * Max length of 24 characters.
     *
     * @param  string $label
     * @return SlackView
     */
    public function submitLabel(string $label)
    {
        $this->submit = new Text(Text::Plain, substr($label,0,24));
        return $this;
    }

    /**
     * Set the metadata.
     * Max length of 3000 characters.
     *
     * @param  string $data
     * @return SlackView
     */
    public function metadata(string $data)
    {
        $this->private_metadata = substr($data,0,3000);
        return $this;
    }

    /**
     * Set the callback ID.
     * Max length of 255 characters.
     *
     * @param  string $callbackID
     * @return SlackView
     */
    public function callback(string $callbackID)
    {
        $this->callback_id = substr($callbackID,0,255);
        return $this;
    }

    /**
     * Make view clear on close.
     *
     * @return SlackView
     */
    public function clearOnClose()
    {
        $this->clear_on_close = true;
        return $this;
    }

    /**
     * Make view notify on close.
     *
     * @return SlackView
     */
    public function notifyOnClose()
    {
        $this->notify_on_close = true;
        return $this;
    }

    /**
     * Set the external ID.
     *
     * @param  string $id
     * @return SlackView
     */
    public function externalID(string $id)
    {
        $this->external_id = $id;
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
            'type' => $this->type,
            'title' => $this->title,
            'blocks' => $this->blocks
        ],array_filter([
            'close' => $this->close,
            'submit' => $this->submit,
            'private_metadata' => $this->private_metadata,
            'callback_id' => $this->callback_id,
            'clear_on_close' => $this->clear_on_close,
            'notify_on_close' => $this->notify_on_close,
            'external_id' => $this->external_id
        ], function($val) {
            return (!empty($val));
        }));
    }

    /**
     * Convert to JSON.
     *
     * @param  int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

}
