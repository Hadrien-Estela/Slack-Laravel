<?php

namespace Slack\Objects\BlockElements;

use Slack\Objects\BlockElements\Concerns;
use Slack\Objects\CompositionObjects\Text;

/**
 * Base class for menu elements.
 *
 * @package Slack\Objects\BlockElements
 */
abstract class Menu extends InteractiveBlockElement
{

    use Concerns\HasConfirm,
        Concerns\HasPlaceholder;

    /**
     * Menu constructor.
     *
     * @param string $type
     * @param string $action_id
     * @param string $placeholder
     */
    public function __construct(string $type,
                                string $action_id,
                                string $placeholder)
    {
        parent::__construct($type, $action_id);
        $this->placeholder = new Text(Text::Plain, $placeholder);
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_merge(parent::jsonSerialize(), [
            'placeholder' => $this->placeholder
        ], array_filter([
            'confirm' => $this->confirm
        ], function($val) {
            return !empty($val);
        }));
    }

}
