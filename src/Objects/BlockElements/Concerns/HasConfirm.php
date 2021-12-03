<?php

namespace Slack\Laravel\Objects\BlockElements\Concerns;

use Slack\Laravel\Objects\CompositionObjects\ConfirmationDialog;

/**
 * Trait for Block elements with `confirm` attribute.
 *
 * @package Slack\Laravel\Objects\BlockElements\Concerns
 */
trait HasConfirm
{

    /**
     * A confirm object that defines an optional confirmation dialog that
     * appears after interaction.
     *
     * @var \Slack\Laravel\Objects\CompositionObjects\ConfirmationDialog|null
     */
    private $confirm;

    /**
     * Set the confirm dialog.
     *
     * @param \Slack\Laravel\Objects\CompositionObjects\ConfirmationDialog $confirm
     * @return $this
     */
    public function confirm(ConfirmationDialog $confirm)
    {
        $this->confirm = $confirm;
        return $this;
    }

}
