<?php

namespace Slack\Objects\BlockElements\Concerns;

use Slack\Objects\CompositionObjects\ConfirmationDialog;

/**
 * Trait for Block elements with `confirm` attribute.
 *
 * @package Slack\Objects\BlockElements\Concerns
 */
trait HasConfirm
{

    /**
     * A confirm object that defines an optional confirmation dialog that
     * appears after interaction.
     *
     * @var \Slack\Objects\CompositionObjects\ConfirmationDialog|null
     */
    private $confirm;

    /**
     * Set the confirm dialog.
     *
     * @param \Slack\Objects\CompositionObjects\ConfirmationDialog $confirm
     * @return $this
     */
    public function confirm(ConfirmationDialog $confirm)
    {
        $this->confirm = $confirm;
        return $this;
    }

}
