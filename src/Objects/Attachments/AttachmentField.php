<?php

namespace Slack\Objects\Attachments;

use JsonSerializable;

/**
 * @link(https://api.slack.com/reference/messaging/attachments#field_objects)
 */
class AttachmentField implements JsonSerializable
{

    /**
     * Shown as a bold heading displayed in the field object.
     * It cannot contain markup and will be escaped for you.
     *
     * @var string|null
     */
    private $title;

    /**
     * The text value displayed in the field object.
     * It can be formatted as plain text, or with mrkdwn by using the mrkdwn_in
     *
     * @var string|null
     */
    private $value;

    /**
     * Indicates whether the field object is short enough
     * to be displayed side-by-side with other field objects.
     * Default `false`
     *
     * @var boolean|null
     */
    private $short;

    /**
     * Build a new Instance.
     *
     * @param string|null  $title
     * @param string|null  $value
     * @param boolean|null $short
     */
    public function __construct(string $title = null, string $value = null, bool $short = null)
    {
        $this->title = $title;
        $this->value = $value;
        $this->short = $short;
    }

    /**
     * Set field's title.
     *
     * @param  string $title
     * @return AttachmentField
     */
    public function title(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Set field's value.
     *
     * @param  string $value
     * @return AttachmentField
     */
    public function value(string $value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Set field's size.
     * Default false
     *
     * @param  boolean $short
     * @return AttachmentField
     */
    public function short(bool $short)
    {
        $this->short = $short;
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_filter([
            'title' => $this->title,
            'value' => $this->value,
            'short' => $this->short
        ], function($val) {
            return !empty($val);
        });
    }

}
