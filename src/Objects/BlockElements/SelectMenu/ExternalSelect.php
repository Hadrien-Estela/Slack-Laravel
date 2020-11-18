<?php

namespace Slack\Objects\BlockElements\SelectMenu;

use Slack\Objects\BlockElements\Concerns;
use Slack\Objects\CompositionObjects\Option;

/**
 * This select menu will load its options from an external data source,
 * allowing for a dynamic list of options.
 *
 * @link(https://api.slack.com/reference/block-kit/block-elements#external_select, more)
 */
class ExternalSelect extends SelectMenu
{

    use Concerns\HasOptions;

    /**
     * When the typeahead field is used, a request will be sent on every character change.
     *
     * @var integer|null
     */
    private $min_query_length;

    /**
     * Build a new instance.
     *
     * @param string $action_id
     * @param string $placeholder
     * @param integer $minQueryLength
     */
    public function __construct(string $action_id,
                                string $placeholder = 'Select an option',
                                int $minQueryLength = null,
                                Option $initialOption = null)
    {
        parent::__construct(SelectMenu::External, $action_id, $placeholder);
        $this->min_query_length = $minQueryLength;
        $this->initial_option = $initialOption;
    }

    /**
     * Set the minimum query length.
     *
     * @param  integer $length
     * @return Slack\Objects\BlockElements\SelectMenu\ExternalSelect
     */
    public function minQueryLength(int $length)
    {
        $this->min_query_length = $length;
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
            'initial_option' => $this->initial_option,
            'min_query_length' => $this->min_query_length
        ], function($val) {
            return !empty($val);
        }));
    }

}
