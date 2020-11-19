<?php

namespace Slack\Exceptions;

use Slack\Objects\SlackView;

/**
 * Class ViewException
 *
 * @package Slack\Exceptions
 */
class ViewException extends ApiException
{

    /**
     * The view.
     *
     * @var SlackView
     */
    protected $view;

    /**
     * ViewException constructor.
     *
     * @param array $response
     * @param \Slack\Objects\SlackView $view
     */
    public function __construct(array $response, SlackView $view)
    {
        parent::__construct($response);
        $this->view = $view;
    }

    /**
     * @return \Slack\Objects\SlackView
     */
    final public function getView()
    {
        return $this->view;
    }

}
