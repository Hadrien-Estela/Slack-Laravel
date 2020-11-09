<?php

namespace Slack\Objects\BlockElements\MultiSelectMenu;

use Slack\Objects\BlockElements\Concerns;
use Slack\Objects\BlockElements\MultiSelectMenu\MultiSelectMenu;
use Slack\Objects\CompositionObjects\Option;

/**
 * This menu will load its options from an external data source,
 * allowing for a dynamic list of options.
 *
 * https://api.slack.com/reference/block-kit/block-elements#external_multi_select
 */
class ExternalMultiSelect extends MultiSelectMenu
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
                                array $initialOptions = [])
    {
        parent::__construct(MultiSelectMenu::External, $action_id, $placeholder);
        $this->min_query_length = $minQueryLength;
        $this->initial_options = $initialOptions;
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
     * @override
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_merge(parent::jsonSerialize(), [

        ], array_filter([
            'initial_options' => $this->initialOptions(),
            'min_query_length' => $this->min_query_length
        ], function($val) {
            return !empty($val);
        }));
    }

}
