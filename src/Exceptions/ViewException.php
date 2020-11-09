<?php

namespace Slack\Exceptions;

use Slack\Exceptions\ApiException;
use Slack\Objects\SlackView;

class ViewException extends ApiException
{

    /**
     * The view.
     *
     * @var SlackView
     */
    protected $view;

    public function __construct(array $response, SlackView $view)
    {
        parent::__construct($response);
        $this->view = $view;
    }

    final public function getView()
    {
        return $this->view;
    }

}
