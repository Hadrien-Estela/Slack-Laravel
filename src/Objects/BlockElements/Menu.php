<?php

namespace Slack\Objects\BlockElements;

use Slack\Objects\BlockElements\InteractiveBlockElement;
use Slack\Objects\BlockElements\Concerns;
use Slack\Objects\CompositionObjects\Text;

abstract class Menu extends InteractiveBlockElement
{

    use Concerns\HasConfirm,
        Concerns\HasPlaceholder;

    /**
     * Build a new instance.
     *
     * @param string $type          the type of BlockElement
     * @param string $action_id     the action id
     * @param string $placeholder   the placeholder
     */
    public function __construct(string $type,
                                string $action_id,
                                string $placeholder)
    {
        parent::__construct($type, $action_id);
        $this->placeholder = new Text(Text::Plain, $placeholder);
    }

    /**
     * @override
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
