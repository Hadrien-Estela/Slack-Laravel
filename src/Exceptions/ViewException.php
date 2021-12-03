<?php

namespace Slack\Laravel\Exceptions;

use Slack\Laravel\Objects\SlackView;

/**
 * Class ViewException
 *
 * @package Slack\Laravel\Exceptions
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
     * @param \Slack\Laravel\Objects\SlackView $view
     */
    public function __construct(array $response, SlackView $view)
    {
        parent::__construct($response);
        $this->view = $view;
    }

    /**
     * @return \Slack\Laravel\Objects\SlackView
     */
    final public function getView()
    {
        return $this->view;
    }

}
