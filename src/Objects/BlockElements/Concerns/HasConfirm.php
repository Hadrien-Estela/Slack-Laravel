<?php

namespace Slack\Objects\BlockElements\Concerns;

use Slack\Objects\CompositionObjects\ConfirmationDialog;

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
     * @param  ConfirmationDialog $confirm
     * @return Slack\Objects\BlockElements\BlockElement
     */
    public function confirm(ConfirmationDialog $confirm)
    {
        $this->confirm = $confirm;
        return $this;
    }

}
